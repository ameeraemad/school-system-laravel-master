@extends('cms.parent')

@section('page-title','مواد المدرس')

@section('style')
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{asset('cms/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
@endsection

@section('page_name','مواد المدرس')
@section('main_page','الرئيسية')
@section('current_page','المدرسين')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title float-right">مواد المدرس</h3>

            {{-- <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </div> --}}
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover table-bordered table-striped text-nowrap">
              <thead>
                <tr>
                  <th>المدرس</th>
                  <th>المادة</th>
                  <th>الحالة</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($subjects as $subject)
                <tr>
                  <td>{{$teacher->name}}</td>
                  <td><span class="badge bg-info">{{$subject->name}}</span></td>
                  <td>
                    <div class="icheck-primary d-inline">
                      <input type="checkbox" id="student_{{$subject->id}}"
                        onchange="performStore({{$subject->id}},{{$teacher->id}})" @if($subject->assigned)
                      checked
                      @endif>
                      <label for="student_{{$subject->id}}">
                      </label>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
</section>
@endsection

@section('scripts')

<script>
  function performStore(subjectId, teacherId){
        let data = {
            subject_id: subjectId,
        };
        store('/cms/admin/teacher/'+teacherId+'/subjects',data);
    }
</script>
@endsection