@extends('layouts.master')

@section('title')
    إضافة حالة
@endsection

@section('css')
    {{-- Css here --}}
@endsection

@section('root')
<a href="{{ route('main') }}" class="form-group text-green">
    <b>لوحة التحكم</b>
</a>
@endsection

@section('son1')
<a href="{{ route('Cases') }}" class="form-group text-green">
    <b>الحالات</b></a>
@endsection

@section('son2')
    إضافة حالة
@endsection

@section('content')

<br>
<div class="justify-content-center">
    <div class="card card-teal">
        <div class="card-header">
            <h1 class="card-title col-md-7"><b>اضافة حالة</b></h1>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            </div>
        </div>
        <form id="caseForm" class="row mb-30" action="{{ route('Cases-add') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="form-group text-green col-sm-4">
                        <label for="user_id">رقم الزبون</label>
                        <input id="user_id" class="form-control bg-light" type="number" name="user_id" required />
                    </div>
                    <div class="form-group text-green col-sm-4">
                        <label for="patient_name">اسم المريض</label>
                        <input id="patient_name" class="form-control bg-light" type="text" name="patient_name" required />
                    </div>
                    <div class="form-group text-green col-sm-4">
                        <label for="gender">جنس المريض</label>
                        <div class="form-check">
                            <input type="radio" name="gender" id="female" value="female" checked>
                            <label for="female">أنثى</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="gender" id="male" value="male">
                            <label for="male">ذكر</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group text-green col-sm-4">
                        <label for="age">العمر</label>
                        <input id="age" class="form-control bg-light" type="text" name="age" required />
                    </div>
                    <div class="form-group text-green col-sm-4">
                        <label for="shade">اللون</label>
                        <select class="form-select" name="shade">
                            <option value="">Shade</option>
                            <option value="accessory">accessory</option>
                            <!-- Add more options here -->
                        </select>
                    </div>
                    <div class="form-group text-green col-lg-4">
                        <hr>
                        <div class="form-check">
                            <input type="checkbox" id="need_trial" name="need_trial" value="1">
                            <label for="need_trial"> يتطلب تجربة</label><br>
                            <input type="checkbox" id="repeate" name="repeate" value="1">
                            <label for="repeate"> يتطلب اعاده</label><br>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group text-green col-sm-4">
                        <label for="expect_delivery_time">موعد التسليم</label>
                        <input id="expect_delivery_time" class="form-control bg-light" type="date" name="expect_delivery_time" required />
                        @error('expect_delivery_time')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group text-green col-sm-4">
                        <label for="images">اضافة صورة</label>
                        <input id="images" class="form-control" type="file" name="images[]" multiple />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group text-green col-sm-8">
                        <label for="notes">الملاحظات</label>
                        <textarea id="notes" class="form-control" name="notes" placeholder="..."></textarea>
                    </div>
                </div>
                <br>
            </div>
            <div class="card-footer">
                <a href="#" class="btn btn-outline-success col d-flex justify-content-center" onclick="submitForm()"><b>إضافة</b></a>
            </div>
        </form>
    </div>
    <!-- /.card -->
</div>
<br>
@endsection
session(['case_id' => $newCaseId]);
@section('scripts')
    <script>
        function submitForm() {
            document.getElementById('caseForm').submit();
        }
    </script>
@endsection
