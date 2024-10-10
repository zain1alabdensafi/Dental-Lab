<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Cases;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    public function add_bill(Request $request)
    {
        //$user_id = $request->input('user_id');
        $case_id = $request->input('case_id');
        $case = Cases::find($case_id);
        $user= User::find($case->user_id);
        //if($case->user_id == $user_id){
        if($case->status ==1)
        {
            $bill = Bill::create([
                'case_id' => $case_id,
                'total_price' => $request['total_price']
            ]);   
            $user->wallet = $user->wallet - $request['total_price'];
            $user->save();
            return redirect()->back()->with('success','bill created successfully'); 
        }
        return redirect()->back()->with('error','Status Not Done Yet');
        }
    
    //----------------------------------------------------------------

            public function search_bills(Request $request)
        {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        
        $case = Cases::query()
            ->select('cases.id as case_id','cases.patient_name','bills.total_price','cases.created_at')
            ->join('bills','bills.case_id','cases.id')
            ->where('cases.user_id','=',Auth::user()->id)
            ->whereBetween('bills.created_at', [$start_date, $end_date])
            ->get();
        //where('user_id',Auth::user()->id)
        return response()->json([
            'message'=>'All Bill for this user Between this date',
            'All bills' => $case
    
        ]);
        }
    //----------------------------------------------------------------
    //need Testing
    public function details_bill(Request $request)
    {
        $bill_id = $request->input('bill_id');
        $case_id = $request->input('case_id');
        $bill = Bill::find($bill_id);
        $case = Cases::find($case_id);
        if($case){
        if ($bill)
        {
            $z=$case->select('cases.id as case_id', 'cases.patient_name', 'bills.*', 'cases.created_at')
    ->join('bills', 'bills.case_id', 'cases.id')
    ->where('cases.user_id', '=', Auth::user()->id)
    ->get();

return response()->json([
    'Details Bill' => $z
]);

        }
        return response()->json(['message'=>'Bill not found']);
    }
    return response()->json(['message'=>'Case not found']);
}
    
//----------------------------------------------------------------
    public function all_bills()
    {
        
        $case = Cases::query()
        ->select('cases.id as case_id','cases.patient_name','bills.total_price','cases.created_at')
        ->join('bills','bills.case_id','cases.id')
        ->where('cases.user_id',Auth::user()->id)
        ->get();
        return response()->json([
            'message' => 'All Bills from You',
            'Bills' =>$case
        ]);
    }
    //--------------------------------------------------------------------------------

    public function all_bills_user(Request $request)
    {
        $user_id = $request->input('user_id');
        $user = User::find($user_id);
        if($user){
        $case = Cases::query()
        ->select('cases.id as case_id','cases.patient_name','bills.total_price','cases.created_at')
        ->join('bills','bills.case_id','cases.id')
        ->where('cases.user_id','=',$request['user_id'])
        ->get();
        return response()->json([
            'message' => 'All Bills from this user',
            'Bills' =>$case
        ]);
    }
    return 'User not found';
    }
    //--------------------------------------------------------------------------------

    public function search_bills_user(Request $request)
{
    $start_date = $request->input('start_date');
    $end_date = $request->input('end_date');
    
    $bill = Cases::
        select('cases.id as case_id', 'cases.patient_name', 'bills.*', 'bills.created_at')
        ->join('bills', 'bills.case_id', 'cases.id')
        ->whereBetween('bills.created_at', [$start_date, $end_date])
        ->get();
        
    return view('Bills.index', compact('bill'));
}

    
    //----------------------------------------------------------------

    public function all_bill_admin()
    {
        $bill = Bill::all();
        return view('Bills.index', compact('bill'));
    }

    //----------------------------------------------------------------
    public function delete_bill(Request $request)
    {
        //dd($request);
        try {
            $id = $request->input('id');
            $bill = Bill::find($id);
    
            if (!$bill) {
                return redirect()->back()->with('error', 'Case not found');
            }
    
            else {
                $bill->delete();
                return redirect()->back()->with('success', 'Bill deleted successfully');
            } 
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }



    public function update_bill(Request $request)
    {
        $bill_id = $request->input('bill_id');   
        $price = $request->input('paid_price');
        if ($price === 0) {
            return response()->json(['message' => 'Price cannot be null']);
        }
    
        $bill = Bill::find($bill_id);
        
        if($bill)
        {
            $case_id = $bill->case_id;
            $case = Cases::find($case_id);
            $user = User::query()->where('id', '=', $case->user_id)->first();
    
            if ($bill->is_paid == 1 && $bill->paid_price != 0) {
                $user->wallet += $price;
                $bill->paid_price += $price;
            } else if ($bill->is_paid == 0 && $bill->paid_price == 0) {
                $user->wallet += $price;
                $bill->is_paid = 1;
                $bill->paid_price = $price;
            }
    
            $bill->save();
            $user->save();
            return 'success';
        }
        else {
            return 'Not Found';
        }
    }
    
}



/*
public function search_bills_user(Request $request)
{
    $user_id = $request->input('user_id');
    $start_date = $request->input('start_date');
    $end_date = $request->input('end_date');
    $user = User::find($user_id);
    
    if ($user) {
        $cases = Cases::query()
            ->select('cases.id as case_id', 'cases.patient_name', 'bills.total_price', 'cases.created_at')
            ->join('bills', 'bills.case_id', 'cases.id')
            ->where('cases.user_id', '=', $user_id)
            ->whereBetween('bills.created_at', [$start_date, $end_date])
            ->orWhere(function ($query) use ($start_date, $end_date) {
                $query->where('cases.user_id', '=', $user_id)
                      ->whereHas('bill', function ($query) use ($start_date, $end_date) {
                          $query->whereBetween('created_at', [$start_date, $end_date]);
                      });
            })
            ->get();
            
        return $cases;
    }
    
    return 'User not found';
}*/