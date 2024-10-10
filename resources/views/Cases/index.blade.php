@extends('layouts.master')

@section('title')
    {{-- Title here --}}
    الحالات
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
    جميع الحالات
@endsection

@section('son2')
    {{-- son2 --}}
    
@endsection

@section('content')
    {{-- content --}}


    <div class="card card-teal">
        <div class="card-header">
            <h1 class="card-title col-md-6"><b>جميع الحالات</b></h1>
            <div class="card-tools">
    
                <button type="button" class="btn btn-tool " data-card-widget="remove"><i class="fas fa-times"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                        class="fas fa-minus"></i></button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <a href="{{ route('Cases.add') }}" class="btn btn-outline-success">
                <b>إضافة حالة جديدة</b>
            </a>
        </div>
        
            
            
            <table id="example2" class="table table-bordered table-striped bg-white">
                <thead>
                    <tr>
                        <th>رقم الحالة</th>
                        <th>اسم الطبيب</th>
                        <th>اسم المريض</th>
                        <th>تاريخ الانشاء</th>
                        <th>معلومات اضافية</th>
                    </tr>
                </thead>
                <tbody>
                     
    
                     @foreach($case as $cases)
       
                     <tr>
                         <td>
                             {{ $cases ->id }}
                             
                         </td>
                         <td>
                             {{ $cases->first_name}}
                             
                         </td>
                         <td>
                             {{ $cases->patient_name}}
                             
                         </td>
                          <td>
                             {{$cases ->created_at}}
                             
                         </td>

                          <td>
                            <form action="{{ route('Cases.details') }}" method="POST">
                                @csrf
                                    
                                {{-- <input type="hidden" name="user_id" value="{{ $cases->user_id }}"> --}}
                                <input type="hidden" name="case_id" value="{{ $cases->id }}">
                                
                                <button type="submit" class="btn btn-outline-info">
                                    <b>تفاصيل</b>
                                </button>
                            </form>
                             <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                     data-target="#delete{{ $cases->id }}"
                                      
                                     title="حذف"><i
                                     class="fa fa-trash"></i>
                                 </button>
                                 
                         </td>
                     </tr>
    
                            {{-- edit form --}}
                          
                </tbody>
                                   {{-- id="delete{{ $users->id }}" --}}
                                   <div class="modal fade" id="delete{{ $cases->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                   <div class="modal-dialog" role="document">
                                       <div class="modal-content">
                                           <div class="modal-header">
                                               <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title text-dark"
                                                   id="exampleModalLabel">
                                                   {{ trans('حذف الحالة') }}
                                               </h5>
                                               <button type="button" class="close" data-dismiss="modal"
                                                       aria-label="Close">
                                                   <span aria-hidden="true">&times;</span>
                                               </button>
                                           </div>
                                           <div class="modal-body">
                                               <form action="{{route('Cases-del')}}" method="post" >
                                                   {{-- {{method_field('Delete')}} --}}
                                                   @csrf
                                                 <h6 style="font-family: 'Cairo', sans-serif;" class="modal-title text-dark">
                                                    {{ trans('هل أنت متأكد من عملية الحذف ؟') }}
            
                                                 </h6>
                                                   
                                                 <input id="id" type="hidden" name="id" class="form-control" value="{{ $cases->id }}">
                                                         
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
        <!-- /.card-body -->
    </div>
@endsection

@section('scipts')
    {{-- Scripts here --}}
    <script>
        function addNote() {
            let title = document.getElementById('title').value;
            let date = document.getElementById('date').value;
            let note = document.getElementById('note').value;

            if (title && date && note) {
                let newNote = `
                    <div class="note">
                        <h3>${title}</h3>
                        <p>التاريخ: ${date}</p>
                        <p>${note}</p>
                        <span class="delete" onclick="deleteNote(this)">حذف</span>
                    </div>
                `;
                document.getElementById('notesList').innerHTML += newNote;
                document.getElementById('title').value = '';
                document.getElementById('date').value = '';
                document.getElementById('note').value = '';
            } else {
                alert('يرجى إدخال جميع الحقول.');
            }
        }

        function deleteNote(element) {
            element.parentNode.remove();
        }
    </script>
@endsection
