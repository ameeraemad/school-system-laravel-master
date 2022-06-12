@extends('cms.parent')

@section('page-title','الشعب الدراسية')

@section('styles')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="{{ asset('cms/plugins/toastr/toastr.min.css') }}">
<link rel="stylesheet" href="{{ asset('cms/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('cms/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('page_name','إضافة شعبة دراسية')
@section('main_page','الرئيسية')
@section('current_page','الشعب الدراسية')

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
                                    <label for="class_rooms">المرحلة الدراسية</label>
                                    <select class="form-control class_rooms" style="width: 100%;" id="class_rooms">
                                        @foreach ($classRooms as $classRoom)
                                        <option value="{{$classRoom->id}}">{{$classRoom->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="section">الشعبة (رقميا)</label>
                                    <input type="number" class="form-control" id="section" placeholder="أدخل الشعبة">
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
    $('.class_rooms').select2({
        theme: 'bootstrap4'
    });
    function performStore(){
        let data = {
            class_room: document.getElementById('class_rooms').value,
            section: document.getElementById('section').value,
        }
        store('/cms/admin/schools-class-rooms', data)
    }
</script>
@endsection