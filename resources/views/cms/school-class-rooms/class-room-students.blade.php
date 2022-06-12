@extends('cms.parent')

@section('style')
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{asset('cms/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
@endsection

@section('title','Role Permissions')
@section('page-title','Index')
@section('small-title','Roles Permissions')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title float-right">طلاب الشعبة</h3>

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
                  <th>الإسم</th>
                  <th>المرحلة</th>
                  <th>الشعبة</th>
                  <th>الحالة</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($students as $student)
                <tr>
                  {{-- <span class="tag tag-success">Approved</span>s --}}
                  <td>{{$student->name}}</td>
                  <td><span class="badge bg-success">{{$schoolClassRoom->classRoom->name}}</span></td>
                  <td><span class="badge bg-info">{{$schoolClassRoom->section}}</span></td>
                  <td>
                    @can('Create-School-Class-Student')
                    <div class="icheck-primary d-inline">
                      <input type="checkbox" id="student_{{$student->id}}"
                        onchange="performStore({{$schoolClassRoom->id}},{{$student->id}})" @if($student->assigned)
                      checked
                      @endif>
                      <label for="student_{{$student->id}}">
                      </label>
                    </div>
                    @endcan
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
  function performStore(schoolClassRoom, studentId){
        let data = {
            student_id: studentId,
        };
        store('/cms/admin/school-class-rooms/'+schoolClassRoom+'/students',data);
    }
</script>
@endsection