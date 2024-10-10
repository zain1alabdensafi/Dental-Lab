@extends('layouts.master')

@section('title')
    {{-- Title here --}}
    الزبائن
@endsection {{-- or @stop --}}

@section('css')
    {{-- Css here --}}
@endsection

@section('root')
    {{-- root --}}
    <a href="{{ route('main') }}"class=" form-group text-green  ">  
        <b>لوحة التحكم</b>
     </a>
 @endsection
@section('son1')
    {{-- son1 --}}
    جميع الزبائن
@endsection

@section('son2')
    {{-- son2 --}}
    {{-- صفحة جديده --}}
@endsection

@section('content')
    {{-- content --}}

    <br>
    <div class="row justify-content-center align-items-center">
        <div class="col col-md-7">
            {{-- <form method="Get" action="{{ route('Clients-add') }}">
                @csrf
                @method('Get')
   
                <!-- /.card-body -->
   
                <div class="col-md-10  justify-content-center align-items-center">
                    <a href="{{ route('Clients') }}" target="_blank" type="submit"
                        class="btn btn-outline-success col  justify-content-center align-items-center">
                       اضافة زبون جديد
                    </a>
                </div>

            </form> --}}
            <form action="{{ url('/groups/add', []) }}" method="POST">
                @csrf
    
                <!-- /.card-body -->


                <button type="button"class="btn btn-outline-success col  justify-content-center align-items-center" data-toggle="modal" data-target="#exampleModal">
                    <b>اضافة زبون جديد</b>
                </button>
    
            </form>
   
        </div>
   
    </div>
    <br>
   
    <div class="card card-teal">
        <div class="card-header">
            <h1 class="card-title col-md-7"><b></b></h1>
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
            <table id="example2" class="table table-bordered table-striped bg-white">
                <thead>
   
                    <tr>
                        <th>المعرف </th>
                        <th>اسم الطبيب</th>
                        <th>اللقب</th>
                        <th>الايميل</th>
                        <th>رقم الهاتف</th>
                        <th>تفاصيل اضافيه</th>
   
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach($user as $users)
   
                    <tr>
                        <td>
                            {{ $users ->id }}
                            
                        </td>
                        <td>
                            {{ $users->first_name}}
                            
                        </td>
                        <td>
                            {{ $users->last_name}}
                            
                        </td>
					 	<td>
                            {{$users ->email}}
                            
                        </td>
					 	<td>
                            {{$users ->phone_number}} 
                        </td>
                         <td>
                            
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                    data-target="#edit{{ $users->id }}"
                                    title="تعديل"><i
                                    class="fa fa-edit"></i></button>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#delete{{ $users->id }}"
                                     
                                    title="حذف"><i
                                    class="fa fa-trash"></i>
                                </button>
                        </td>
                    </tr>
                    <!-- edit_modal_Grade -->
                    <div class="modal fade" id="edit{{ $users->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title text-dark" id="exampleModalLabel">
                                        {{ trans('تعديل زبون') }}
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="row mb-30" action="{{ route('Clients') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $users->id }}">
                                        <div class="card-body">
                                            <div class="repeater">
                                                <div data-repeater-list="List_Classes">
                                                    <div data-repeater-item>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group text-dark">
                                                                    <label for="first_name">اسم الطبيب</label>
                                                                    <input id="first_name" class="form-control bg-light" type="text" name="first_name"
                                                                        value="{{ $users->first_name }}" required />
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="form-group text-dark">
                                                                    <label for="last_name">اللقب</label>
                                                                    <input id="last_name" class="form-control bg-light" type="text" name="last_name"
                                                                        value="{{ $users->last_name }}" required />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group text-dark">
                                                                    <label for="phone_number">رقم الهاتف</label>
                                                                    <input id="phone_number" class="form-control bg-light" type="number" name="phone_number"
                                                                        value="{{ $users->phone_number }}" required />
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="form-group text-dark">
                                                                    <label for="email">الايميل</label>
                                                                    <input id="email" class="form-control bg-light" type="email" name="email"
                                                                        value="{{ $users->email }}" required />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('اغلاق') }}</button>
                                                    <button type="submit" class="btn btn-success">{{ trans('تاكيد') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                    <!-- delete_modal_Grade -->
                    
                    <div class="modal fade" id="delete{{ $users->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                       <div class="modal-dialog" role="document">
                           <div class="modal-content">
                               <div class="modal-header">
                                   <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title text-dark"
                                       id="exampleModalLabel">
                                       {{ trans('حذف زبون') }}
                                   </h5>
                                   <button type="button" class="close" data-dismiss="modal"
                                           aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                   </button>
                               </div>
                               <div class="modal-body">
                                   <form action="{{route('Clients-del')}}" method="post" >
                                       {{-- {{method_field('Delete')}} --}}
                                       @csrf
                                     <h6 style="font-family: 'Cairo', sans-serif;" class="modal-title text-dark">
                                        {{ trans('هل أنت متأكد من عملية الحذف ؟') }}

                                     </h6>
                                       
                                     <input id="id" type="hidden" name="id" class="form-control" value="{{ $users->id }}">
                                             
                                       <div class="modal-footer">
                                           <button type="button" class="btn btn-secondary"
                                                   data-dismiss="modal">{{ ('اغلاق') }}</button>
                                           <button type="submit"
                                                   class="btn btn-danger">{{ ('تأكيد') }}</button>
                                       </div>
                                   </form>
                               </div>
                           </div>
                       </div>
                   </div>         
                    @endforeach
   
                
   
            </table>
        </div>
        <!-- /.card- ADD  body -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                        @csrf
                        <div class="card-body">
                            <div class="repeater">
                                <div data-repeater-list="List_Classes">
                                    <div data-repeater-item>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group text-dark">
                                                    <label for="first_name">الأسم الأول للطبيب</label>
                                                    <input name="first_name" class="form-control bg- light" type="text" required />
                                                </div>
                                            </div>
                                            <div class="col">
                                            <div class="form-group text-dark">
                                                <label for="last_name">اللقب</label>
                                                <input name="last_name" class="form-control bg- light" type="text" required />
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                  <div class="col">
                                     <div class="form-group text-dark ">
                                        <label for="name">رقم الهاتف</label>
                                        <input  class="form-control bg- light" type="number" name="phone_number" required />
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-group text-dark ">
                                    <label for="email">الايميل</label>
                                    <input type="email" class="form-control bg- light" name="email" required />
                                  {{-- @error('date')
                                      <div class="alert alert-danger">{{ $message }}</div>
                                  @enderror --}}
                                </div>
                            </div>
                                <div class="row">
                                    <div class="col">
                                    <div class="form-group text-dark">
                                        <label for="password">كلمة المرور</label>
                                        <input type="password" class="form-control bg- light" name="password" required />
                                    </div>
                                    </div>
                                </div>
                              </div>
                            </div>
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
    </div>
    </div>


    </div>
    <!-- /.card -->
    







@endsection

@section('scipts')
    {{-- Scripts here --}}
@endsection
