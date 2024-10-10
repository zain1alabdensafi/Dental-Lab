@extends('layouts.master')

@section('title')
    {{-- Title here --}}
    الرئيسيه
@endsection {{-- or @stop --}}

@section('css')
<link
href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.5/af-2.7.0/b-3.0.2/b-colvis-3.0.2/b-html5-3.0.2/b-print-3.0.2/cr-2.0.1/fc-5.0.0/r-3.0.2/sb-1.7.1/sp-2.3.1/sl-2.0.1/datatables.min.css"
rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script
src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.5/af-2.7.0/b-3.0.2/b-colvis-3.0.2/b-html5-3.0.2/b-print-3.0.2/cr-2.0.1/fc-5.0.0/r-3.0.2/sb-1.7.1/sp-2.3.1/sl-2.0.1/datatables.min.js">
</script>
@endsection

@section('root')
    {{-- root --}}
    لوحة التحكم
@endsection

@section('son1')
    {{-- son1 --}}
    الأمثلة
@endsection

@section('son2')
    {{-- son2 --}}
    صفحة جديدة
@endsection

@section('content')
    
 <section class="content">
        <div class="container-fluid ">
            <br>
            {{-- Secretary أمين السر --}}
            {{-- Rows --}}
            <div class="row">


                <!-- ./col  -->
                <div class="col-md-4 col-3">
                    <!-- small card -->
                    <div class="small-box bg-teal">
                        <div class="inner">
                            <h5 class="text-white">جميع الحالات</h5>

                            {{-- <p class="text-white">2</p> --}}
                        </div>
                        <br>
                        <br>
                        <div class="icon">
                            <i class="fas fa fa-th"></i>
                        </div>
                        <a href="{{ url('./Cases', []) }}" target="_blank" class="small-box-footer">
                            <h6 class="text-white">إدارة <i class="fas fa-arrow-circle-right"></i></h6>
                        </a>
                    </div>
                </div>
                <!-- ./col -->

                <!-- ./col -->
                <div class="col-md-4 col-3">
                    <!-- small card -->
                    <div class="small-box bg-teal">
                        <div class="inner">
                            <h5 class="text-white">الفواتير</h5>

                            {{-- <p class="text-white">2</p> --}}
                        </div>
                        <br>
                        <br>
                        <div class="icon">
                            <i class="fas fa fa-receipt"></i>
                           
                        </div>
                        <a href="{{ url('/Bills', []) }}" target="_blank" class="small-box-footer">
                            <h6 class="text-white">إدارة <i class="fas fa-arrow-circle-right"></i></h6>
                        </a>
                    </div>
                </div>
                <!-- ./col -->

                {{-- <div class="col-md-4 col-3">
                    <div class="small-box bg-teal">
                        <div class="inner">
                            <h5 class="text-white">المخزن</h5>

                            
                        </div>
                        <br>
                        <br>
                        <div class="icon">
                            
                            <i class="fas fa fa-warehouse"></i>
                        </div>
                        <a href="{{ url('./web/employees', []) }}" target="_blank" class="small-box-footer">
                            <h6 class="text-white">إدارة <i class="fas fa-arrow-circle-right"></i></h6>
                        </a>
                    </div>
                </div> --}}
                
                <!-- ./col -->
                <br>
                


                    <!-- ./col  -->
                    <div class="col-md-4 col-3">
                        <!-- small card -->
                        <div class="small-box bg-teal">
                            <div class="inner">
                                <h5 class="text-white">جميع الزبائن</h5>
    
                                {{-- <p class="text-white">2</p> --}}
                            </div>
                            <br>
                            <br>
                            <div class="icon">
                                <i class="fas fa fa-users"></i>
                            </div>
                            <a href="{{ url('./Clients', []) }}" target="_blank" class="small-box-footer">
                                <h6 class="text-white">إدارة <i class="fas fa-arrow-circle-right"></i></h6>
                            </a>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="col-md-4 col-3">
                        <!-- small card -->
                        <div class="small-box bg-teal">
                            <div class="inner">
                                <h5 class="text-white">المستودع</h5>
    
                                {{-- <p class="text-white">2</p> --}}
                            </div>
                            <br>
                            <br>
                            <div class="icon">
                                <i class="fas fa fa-users"></i>
                            </div>
                            <a href="{{ url('./Inventory', []) }}" target="_blank" class="small-box-footer">
                                <h6 class="text-white">إدارة <i class="fas fa-arrow-circle-right"></i></h6>
                            </a>
                        </div>
                    </div>
                


            </div>


        </div>
        <!-- /.container-fluid -->
    </section>








@endsection

@section('scipts')
    {{-- Scripts here --}}
@endsection
