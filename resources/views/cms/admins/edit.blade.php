@extends('cms.parent')

@section('page-title','مدراء النظام')

@section('styles')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="{{ asset('cms/plugins/toastr/toastr.min.css') }}">
<link rel="stylesheet" href="{{asset('cms/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
<link rel="stylesheet" href="{{ asset('cms/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('cms/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('page_name','تعديل مدير نظام')
@section('main_page','الرئيسية')
@section('current_page','مدراء النظام')

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
                                    <label for="roles">الدور الوظيفي</label>
                                    <select class="form-control roles" style="width: 100%;" id="roles">
                                        @foreach ($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="cities">المدينة</label>
                                    <select class="form-control cities" style="width: 100%;" id="cities">
                                        @foreach ($cities as $city)
                                        <option value="{{$city->id}}" @if($city->id == $admin->city_id) selected
                                            @endif>{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="gender">الجنس</label>
                                    <select class="form-control gender" style="width: 100%;" id="gender">
                                        <option value="M" @if($admin->gender == 'M') checked @endif>ذكر</option>
                                        <option value="F" @if($admin->gender == 'F') checked @endif>أنثى</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">الإسم</label>
                                    <input type="text" id="name" class="form-control" id="name"
                                        placeholder="أدخل الإسم " value="{{$admin->name}}">
                                </div>
                                <div class="form-group">
                                    <label for="email">البريد الإلكتروني</label>
                                    <input type="email" id="email" class="form-control" id="email"
                                        placeholder="أدخل البريد الإلكتروني " value="{{$admin->email}}">
                                </div>
                                <div class="form-group">
                                    <label for="mobile">الجوال</label>
                                    <input type="tel" id="mobile" class="form-control" id="mobile"
                                        placeholder="أدخل الجوال" value="{{$admin->mobile}}">
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="active"
                                            @if($admin->active) checked @endif>
                                        <label class="custom-control-label" for="active">الفعالية</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="button" onclick="performUpdate({{$admin->id}})"
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
    $('.roles').select2({
        theme: 'bootstrap4'
    });
    $('.cities').select2({
        theme: 'bootstrap4'
    });
    $('.gender').select2({
        theme: 'bootstrap4'
    });
    function performUpdate(id){
        let data = {
            role_id: document.getElementById('roles').value,
            city_id: document.getElementById('cities').value,
            gender: document.getElementById('gender').value,
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            mobile: document.getElementById('mobile').value,
            active: document.getElementById('active').checked,
        }
        let redirectUrl = '{{ route('users.index') }}'
        update('/cms/admin/users/'+id, data, redirectUrl);
    }
</script>
@endsection