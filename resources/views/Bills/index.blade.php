@extends('layouts.master')

@section('title')
    {{-- Title here --}}
    الفواتير
@endsection {{-- or @stop --}}


@section('css')
    {{-- Css here --}}
    <!-- daterange picker -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css')}}">

  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet"  href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet"  href="{{ asset('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet"  href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet"  href="{{ asset('assets/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet"  href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet"  href="{{ asset('assets/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
  <!-- BS Stepper -->
  <link rel="stylesheet"  href="{{ asset('assets/plugins/bs-stepper/css/bs-stepper.min.css')}}">
  <!-- dropzonejs -->
  <link rel="stylesheet"  href="{{ asset('assets/plugins/dropzone/min/dropzone.min.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">



@endsection

@section('root')
    لوحة التحكم
@endsection
@section('son1')
    الفواتير
@endsection



  @section('son2')
  
    {{-- <div class="input-group input-group-sm">
      <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
      <div class="input-group-append">
        <button class="btn btn-navbar" type="submit">
          <i class="fas fa-search"></i>
        </button>
      </div>
    </div> --}}
   
 

@endsection

@section('content')
    {{-- content --}}
    <div class="card card-teal">
        <div class="card-header">
            <h1 class="card-title col-md-6"><b>الفواتير</b></h1>
            
            
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
            <form action="{{ url('/groups/add', []) }}" method="POST">
                @csrf
    
                <!-- /.card-body -->


                <button type="button" class="btn  btn-outline-success" data-toggle="modal" data-target="#exampleModal">
                    <b>إضافة فاتورة جديدة</b>
                </button>
                <br>
               
    
            </form>
            <hr class="bg-green">
            <!-- SEARCH FORM -->
            <div class="row">
                <div class="col">
                  <form action="{{ route('search_bills_user') }}" method="GET">
                    <label for="start_date">Start Date:</label>
                    <input type="date" id="start_date" name="start_date">
                    <label for="end_date">End Date:</label>
                    <input type="date" id="end_date" name="end_date">
                    <input type="submit" value="Submit">
                </form>                
                </div>
            </div>
            
     

        
      
            
            <table id="example2" class="table table-bordered table-striped bg-white">
                <thead>
                    <tr>
                        <th>معرف الفاتورة</th>
                        <th>معرف الحالة</th>
                        <th>عملبة الدفع</th>
                        <th>القيمة المدفوعة</th>
                        <th>السعر الكلي</th>
                        <th>تاريخ الإنشاء</th>
                        <th>معلومات إضافيه</th>    
                    </tr>
                </thead>
                <tbody>    
                    <tr>
                     @foreach($bill as $bills)
                     <tr>
                         <td>
                             {{ $bills ->id }}
                             
                         </td>
                         <td>
                             {{ $bills->case_id}}
                             
                         </td>
                         <td>
                             {{ $bills->is_paid}}
                             
                         </td>
                         <td>
                          {{ $bills->paid_price}}
                          
                      </td>
                      <td>
                        {{ $bills->total_price}}
                    </td>
                          <td>
                             {{$bills ->created_at}}
                             
                         </td>
                        
                        <td>
                          <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                  data-target="#edit
                                  {{-- {{ $Grade->id }} --}}
                                   "
                                  title="تعديل"><i
                                  class="fa fa-edit"></i></button>
                                  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                  data-target="#delete{{ $bills->id }}"
                                   
                                  title="حذف"><i
                                  class="fa fa-trash"></i>
                              </button>
                      </td>

                    </tr>
                     <br>
                     <div class="modal fade" id="edit" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                       <div class="modal-dialog" role="document">
                           <div class="modal-content">
                               <div class="modal-header">
                                   <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title text-dark"
                                       id="exampleModalLabel">
                                       {{ trans('تعديل الفاتورة') }}
                                   </h5>
                                   <button type="button" class="close" data-dismiss="modal"
                                           aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                   </button>
                               </div>
                               <div class="modal-body">
                                   <!-- add_form -->
                                   <form action="{{route('update_bill')}}"method="post">
                                       {{-- {{method_field('patch')}} --}}
                                       @csrf
                                       <div class="row">
                                           <div class="col">
                                               <label for="bill_id"
                                                      class="mr-sm-2 text-dark">  
                                                     رقم الفاتورة
                                                   :</label>
                                                   <input id="bill_id" class="form-control bg- light" type="number" name="bill_id" required />
                                           </div>
                                           <div class="col">
                                               <label for="paid_price"
                                                      class="mr-sm-2 text-dark">
                                                      المبلغ المدفوع
                                                   :</label>
                                                   <input id="paid_price" class="form-control bg- light" type="number" name="paid_price" required />
                                           </div>
                                       </div>
                                      
                                
                                    
                                       <br><br>

                                       <div class="modal-footer">
                                           <button type="button" class="btn btn-secondary"
                                                   data-dismiss="modal">اغلاق</button>
                                           <button type="submit"
                                                   class="btn btn-success">تأكيد</button>
                                       </div>
                                   </form>

                               </div>
                           </div>
                       </div>
                   </div>

                   <!-- delete_modal_Grade -->

                   <div class="modal fade" id="delete{{ $bills->id }}" tabindex="-1" role="dialog"
                   aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title text-dark"
                                  id="exampleModalLabel">
                                  {{ trans('حذف فاتورة') }}
                              </h5>
                              <button type="button" class="close" data-dismiss="modal"
                                      aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">
                              <form action="{{route('Bills-del')}}" method="post" >
                                  {{-- {{method_field('Delete')}} --}}
                                  @csrf
                                <h6 style="font-family: 'Cairo', sans-serif;" class="modal-title text-dark">
                                   {{ trans('هل أنت متأكد من عملية الحذف ؟') }}

                                </h6>
                                  
                                  <input id="id" type="hidden" name="id" class="form-control"value="{{ $bills->id }}">
                                         
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
    
                </tbody>
                @endforeach
    
            </table>
        </div>
        <!-- /.card-body -->
        {{--  --}}

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                       <div class="modal-dialog" role="document">
                           <div class="modal-content">
                               <div class="modal-header">
                                   <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title text-dark"
                                       id="exampleModalLabel">
                                  {{ trans('إضافة فاتورة') }}

                        
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
    
                    <form class=" row mb-30" action="{{ route('Bills-ad') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="repeater">
                                
                                <div data-repeater-list="List_Classes">
                                    <div data-repeater-item>
                                        <div class="row">
    
                                            <div class="col">
                                            <div class="form-group text-dark">
                                                <label for="case_id">معرف الحالة</label>
                                                <input id="case_id" class="form-control bg- light" type="number" name="case_id" required />
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                  <div class="col">
                                    <div class="form-group text-dark">
                                        <label for="total_price">السعر الكلي</label>
                                        <input id="total_price" class="form-control bg- light" type="number" name="total_price" required />
                                    </div>
                                    </div>
                              </div>
                              
                              </div>
                            </div>
                                 <!-- Date range -->
                                
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












        {{--  --}}
    </div>
@endsection

@section('scipts')
    {{-- Scripts here --}}
<!-- Bootstrap4 Duallistbox -->
<script type="text/javascript" src="{{ URL::asset('assets/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
<!-- InputMask -->
<script type="text/javascript" src="{{ URL::asset('assets/plugins/moment/moment.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
<!-- date-range-picker -->
<script type="text/javascript" src="{{ URL::asset('assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- bootstrap color picker -->
<script type="text/javascript" src="{{ URL::asset('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script type="text/javascript" src="{{ URL::asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- BS-Stepper -->
<script type="text/javascript" src="{{ URL::asset('assets/plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>
<!-- dropzonejs -->
<script type="text/javascript" src="{{ URL::asset('assets/plugins/dropzone/min/dropzone.min.js')}}"></script>
   <!-- AdminLTE App -->
<script type="text/javascript" src="{{ URL::asset('assets/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script type="text/javascript" src="{{ URL::asset('assets/dist/js/demo.js')}}"></script>
<!-- Page specific script -->

<script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()
  
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
  
      //Datemask dd/mm/yyyy
      $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
      //Datemask2 mm/dd/yyyy
      $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
      //Money Euro
      $('[data-mask]').inputmask()
  
      //Date picker
      $('#reservationdate').datetimepicker({
          format: 'L'
      });
  
      //Date and time picker
      $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });
  
      //Date range picker
      $('#reservation').daterangepicker()
      //Date range picker with time picker
      $('#reservationtime').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        locale: {
          format: 'MM/DD/YYYY hh:mm A'
        }
      })
      //Date range as a button
      $('#daterange-btn').daterangepicker(
        {
          ranges   : {
            'Today'       : [moment(), moment()],
            'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month'  : [moment().startOf('month'), moment().endOf('month')],
            'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate  : moment()
        },
        function (start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
        }
      )
  
      //Timepicker
      $('#timepicker').datetimepicker({
        format: 'LT'
      })
  
      //Bootstrap Duallistbox
      $('.duallistbox').bootstrapDualListbox()
  
      //Colorpicker
      $('.my-colorpicker1').colorpicker()
      //color picker with addon
      $('.my-colorpicker2').colorpicker()
  
      $('.my-colorpicker2').on('colorpickerChange', function(event) {
        $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
      })
    })
    // BS-Stepper Init
    document.addEventListener('DOMContentLoaded', function () {
      window.stepper = new Stepper(document.querySelector('.bs-stepper'))
    })
  
    // DropzoneJS Demo Code Start
    Dropzone.autoDiscover = false
  
    // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
    var previewNode = document.querySelector("#template")
    previewNode.id = ""
    var previewTemplate = previewNode.parentNode.innerHTML
    previewNode.parentNode.removeChild(previewNode)
  
    var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
      url: "/target-url", // Set the url
      thumbnailWidth: 80,
      thumbnailHeight: 80,
      parallelUploads: 20,
      previewTemplate: previewTemplate,
      autoQueue: false, // Make sure the files aren't queued until manually added
      previewsContainer: "#previews", // Define the container to display the previews
      clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
    })
  
    myDropzone.on("addedfile", function(file) {
      // Hookup the start button
      file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
    })
  
    // Update the total progress bar
    myDropzone.on("totaluploadprogress", function(progress) {
      document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
    })
  
    myDropzone.on("sending", function(file) {
      // Show the total progress bar when upload starts
      document.querySelector("#total-progress").style.opacity = "1"
      // And disable the start button
      file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
    })
  
    // Hide the total progress bar when nothing's uploading anymore
    myDropzone.on("queuecomplete", function(progress) {
      document.querySelector("#total-progress").style.opacity = "0"
    })
  
    // Setup the buttons for all transfers
    // The "add files" button doesn't need to be setup because the config
    // `clickable` has already been specified.
    document.querySelector("#actions .start").onclick = function() {
      myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
    }
    document.querySelector("#actions .cancel").onclick = function() {
      myDropzone.removeAllFiles(true)
    }
    // DropzoneJS Demo Code End
  </script>
@endsection
