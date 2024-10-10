@extends('layouts.master')

@section('title')
   تفاصيل الحالة
@endsection

@section('css')
    {{-- Css here --}}
@endsection

@section('root')
<a href="{{ route('main') }}"class=" form-group text-green  ">  
    <b>لوحة التحكم</b>
                                </a>
@endsection

@section('son1')
<a href="{{ route('Cases') }}"class=" form-group text-green  ">  
    <b>الحالات</b>
                                </a>
@endsection

@section('son2')

عرض تفاصيل الحالة
@endsection

@section('content')
    {{-- content --}}
    {{--  --}}


    <br>
    <div class="justify-content-center">
       

        <div class="col col-md-7">
           
            <form action="{{ url('/groups/add', []) }}" method="POST">
                @csrf
    
                <!-- /.card-body -->

                <button type="button"class="btn btn-outline-success " data-toggle="modal" data-target="#edit">
                    <b>تعديل الحالة</b>
                </button>
    
            </form>
   
        </div>
        <br>
        <div class="card card-teal">
            <div class="card-header">
                <h1 class="card-title col-md-7"><b> تفاصيل حالة الحاله</b></h1>
                <div class="card-tools">

                    <button type="button" class="btn btn-tool " data-card-widget="remove"><i class="fas fa-times"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                            class="fas fa-expand"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                
                <form method="POST" action="{{ route('Cases.details') }}">
                    @csrf
                    
    
                    <div class="card-body">
    
                        <div class="row">
    
                            <div class="form-group text-gray col-sm-8">
                                <table id="example2" class="table table-bordered table-striped bg-white">
                                    <thead>
                                        <tr>
                                            <th>رقم الأسنان المتصلة بالجسر</th>
                                            <th>رقم الأسنان المفردة</th>
                                            <th>رقم العلاج </th>
                                            <th>رقم المادة</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        {{-- @dd($caseDetails) --}}
                                        
                                        <tr>
                                            <td>
                                                {{ trim($caseDetails->teeth_number, '"') }}
                                                {{-- {{ $caseDetails->teeth_number }} --}}
                                            </td>
                                        
                                        
                                                <td>
                                                    {{-- {{ trim($caseDetails->tooth_number, '"') }} --}}
                                                    {{ $caseDetails->tooth_number}}
                                                    
                                                </td>
                                          
                                                <td>
                                                    
                                                    {{ $caseDetails->treatment_id}}
                                                    
                                                </td>
                                                 <td>
                                                    {{$caseDetails->material_id}}
                                                    
                                                </td>
                                                 
                                                 <td>
                                               
                                        </tr>
                                        <br>
                        
                                     
                                    </tbody>
                                </table>
    
                            </div>
    
                        </div>
    
                    </div>
    
                    <!-- /.card-body -->
                    <br>
    
                </form>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
       

        <br>
       
       
    </div>

    <br>  






{{--  --}}

    <br>
    <div class="justify-content-center">

        <div class="card card-teal">
            <div class="card-header">
                <h1 class="card-title col-md-7"><b> التفاصيل</b></h1>
                <div class="card-tools">

                    <button type="button" class="btn btn-tool " data-card-widget="remove"><i class="fas fa-times"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                            class="fas fa-expand"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                
                <form method="GET" action="{{ route('Cases') }}">
                    @csrf
                    @method('GET')
                
                    <div class="card-body">
                
                        <div class="row">
                
                            <div class="form-group text-gray col-sm-4">
                                <label for="name">رقم الزبون</label>
                                <br>
                                <input type="number" name="user_id" value="{{ $caseDetails->user_id }}" readonly>
                            </div>
                
                            <div class="form-group text-gray col-sm-4">
                                <label for="name">اسم المريض</label>
                                <br>
                                <input type="text" name="patient_name" value="{{ $caseDetails->patient_name }}" readonly>
                            </div>
                
                            <div class="form-group text-gray col-sm-4">
                                <label for="name">جنس المريض</label>
                                <br>
                                <input type="text" name="gender" value="{{ $caseDetails->gender }}" readonly>
                            </div>
                
                            <hr class="bg-green">
                
                        </div>
                
                        <div class="row">
                
                            <div class="form-group text-gray col-sm-4">
                                <label for="name">العمر</label>
                                <br>
                                <input type="number" name="age" value="{{ $caseDetails->age }}" readonly>
                            </div>
                
                            <div class="form-group text-gray col-sm-4">
                                <label for="name">اللون</label>
                                <br>
                                <input type="text" name="shade" value="{{ $caseDetails->shade }}" readonly>
                            </div>
                
                            <div class="form-group text-gray col-sm-4">
                                <label for="name">حالة الطلب</label>
                                <br>
                                <input type="number" name="status" value="{{ $caseDetails->status }}" readonly>
                            </div>
                
                            <hr class="bg-green">
                
                        </div>
                
                        <div class="row">
                
                            <div class="form-group text-gray col-lg-4">
                                <label for="name">موعد التسليم</label>
                                <br>
                                <input type="date" name="expect_delivery_time" value="{{ $caseDetails->expect_delivery_time }}" readonly>
                            </div>
                
                            <hr class="bg-green">
                
                        </div>
                
                        <div class="row">
                
                            <div class="form-group text-gray col-sm-4">
                                <label for="name">الملاحظات</label>
                                <br>
                                <input type="text" name="notes" value="{{ $caseDetails->notes }}" readonly>
                            </div>
                
                        </div>
                
                    </div>
                </form>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.card -->

        <br>
       
        <!-- /.card -->

       
        <!-- /.card -->
    </div>

    <br>
                                {{--  --}}
                                {{-- update --}}
                      {{-- id="edit{{ $Grade->id }}" --}}
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form class=" row mb-30" action="{{ route('Clients') }}" method="POST">
                    {{-- {{method_field('patch')}} --}}
                    @csrf
                    <div class="card-body">

                        <div class="row">
    
                            <div class="form-group text-green col-sm-4">
                                <label for="name">رقم الزبون</label>
                                <input id="id" class="form-control bg- light" type="id" name="name" 
                                {{-- value="{{ $Grade->id }}" --}}
                                
                                required />
                            </div>
    
                            <div class="form-group text-green col-sm-4">
                                <label for="name">اسم المريض</label>
                                <input id="name" class="form-control bg- light" type="text" name="name"
                                {{-- value="{{ $Grade->id }}" --}}
                                required />
                            </div>
    
                            <div class="form-group text-green col-sm-4">
                                <label for="name">جنس المريض</label>
                                
                                <div class="form-check">
                                    <input  type="radio" name="gender" id="female"
                                    {{-- value="{{ $Grade->id }}" --}}
                                    
                                    checked>
                                    <label for="female">
                                    أنثى   
                                    </label>
                                  </div>
                                      <div class="form-check">
                                        <input  type="radio" name="gender" id="male"
                                        {{-- value="{{ $Grade->id }}" --}}
                                         checked>
                                        <label for="male">
                                            ذكر 
                                        </label>
                                      </div>
                                      
                            </div>
    
                        </div>
    
                        <div class="row">
                            <div class="form-group text-green col-sm-4">
                                <label for="age">العمر</label>
                                <input id="" class="form-control bg- light" type="text" name="name"
                                {{-- value="{{ $Grade->id }}" --}}
                                 required />
                            </div>
    
    
                            <div class="form-group text-green col-sm-4">
                                <label for="shade">اللون</label>
    
                                <select class="form-select" name="" >
                                    <option value="">Shade</option>
                                     {{-- @foreach($category as $category) --}}
                                    <option value="">accessory</option>
                                    <!-- <option value="">shoose</option>
                                    <option value="">accessory</option> -->
                                    {{-- @endforeach --}}
                                </select>
                            </div>
    
                            <div class="form-group text-green col-lg-4">
                                <hr>
                                
                                <div class="form-check">
                                    <input type="checkbox" id="vehicle1" name="vehicle1"
                                    {{-- value="{{ $Grade->id }}" --}}
                                     value="Bike">
                                    <label for="vehicle1"> يتطلب اعاده</label><br>
                                      <input type="checkbox" id="vehicle1" name="vehicle1"
                                      {{-- value="{{ $Grade->id }}" --}}
                                       value="Bike">
                                      <label for="vehicle1"> يتطلب تجربة</label><br>
                            </div>
                        </div>
    
                        <div class="row">
    
                            <div class="form-group text-green col-sm-4">
                                <label for="date">موعد التسليم</label>
                                        <input id="date" class="form-control bg- light" type="date" name="date" required />
                                        
                                        @error('date')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                            </div>
                            <div class="form-group text-green col-sm-4">
                                <label for="name">اضافة صورة</label>
                                {{-- @if($products->image)
				            <img src="{{asset('assets/uploads/product/'.$products -> image)}}" alt="" >
				               @endif --}}
                                <input id="name" class="form-control" type="file" name="name" required />
                            </div>
    
                        </div>
                        <div class="row">
    
                            <div class="form-group text-green col-sm-8">
                                <label for="name">الملاحظات</label>
                                      <textarea class="form-control"  placeholder="..."></textarea>
                            </div>
    
                        </div>
                    </div>    
                            
                <!-- /.input group -->
             

                            <div class="modal-footer">
                                {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('خروج') }}</button> --}}
                                <button type="submit" class="btn btn-success">{{ trans('تاكيد') }}</button>
                            </div>


                        </div>
                    </div>
                </form>
            </div>


        </div>

    </div>
   </div>
@endsection

@section('scipts')
    {{-- Scripts here --}}
@endsection
