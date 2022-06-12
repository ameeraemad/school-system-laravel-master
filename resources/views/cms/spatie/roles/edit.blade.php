@extends('cms.parent')

@section('styles')
<link rel="stylesheet" href="{{asset('cms/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('cms/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection

@section('title','Roles')
@section('page-title','Edit Role')
@section('small-title','Roles')

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
                                    <option value="admin" @if($role->guard_name == 'admin') selected @endif>مدير نظام
                                    </option>
                                    <option value="school" @if($role->guard_name == 'school') selected @endif>مدرسة
                                    </option>
                                    <option value="teacher" @if($role->guard_name == 'teacher') selected @endif>مدرس
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">الإسم</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="Enter role name" value="{{$role->name}}">
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="button" onclick="performUpdate({{$role->id}})"
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

        update('/cms/admin/roles/'+id,data,'/cms/admin/roles');
    }
</script>
@endsection