@extends('layouts.master')

@section('title')
    {{-- Title here --}}
    المستودع
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
            <h1 class="card-title col-md-6"><b>المستودع</b></h1>
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
            <div class="btn-group">
                <div class="col-md-6 col">
                <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#example1Modal">اضافة تصنيف</button>
                </div>
                <div class="col-md-6 col">
                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#example10Modal"> إضافة تصنيف فرعي </button>
                </div>
                <div class="col-md-6 col">
                <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#exampleModal">اضافة عنصر جديد</button>
                </div>
            </div>
        </div>
        
            
            
            <table id="example2" class="table table-bordered table-striped bg-white">
                <thead>
                    <tr>
                        <th>معرف العنصر</th>
                        <th>معرف التصنيف الفرعي</th>
                        <th>اسم العنصر</th>
                        <th>الكمية</th>
                        <th>معلومات اضافية</th>
                    </tr>
                </thead>
                <tbody>
                     
    
                     @foreach($item as $items)
       
                     <tr>
                         <td>
                             {{ $items ->id }}
                             
                         </td>
                         <td>
                             {{ $items->subcategory_id}}
                             
                         </td>
                         <td>
                             {{ $items->name}}
                             
                         </td>
                          <td>
                             {{$items ->quantity}}
                             
                         </td>

                          <td>
                              
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                    data-target="#edit{{ $items->id }}"
                                    title="تعديل"><i
                                    class="fa fa-edit"></i></button>
                            <form action="{{ route('Inventory') }}" method="GET">
                                @csrf
                                    
                                {{-- <input type="hidden" name="user_id" value="{{ $items->user_id }}"> --}}
                                <input type="hidden" name="item_id" value="{{ $items->id }}">
                                
                            
                                </button>
                            </form>
                             <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                     data-target="#delete{{ $items->id }}"
                                      
                                     title="حذف"><i
                                     class="fa fa-trash"></i>
                                 </button>
                         </td>
                     </tr>
    
                     <div class="modal fade" id="edit{{ $items->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title text-dark" id="exampleModalLabel">
                                        {{ trans('تعديل العنصر') }}
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="row mb-30" action="{{ route('Inventory-edit') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $items->id }}">
                                        <div class="card-body">
                                            <div class="repeater">
                                                <div data-repeater-list="List_Classes">
                                                    <div data-repeater-item>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group text-dark">
                                                                    <label for="name">اسم العنصر</label>
                                                                    <input id="name" class="form-control bg-light" type="text" name="name"
                                                                        value="{{ $items->name }}" required />
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="form-group text-dark">
                                                                    <label for="subcategory_id">التصنيف الفرعي المرتبط به</label>
                                                                    <input id="subcategory_id" class="form-control bg-light" type="number" name="subcategory_id"
                                                                        value="{{ $items->subcategory_id }}" required />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group text-dark">
                                                                    <label for="quantity">الكمية</label>
                                                                    <input id="quantity" class="form-control bg-light" type="number" name="quantity"
                                                                        value="{{ $items->quantity }}" required />
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
                          
                </tbody>
                                   {{-- id="delete{{ $users->id }}" --}}
                                   <div class="modal fade" id="delete{{ $items->id }}" tabindex="-1" role="dialog"
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
                                               <form action="{{route('Inventory-del')}}" method="POST" >
                                                   {{-- {{method_field('Delete')}} --}}
                                                   @csrf
                                                 <h6 style="font-family: 'Cairo', sans-serif;" class="modal-title text-dark">
                                                    {{ trans('هل أنت متأكد من عملية الحذف ؟') }}
            
                                                 </h6>
                                                   
                                                 <input id="id" type="hidden" name="id" class="form-control" value="{{ $items->id }}">
                                                         
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
                                           <form class=" row mb-30" action="{{ route('Inventory-add') }}" method="POST">
                                               @csrf
                                               <div class="card-body">
                                                   <div class="repeater">
                                                       <div data-repeater-list="List_Classes">
                                                           <div data-repeater-item>
                                                               <div class="row">
                                                                   <div class="col">
                                                                       <div class="form-group text-dark">
                                                                           <label for="subcategory_id">التصنيف الفرعي</label>
                                                                           <input name="subcategory_id" class="form-control bg- light" type="number" required />
                                                                       </div>
                                                                   </div>
                                                                   <div class="col">
                                                                   <div class="form-group text-dark">
                                                                       <label for="name">اسم العنصر</label>
                                                                       <input name="name" class="form-control bg- light" type="text" required />
                                                                   </div>
                                                                   </div>
                                                               </div>
                                                           </div>
                                                       </div>
                                                       <div class="row">
                                                         <div class="col">
                                                            <div class="form-group text-dark ">
                                                               <label for="quantity">الكمية</label>
                                                               <input  class="form-control bg- light" type="number" name="quantity" required />
                                                       </div>
                                                     </div>
                                                                                                            <div class="row">
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



                               {{-- add sub category --}}

                               <div class="modal fade" id="example10Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                                           <form class=" row mb-30" action="{{ route('Inventory-add2') }}" method="POST">
                                               @csrf
                                               <div class="card-body">
                                                   <div class="repeater">
                                                       <div data-repeater-list="List_Classes">
                                                           <div data-repeater-item>
                                                               <div class="row">
                                                                   <div class="col">
                                                                       <div class="form-group text-dark">
                                                                           <label for="name">اسم التصنيف الفرعي</label>
                                                                           <input name="name" class="form-control bg- light" type="text" required />
                                                                       </div>
                                                                   </div>
                                                                   <div class="col">
                                                                    <div class="form-group text-dark">
                                                                        <label for="category_id">معرف التصنيف المرتبط به</label>
                                                                        <input name="category_id" class="form-control bg- light" type="number" required />
                                                                    </div>
                                                                </div>
                                                                   
                                                                   
                                                                                                            <div class="row">
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
                               
                               {{-- add fo category --}}
                               <div class="modal fade" id="example1Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                                           <form class=" row mb-30" action="{{ route('Inventory-add1') }}" method="POST">
                                               @csrf
                                               <div class="card-body">
                                                   <div class="repeater">
                                                       <div data-repeater-list="List_Classes">
                                                           <div data-repeater-item>
                                                               <div class="row">
                                                                   <div class="col">
                                                                       <div class="form-group text-dark">
                                                                           <label for="name">اسم التصنيف</label>
                                                                           <input name="name" class="form-control bg- light" type="text" required />
                                                                       </div>
                                                                   </div>

                                                                   
                                                                   
                                                                                                            <div class="row">
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
