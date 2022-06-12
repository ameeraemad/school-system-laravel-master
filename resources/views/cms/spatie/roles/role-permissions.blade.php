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
            <h3 class="card-title">Role Permissions</h3>

            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover table-bordered table-striped text-nowrap">
              <thead>
                <tr>
                  <th>الإسم</th>
                  <th>المستخدم</th>
                  <th>الحالة</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($permissions as $permission)
                <tr>
                  {{-- <span class="tag tag-success">Approved</span>s --}}
                  <td>{{$permission->name}}</td>
                  <td><span class="badge bg-success">{{$permission->guard_name}}</span></td>
                  <td>
                    <div class="icheck-primary d-inline">
                      <input type="checkbox" id="permission_{{$permission->id}}"
                        onchange="performStore({{$role_id}},{{$permission->id}})" @if($permission->assigned) checked
                      @endif>
                      <label for="permission_{{$permission->id}}">
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
  function performStore(roleId, permissionId){
        let data = {
            permission_id: permissionId,
        };
        store('/cms/admin/role/'+roleId+'/permissions',data);
    }
</script>
@endsection