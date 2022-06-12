@extends('cms.parent')

@section('page-title','TITLE')

@section('styles')
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ asset('cms/plugins/toastr/toastr.min.css') }}">
@endsection

@section('page_name','تعديل كلمة المرور')
@section('main_page','الرئيسية')
@section('current_page','الإعدادات')

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
                <form role="form" id="edit-password-form">
                    @csrf
                    <div class="card-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="current_password">الإسم</label>
                                <input type="password" class="form-control" id="current_password" placeholder="أدخل كلمة المرور الحالية ">
                            </div>
                            <div class="form-group">
                                <label for="new_password">كلمة المرور الجديدة</label>
                                <input type="password" class="form-control" id="new_password" placeholder="أدخل كلمة المرور الجديدة">
                            </div>
                            <div class="form-group">
                                <label for="new_password_confirmation">تأكيد كلمة المرو الجديدة</label>
                                <input type="password" class="form-control" id="new_password_confirmation" placeholder="تأكيد كلمة المرور الجديدة">
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="button" onclick="update()" class="btn btn-primary">تعديل</button>
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
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('cms/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('js/helpers.js') }}"></script>

    <script>
        function update($id){
            axios.put('/cms/admin/password/update', {
                current_password: document.getElementById('current_password').value,
                new_password: document.getElementById('new_password').value,
                new_password_confirmation: document.getElementById('new_password_confirmation').value,
            })
            .then(function (response) {
                document.getElementById('edit-password-form').reset();
                showToast(response.data.message, true);
            })
            .catch(function (error) {
                showToast(error.response.data.message, false);
            });
        }
    </script>
@endsection
