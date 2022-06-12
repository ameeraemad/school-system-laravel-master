@extends('cms.parent')

@section('styles')
<link rel="stylesheet" href="{{asset('cms/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('cms/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection

@section('title','الصلاحيات')
@section('page-title','تعديل صلاحية')
@section('small-title','الصلاحيات')

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
                        <h3 class="card-title">Quick Example</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="create_form">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>المستخدم</label>
                                <select class="form-control guards" style="width: 100%;" id="guards">
                                    <option value="admin" @if($permission->guard_name == 'admin') selected @endif>مدير
                                        نظام
                                    </option>
                                    <option value="school" @if($permission->guard_name == 'school') selected
                                        @endif>مدرسة
                                    </option>
                                    <option value="teacher" @if($permission->guard_name == 'teacher') selected
                                        @endif>مدرس
                                    </option>
                                    <option value="student-parent" @if($permission->guard_name == 'student-parent')
                                        selected
                                        @endif>ولي
                                        أمر
                                    </option>
                                    <option value="student" @if($permission->guard_name == 'student') selected
                                        @endif>طالب
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="أدخل إسم الصلاحية" value="{{$permission->name}}">
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="button" onclick="performUpdate({{$permission->id}})"
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
<!-- Select2 -->
<script src="{{asset('cms/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
    //Initialize Select2 Elements
    $('.guards').select2({
        theme: 'bootstrap4'
    })
    function performUpdate(id){
        let data = {
            name: document.getElementById('name').value,
            guard: document.getElementById('guards').value
        };

        update('/cms/admin/permissions/'+id,data,'/cms/admin/permissions');
    }
</script>
@endsection