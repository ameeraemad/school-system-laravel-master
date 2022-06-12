@extends('cms.parent')

@section('style')

@endsection

@section('title','Roles')
@section('page-title','Index')
@section('small-title','Roles Index')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Roles</h3>

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
                  <th>#</th>
                  <th>الإسم</th>
                  <th>المستخدم</th>
                  <th>الصلاحيات</th>
                  <th>تاريخ الإنشاء</th>
                  <th>تاريخ التعديل</th>
                  <th>الإعدادات</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($roles as $role)
                <tr>
                  {{-- <span class="tag tag-success">Approved</span>s --}}
                  <td>{{$role->id}}</td>
                  <td>{{$role->name}}</td>
                  <td><span class="badge bg-success">{{$role->guard_name}}</span></td>
                  <td><a href="{{route('role.permissions.index',$role->id)}}"
                      class="btn btn-info">{{$role->permissions_count}} Permission/s</a>
                  </td>
                  <td>{{$role->created_at}}</td>
                  <td>{{$role->updated_at}}</td>
                  <td>
                    <div class="btn-group">
                      <a href="{{route('roles.edit',$role->id)}}" class="btn btn-info">
                        <i class="fas fa-edit"></i>
                      </a>
                      {{-- <form method="POST" action="{{route('Roles.destroy',$role->id)}}">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash-alt"></i>
                      </button>
                      </form> --}}
                      <a href="#" onclick="performDestroy({{$role->id}}, this)" class="btn btn-danger">
                        <i class="fas fa-trash"></i>
                      </a>
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
  function performDestroy(id, ref){
    confirmDestroy('/cms/admin/roles/'+id, ref);
  }
</script>
@endsection