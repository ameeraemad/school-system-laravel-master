@extends('cms.parent')

@section('page-title','TITLE')

@section('styles')
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ asset('cms/plugins/toastr/toastr.min.css') }}">
@endsection

@section('page_name','تعديل بيانات الحساب')
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
                <form role="form">
                    @csrf
                    <div class="card-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">الإسم</label>
                                <input type="text" class="form-control" id="name" value="{{ $user->name }}" placeholder="أدخل الإسم ">
                            </div>
                            <div class="form-group">
                                <label for="email">البريد الإلكتروني</label>
                                <input type="email"class="form-control" id="email" value="{{ $user->email }}" placeholder="أدخل رقم الجوال">
                            </div>
                            <div class="form-group">
                                <label for="mobile">رقم الجوال</label>
                                <input type="tel" class="form-control" id="mobile" value="{{ $user->mobile }}" placeholder="أدخل رقم الجوال">
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="button" onclick="update('{{ $user->id }}')" class="btn btn-primary">تعديل</button>
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
            axios.put('/cms/admin/profile/update/', {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                mobile: document.getElementById('mobile').value,
            })
            .then(function (response) {
                showToast(response.data.message, true);
            })
            .catch(function (error) {
                showToast(error.response.data.message, false);
            });
        }
    </script>
@endsection
