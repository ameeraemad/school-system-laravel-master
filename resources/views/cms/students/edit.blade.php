@extends('cms.parent')

@section('page-title','الطلاب')

@section('styles')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="{{ asset('cms/plugins/toastr/toastr.min.css') }}">
<link rel="stylesheet" href="{{ asset('cms/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('cms/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('cms/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('page_name','إضافة طالب')
@section('main_page','الرئيسية')
@section('current_page','الطلاب')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"></h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="create_form" role="form">
                        @csrf
                        <div class="card-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cities">المدينة</label>
                                    <select class="form-control cities" style="width: 100%;" id="cities">
                                        @foreach ($cities as $city)
                                        <option value="{{$city->id}}" @if ($city->id == $student->city_id) selected
                                            @endif>{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="parents">ولي الأمر</label>
                                    <select class="form-control parents" style="width: 100%;" id="parents">
                                        @foreach ($parents as $parent)
                                        <option value="{{$parent->id}}" @if ($parent->id == $student->parent_id)
                                            selected
                                            @endif>
                                            {{$parent->first_name.' '.$parent->last_name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="schools">المدرسة</label>
                                    <select class="form-control schools" style="width: 100%;" id="schools">
                                        @foreach ($schools as $school)
                                        <option value="{{$school->id}}" @if ($school->id == $student->school_id)
                                            selected
                                            @endif>{{$school->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="gender">الفئة الطلابية</label>
                                    <select class="form-control gender" style="width: 100%;" id="gender">
                                        <option value="M" @if ($student->gender == 'M') @endif>ذكر</option>
                                        <option value="F" @if ($student->gender == 'F') @endif>أنثى</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">الإسم</label>
                                    <input type="text" id="name" class="form-control" id="name"
                                        value="{{$student->name}}" placeholder="أدخل الإسم ">
                                </div>
                                <div class="form-group">
                                    <label for="email">البريد الإلكتروني</label>
                                    <input type="email" id="email" class="form-control" id="email"
                                        value="{{$student->email}}" placeholder="أدخل البريد الإلكتروني ">
                                </div>
                                <div class="form-group">
                                    <label for="mobile">الجوال</label>
                                    <input type="tel" id="mobile" class="form-control" id="mobile"
                                        value="{{$student->mobile}}" placeholder="أدخل الجوال ">
                                </div>
                                <div class="form-group">
                                    <label for="birth_date">تاريخ الميلاد</label>
                                    <input id="birth_date" type="text" class="form-control"
                                        value="{{$student->birth_date}}" placeholder="أدخل تاريخ الميلاد">
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" @if ($student->active)
                                        checked
                                        @endif id="active" >
                                        <label class="custom-control-label" for="active">الفعالية</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="button" onclick="performUpdate({{$student->id}})"
                                class="btn btn-primary">تعديل</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

@section('scripts')
<script src="{{ asset('cms/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('cms/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script>
    $('.cities').select2({
        theme: 'bootstrap4'
    });
    $('.gender').select2({
        theme: 'bootstrap4'
    });
    $('.parents').select2({
        theme: 'bootstrap4'
    });
    $('.schools').select2({
        theme: 'bootstrap4'
    });
    $('#birth_date').datepicker({
        orientation: "auto right",
        maxViewMode: 2,
        todayBtn: "linked",
        clearBtn: true,
        language: "ar",
        daysOfWeekDisabled: "5",
        autoclose: true,
        todayHighlight: true,
        format: "yyyy-mm-dd"
        // startDate: "today",
    });
    function performUpdate(id){
        let data = {
            city_id: document.getElementById('cities').value,
            parent_id: document.getElementById('parents').value,
            school_id: document.getElementById('schools').value,
            gender: document.getElementById('gender').value,
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            mobile: document.getElementById('mobile').value,
            birth_date: document.getElementById('birth_date').value,
            active: document.getElementById('active').checked,
        }

        let redirectUrl = '{{ route('students.index') }}'
        update('/cms/admin/students/'+id, data, redirectUrl);
    }
</script>
@endsection