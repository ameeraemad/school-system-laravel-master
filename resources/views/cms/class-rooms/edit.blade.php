@extends('cms.parent')

@section('page-title','المواد')

@section('styles')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="{{ asset('cms/plugins/toastr/toastr.min.css') }}">
<link rel="stylesheet" href="{{ asset('cms/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('cms/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
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
                                    <input type="text" id="name" class="form-control" id="name"
                                        value="{{$classRoom->name}}" placeholder="أدخل الإسم ">
                                </div>
                                <div class="form-group">
                                    <label for="level">المرحلة (رقميا)</label>
                                    <input type="number" name="level" class="form-control" id="level"
                                        value="{{$classRoom->level}}" placeholder="أدخل القيمة الرقمية للمرحلة ">
                                </div>
                                <div class="form-group">
                                    <label for="stages">المستوى العلمي</label>
                                    <select class="form-control stages" style="width: 100%;" id="stages">
                                        <option value="Primary" @if($classRoom->stage =='Primary' ) selected
                                            @endif>إبتدائي
                                        </option>
                                        <option value="Preparatory" @if($classRoom->stage=='Preparatory' ) selected
                                            @endif>
                                            إعدادي</option>
                                        <option value="Secondary" @if($classRoom->stage=='Secondary' ) selected
                                            @endif>ثانوي
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="button" onclick="performUpdate('{{ $classRoom->id }}')"
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
<script>
    $('.stages').select2({
        theme: 'bootstrap4'
    });
    function performUpdate(id){
        let data = {
            name: document.getElementById('name').value,
            level: document.getElementById('level').value,
            stage: document.getElementById('stages').value,
        }
        let redirectUrl = '{{ route('class-rooms.index') }}'
        update('/cms/admin/class-rooms/'+id, data, redirectUrl);
    }
</script>
@endsection