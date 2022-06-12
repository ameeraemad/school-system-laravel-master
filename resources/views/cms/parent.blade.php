<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>المدرسة الذكية | @yield('page-title')</title>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('cms/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('cms/dist/css/adminlte.min.css') }}">
    <!-- Bootstrap 4 RTL -->
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css">
    <!-- Custom style for RTL -->
    <link rel="stylesheet" href="{{ asset('cms/dist/css/custom.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    {{-- <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('cms/plugins/toastr/toastr.min.css') }}">

    @yield('styles')

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                {{--
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index3.html" class="nav-link">الرئيسية</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">الإعدادات</a>
                </li>
                --}}
            </ul>

            <!-- Right navbar links -->
            {{-- <ul class="navbar-nav mr-auto-navbav">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
            </ul> --}}
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="{{ asset('cms/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">المدرسة الذكية</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('cms/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        {{-- <a href="#" class="d-block">{{ Auth()->user()->name }}</a> --}}
                        <a href="#" class="d-block">{{Auth::user()->name}}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        {{-- <li class="nav-item has-treeview menu-open"> --}}
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    الرئيسية
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link active">
                                        <i class="fas fa-home nav-icon"></i>
                                        <p>الرئيسية</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        @canany(['Read-Admins','Create-Admin'])
                        <li class="nav-header">الإدارة</li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user-tie"></i>
                                <p>
                                    مدراء النظام
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('Read-Admins')
                                <li class="nav-item">
                                    <a href="{{route('users.index')}}" class="nav-link">
                                        <i class="fas fa-list nav-icon"></i>
                                        <p>عرض</p>
                                    </a>
                                </li>
                                @endcan
                                @can('Create-Admin')
                                <li class="nav-item">
                                    <a href="{{route('users.create')}}" class="nav-link">
                                        <i class="fas fa-plus-square nav-icon"></i>
                                        <p>إضافة</p>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @endcanany

                        @canany(['Read-Roles','Create-Role','Read-Permissions','Create-Permission'])
                        <li class="nav-header">الأدوار الوظيفية و الصلاحيات</li>

                        @canany(['Read-Roles','Create-Role'])
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tag"></i>
                                <p>
                                    الأدوار الوظيفية
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('Read-Roles')
                                <li class="nav-item">
                                    <a href="{{route('roles.index')}}" class="nav-link">
                                        <i class="fas fa-list nav-icon"></i>
                                        <p>عرض</p>
                                    </a>
                                </li>
                                @endcan
                                @can('Create-Role')
                                <li class="nav-item">
                                    <a href="{{route('roles.create')}}" class="nav-link">
                                        <i class="fas fa-plus-square nav-icon"></i>
                                        <p>إضافة</p>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @endcanany
                        @canany(['Read-Permissions','Create-Permission'])
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-magic"></i>
                                <p>
                                    الصلاحيات
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('Read-Permissions')
                                <li class="nav-item">
                                    <a href="{{route('permissions.index')}}" class="nav-link">
                                        <i class="fas fa-list nav-icon"></i>
                                        <p>عرض</p>
                                    </a>
                                </li>
                                @endcan
                                @can('Create-Permission')
                                <li class="nav-item">
                                    <a href="{{route('permissions.create')}}" class="nav-link">
                                        <i class="fas fa-plus-square nav-icon"></i>
                                        <p>إضافة</p>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @endcanany
                        @endcanany

                        @canany(['Read-Parents','Create-Parent','Read-Students','Create-Student','Read-Teachers','Create-Teacher'])
                        <li class="nav-header">الموارد البشرية</li>

                        @canany(['Read-Parents','Create-Parent'])
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user-shield"></i>
                                <p>
                                    أولياء الأمور
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('Read-Parents')
                                <li class="nav-item">
                                    <a href="{{route('student-parents.index')}}" class="nav-link">
                                        <i class="fas fa-list nav-icon"></i>
                                        <p>عرض</p>
                                    </a>
                                </li>
                                @endcan
                                @can('Create-Parent')
                                <li class="nav-item">
                                    <a href="{{route('student-parents.create')}}" class="nav-link">
                                        <i class="fas fa-plus-square nav-icon"></i>
                                        <p>إضافة</p>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @endcanany
                        @canany(['Read-Students','Create-Student'])
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user-graduate"></i>
                                <p>
                                    الطلاب
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('Read-Students')
                                <li class="nav-item">
                                    <a href="{{route('students.index')}}" class="nav-link">
                                        <i class="fas fa-list nav-icon"></i>
                                        <p>عرض</p>
                                    </a>
                                </li>
                                @endcan
                                @can('Create-Student')
                                <li class="nav-item">
                                    <a href="{{route('students.create')}}" class="nav-link">
                                        <i class="fas fa-plus-square nav-icon"></i>
                                        <p>إضافة</p>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @endcanany
                        @canany(['Read-Teachers','Create-Teacher'])
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user-tie"></i>
                                <p>
                                    المدرسين
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('Read-Teachers')
                                <li class="nav-item">
                                    <a href="{{route('teachers.index')}}" class="nav-link">
                                        <i class="fas fa-list nav-icon"></i>
                                        <p>عرض</p>
                                    </a>
                                </li>
                                @endcan
                                @can('Create-Teacher')
                                <li class="nav-item">
                                    <a href="{{route('teachers.create')}}" class="nav-link">
                                        <i class="fas fa-plus-square nav-icon"></i>
                                        <p>إضافة</p>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @endcanany
                        @endcanany

                        @canany(['Read-Cities','Create-City','Read-Subjects','Create-Subject','Read-Classes','Create-Class','Read-Schools','Create-School'])
                        <li class="nav-header">إدارة المحتوى</li>

                        @canany(['Read-Cities','Create-City'])
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-flag"></i>
                                <p>
                                    المدن
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('Read-Cities')
                                <li class="nav-item">
                                    <a href="{{route('cities.index')}}" class="nav-link">
                                        <i class="fas fa-list nav-icon"></i>
                                        <p>عرض</p>
                                    </a>
                                </li>
                                @endcan
                                @can('Create-City')
                                <li class="nav-item">
                                    <a href="{{route('cities.create')}}" class="nav-link">
                                        <i class="fas fa-plus-square nav-icon"></i>
                                        <p>إضافة</p>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @endcanany

                        @canany(['Read-Subjects','Create-Subject'])
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    المواد
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('Read-Subjects')
                                <li class="nav-item">
                                    <a href="{{route('subjects.index')}}" class="nav-link">
                                        <i class="fas fa-list nav-icon"></i>
                                        <p>عرض</p>
                                    </a>
                                </li>
                                @endcan
                                @can('Create-Subject')
                                <li class="nav-item">
                                    <a href="{{route('subjects.create')}}" class="nav-link">
                                        <i class="fas fa-plus-square nav-icon"></i>
                                        <p>إضافة</p>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @endcanany

                        @canany(['Read-Classes','Create-Class'])
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-layer-group"></i>
                                <p>
                                    المراحل الدراسية
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('Read-Classes')
                                <li class="nav-item">
                                    <a href="{{route('class-rooms.index')}}" class="nav-link">
                                        <i class="fas fa-list nav-icon"></i>
                                        <p>عرض</p>
                                    </a>
                                </li>
                                @endcan
                                @can('Create-Class')
                                <li class="nav-item">
                                    <a href="{{route('class-rooms.create')}}" class="nav-link">
                                        <i class="fas fa-plus-square nav-icon"></i>
                                        <p>إضافة</p>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @endcanany

                        @canany(['Read-School-Classes','Create-School-Class'])
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-layer-group"></i>
                                <p>
                                    الشعب الدراسية
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('Read-School-Classes')
                                <li class="nav-item">
                                    <a href="{{route('schools-class-rooms.index')}}" class="nav-link">
                                        <i class="fas fa-list nav-icon"></i>
                                        <p>عرض</p>
                                    </a>
                                </li>
                                @endcan
                                @can('Create-School-Class')
                                <li class="nav-item">
                                    <a href="{{route('schools-class-rooms.create')}}" class="nav-link">
                                        <i class="fas fa-plus-square nav-icon"></i>
                                        <p>إضافة</p>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @endcanany

                        @canany(['Read-Schools','Create-School'])
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-school"></i>
                                <p>
                                    المدارس
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('Read-Schools')
                                <li class="nav-item">
                                    <a href="{{route('schools.index')}}" class="nav-link">
                                        <i class="fas fa-list nav-icon"></i>
                                        <p>عرض</p>
                                    </a>
                                </li>
                                @endcan
                                @can('Create-School')
                                <li class="nav-item">
                                    <a href="{{route('schools.create')}}" class="nav-link">
                                        <i class="fas fa-plus-square nav-icon"></i>
                                        <p>إضافة</p>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @endcanany
                        @endcanany

                        <li class="nav-header">الإعدادت</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-address-card"></i>
                                <p>
                                    تعديل الحساب
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-lock"></i>
                                <p>
                                    تعديل كلمة المرور
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            {{-- {{route('cms.logout')}} --}}
                            {{-- onclick="logout() --}}
                            <a href="{{route('cms.logout')}}" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    تسجيل الخروج
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>

            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">@yield('page_name')</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">@yield('main_page')</a></li>
                                <li class="breadcrumb-item active">@yield('current_page')</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            @yield('content')
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                <strong>{{ date('Y/m/d - H:i') }} </strong>
            </div>
            <!-- Default to the left -->
            <strong>الإصدار: (1.0.0) - <a href="#">نظام المدرسة الذكية</a></strong>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('cms/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('cms/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('cms/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('cms/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('js/crud.js') }}"></script>
    @yield('scripts')
</body>

</html>