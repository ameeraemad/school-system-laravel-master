@extends('cms.parent')

@section('page-title','أولياء الأمور')

@section('styles')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="{{ asset('cms/plugins/toastr/toastr.min.css') }}">
<link rel="stylesheet" href="{{asset('cms/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
<link rel="stylesheet" href="{{ asset('cms/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('cms/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('page_name','تعديل ولي أمر')
@section('main_page','الرئيسية')
@section('current_page','أولياء الأمور')

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
                                        <option value="{{$city->id}}" @if($city->id == $parent->city_id) selected
                                            @endif>{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="gender">صلة القرابة</label>
                                    <select class="form-control gender" style="width: 100%;" id="gender">
                                        <option value="M" @if($parent->gender == 'M') checked @endif>أب</option>
                                        <option value="F" @if($parent->gender == 'F') checked @endif>أم</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="first_name">الإسم الأول</label>
                                    <input type="text" id="first_name" class="form-control" id="first_name"
                                        placeholder="أدخل الإسم الأول " value="{{$parent->first_name}}">
                                </div>
                                <div class="form-group">
                                    <label for="last_name">إسم العائلة</label>
                                    <input type="text" id="last_name" class="form-control" id="last_name"
                                        placeholder="أدخل إسم العائلة " value="{{ $parent->last_name }}">
                                </div>
                                <div class="form-group">
                                    <label for="email">البريد الإلكتروني</label>
                                    <input type="email" id="email" class="form-control" id="email"
                                        placeholder="أدخل البريد الإلكتروني " value="{{$parent->email}}">
                                </div>
                                <div class="form-group">
                                    <label for="mobile">الجوال</label>
                                    <input type="tel" id="mobile" class="form-control" id="mobile"
                                        placeholder="أدخل الجوال" value="{{$parent->mobile}}">
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="active"
                                            @if($parent->active) checked @endif>
                                        <label class="custom-control-label" for="active">الفعالية</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="button" onclick="performUpdate({{$parent->id}})"
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
    function performUpdate(id){
        let data = {
            city_id: document.getElementById('cities').value,
            gender: document.getElementById('gender').value,
            first_name: document.getElementById('first_name').value,
            last_name: document.getElementById('last_name').value,
            email: document.getElementById('email').value,
            mobile: document.getElementById('mobile').value,
            active: document.getElementById('active').checked,
        }
        let redirectUrl = '{{ route('student-parents.index') }}'
        update('/cms/admin/student-parents/'+id, data, redirectUrl);
    }
</script>
@endsection