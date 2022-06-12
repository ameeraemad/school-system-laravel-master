@extends('cms.parent')

@section('page-title','المواد')

@section('styles')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="{{ asset('cms/plugins/toastr/toastr.min.css') }}">
@endsection

@section('page_name','تعديل مادة')
@section('main_page','الرئيسية')
@section('current_page','المواد')

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
                                    <input type="text" class="form-control" id="name" value="{{ $subject->name }}"
                                        placeholder="أدخل النوع">
                                </div>
                                <div class="form-group">
                                    <label for="details">الوصف</label>
                                    <input type="text" class="form-control" id="name" value="{{ $subject->details }}"
                                        placeholder="أدخل الوصف - إختياري">
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="active"
                                            @if($subject->active) checked @endif>
                                        <label class="custom-control-label" for="active">الفعالية</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="button" onclick="performUpdate('{{ $subject->id }}')"
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
<script>
    function performUpdate(id){
        let data = {
            name: document.getElementById('name').value,
            active: document.getElementById('active').checked,
        }
        let redirectUrl = '{{ route('subjects.index') }}'
        update('/cms/admin/subjects/'+id, data, redirectUrl);
    }
</script>
@endsection