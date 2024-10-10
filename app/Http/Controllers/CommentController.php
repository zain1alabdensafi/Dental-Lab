<?php

namespace App\Http\Controllers;

use App\Models\Cases;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function add_comment(Request $request)
    {
        $data = Validator::make($request->all(),[
            'case_id' => 'required',
            'comment' => 'required',
        ]);
        if($data->fails())
        {
            return response()->json([
                'message' => $data->errors(),
                'status' => 404
            ]);
        }
        $comment = Comment::create([
            'case_id' => $request['case_id'],
            'comment' => $request['comment']
        ]);
        return response()->json([
            'message' => 'comment created successfully',
            'comment' => $comment,
            'status' => 200
        ]);
    }
    //----------------------------------------------------------------
    
    public function update_comment(Request $request)
    {
        $case = Cases::find($request['case_id']);
        $comment = Comment::find($request['comment_id']);
        if($case)
        {
            if($comment){
            $comment->update($request->all());
            $comment->save();
            return response()->json([
                'message' => 'Comment updated successfully',
                'comment' => $comment,
                'status' => 200
            ]);
        }
        else{
            return response()->json([
                'message'=>'Comment not found',
                 'status'=>404
                ]);
        }
        }
            return response()->json([
            'message' => 'case not found',
            'status' => 404
        ]);
    }
    //----------------------------------------------------------------

    public function all_comments()
    {
        $comment = Comment::query()
        ->select('comments.id','comments.case_id','comment','comments.created_at','comments.updated_at')
        ->join('cases','cases.id','=','comments.case_id')
        ->join('users','users.id','=','cases.user_id')
        ->where('users.id','=',Auth::user()->id)
        ->get();
            return response()->json([
            'message' => 'All Comments',
            'comment'=>$comment,
            'status' =>200
        ]);
    }
    //----------------------------------------------------------------

    public function delete_comment(Request $request)
    {
        $case = Cases::find($request['case_id']);
        $comment = Comment::find($request['comment_id']);
        if($case)
        {
        if($comment)
        {
        $comment->delete();
        return response()->json([
        'message' => 'comment deleted successfully',
        'status' => 200
        ]);
        }
        else{
        return response()->json([
            'message'=>'comment not found',
             'status' =>404
            ]);
        }
        }
        return response()->json([
        'message'=>'case not found',
        'status' =>404
        ]);
    }

    //----------------------------------------------------------------
    //***************************************************************
    //***************************   Admin   *************************
    //***************************************************************
    //***************************************************************
    
    public function add_comment_admin(Request $request)
    {
        $data = Validator::make($request->all(),[
            'user_id' => 'required',
            'case_id' => 'required',
            'comment' => 'required'
        ]);
        if($data->fails())
        {
            return response()->json([
                'message' => $data->errors(),
                'status' =>404
            ]);
        }
        $user_id = User::find($request['user_id']);
        if($user_id){
        $comment = Comment::create([
            'case_id' => $request['case_id'],
            'comment' => $request['comment']
        ]);
        return $comment;
        //return view('',['comment' => $comment]);
        }
    return false;
    }
    //----------------------------------------------------------------

    public function all_comments_case(Request $request)
    {
        $comment = Comment::query()
        ->select('comments.id', 'comments.case_id', 'comments.comment','comments.created_at', 'comments.updated_at')
        ->join('cases','cases.id' ,'=', 'comments.case_id')
        ->where('cases.user_id','=',$request['user_id'])
        ->get();
        if($comment)
        {
        return $comment;
        }
        return false;
    }
    //----------------------------------------------------------------

    public function all_comments_user_admin(Request $request)
    {
        $comment = Comment::query()
        ->select('comments.id', 'comments.case_id', 'comments.comment','comments.created_at', 'comments.updated_at')
        ->join('cases','cases.id' ,'=', 'comments.case_id')
        ->where('cases.id', '=',$request['case_id'])
        ->where('cases.user_id','=',$request['user_id'])
        ->get();
        if($comment)
        {
        return $comment;
        }
        return false;
    }
    //----------------------------------------------------------------

    public function delete_comment_admin(Request $request)
    {
        $user_id = User::find($request['user_id']);
        $case_id = Cases::find($request['case_id']);
        $comment = Comment::find($request['comment_id']);
        if($user_id){
            if($case_id){
            if($comment)
        {
            $comment->delete();
            return 'comment deleted successfully';
        }
        else{
        return 'comment not found';
        }
        }
        else{
            return 'case not found';
        }
        }
        return 'user not found';

    } 
}
