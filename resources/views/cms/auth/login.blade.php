<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>نظام المدرسة الذكية | تسجيل الدخول</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('cms/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('cms/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('cms/dist/css/adminlte.min.css') }}">
  <!-- Bootstrap 4 RTL -->
  <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('cms/plugins/toastr/toastr.min.css') }}">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="#"><b>نظام </b>المدرسة الذكية</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">أدخل البيانات لتسجيل الدخول</p>

        <form>
          @csrf
          <div class="input-group mb-3">
            <input type="email" class="form-control" id="email" placeholder="البريد الإلكتروني">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" id="password" placeholder="كلمة المرور">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-3">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  تذكرني
                </label>
              </div>
            </div>
            <div class="col-3"></div>
            <!-- /.col -->
            <div class="col-6">
              <button type="button" onclick="login()" class="btn btn-primary btn-block">تسجيل الدخول</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="{{ asset('cms/plugins/jquery/jquery.min.js') }}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('cms/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('cms/dist/js/adminlte.min.js') }}"></script>

  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="{{ asset('cms/plugins/toastr/toastr.min.js') }}"></script>
  <script src="{{ asset('js/crud.js') }}"></script>

  <script>
    function login(){
      var guard = '{{request('guard')}}';
      axios.post('/cms/'+guard+'/login', {
          email: document.getElementById('email').value,
          password: document.getElementById('password').value,
          remember: document.getElementById('remember').checked,
          guard: guard
      })
      .then(function (response) {
          window.location.href = '{{ route('cms.admin') }}';
      })
      .catch(function (error) {
          showToaster(error.response.data.message, false);
      });
    }
  </script>
</body>

</html>