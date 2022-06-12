@extends('cms.parent')

@section('page-title','المدارس')

@section('styles')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="{{ asset('cms/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('cms/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('page_name','إضافة مدرسة')
@section('main_page','الرئيسية')
@section('current_page','المدارس')

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
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="gender">الفئة الطلابية</label>
                                    <select class="form-control gender" style="width: 100%;" id="gender">
                                        <option value="M">ذكور</option>
                                        <option value="F">إناث</option>
                                        <option value="MF">ذكور - إناث</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">الإسم</label>
                                    <input type="text" id="name" class="form-control" id="name"
                                        placeholder="أدخل الإسم ">
                                </div>
                                <div class="form-group">
                                    <label for="email">البريد الإلكتروني</label>
                                    <input type="email" id="email" class="form-control" id="email"
                                        placeholder="أدخل البريد الإلكتروني ">
                                </div>
                                <div class="form-group">
                                    <label for="telephone">رقم الهاتف</label>
                                    <input type="tel" id="telephone" class="form-control" id="telephone"
                                        placeholder="أدخل رقم الهاتف ">
                                </div>
                                <div class="form-group">
                                    <label for="mobile">الجوال</label>
                                    <input type="tel" id="mobile" class="form-control" id="mobile"
                                        placeholder="أدخل الجوال ">
                                </div>
                                <div class="form-group">
                                    <label for="address">العنوان</label>
                                    <input type="text" id="address" class="form-control" id="address"
                                        placeholder="أدخل العنوان ">
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="active" checked>
                                        <label class="custom-control-label" for="active">الفعالية</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="button" onclick="performStore()" class="btn btn-primary">إضافة</button>
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
    function performStore(){
        let data = {
            role_id: document.getElementById('roles').value,
            city_id: document.getElementById('cities').value,
            gender: document.getElementById('gender').value,
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            telephone: document.getElementById('telephone').value,
            mobile: document.getElementById('mobile').value,
            address: document.getElementById('address').value,
            active: document.getElementById('active').checked,
        }
        store('/cms/admin/schools', data)
    }
</script>
@endsection