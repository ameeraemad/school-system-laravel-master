@extends('cms.parent')

@section('page-title','المراحل الدراسية')

@section('styles')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="{{ asset('cms/plugins/toastr/toastr.min.css') }}">
@endsection

@section('page_name','المراحل الدراسية')
@section('main_page','الرئيسية')
@section('current_page','المراحل الدراسية')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"></h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>الإسم</th>
                  <th>المرحلة</th>
                  <th>المستوى العلمي</th>
                  <th>عدد الشعب</th>
                  <th>تاريخ الإنشاء</th>
                  <th>تاريخ التعديل</th>
                  @canany(['Update-Class','Delete-Class'])
                  <th width='15%'>الإعدادات</th>
                  @endcanany
                </tr>
              </thead>
              <tbody>
                @foreach ($classRooms as $classRoom)
                <tr>
                  <td>{{ $classRoom->id }}</td>
                  <td>{{ $classRoom->name }}</td>
                  <td><span class="badge bg-info">{{ $classRoom->level}}</span></td>
                  <td><span class="badge bg-success">{{ $classRoom->stage_ar }}</span></td>
                  <td><span class="badge bg-primary">{{ $classRoom->school_sections_count }}</span></td>
                  <td>{{ $classRoom->created_at->format('Y-m-d') }}</td>
                  <td>{{ $classRoom->updated_at->format('Y-m-d') }}</td>
                  @canany(['Update-Class','Delete-Class'])
                  <td>
                    @can('Update-Class')
                    <a class="btn btn-info btn-sm" href="{{route('class-rooms.edit',$classRoom->id)}}"><i
                        class="fas fa-pencil-alt"></i> تعديل</a>
                    @endcan
                    @can('Delete-Class')
                    <a class="btn btn-danger  btn-sm" href="#" onclick="performDestroy('{{ $classRoom->id }}',this)"><i
                        class="fas fa-trash"></i> حذف</a>
                    @endcan
                  </td>
                  @endcanany
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th>#</th>
                  <th>الإسم</th>
                  <th>المرحلة</th>
                  <th>المستوى العلمي</th>
                  <th>عدد الشعب</th>
                  <th>تاريخ الإنشاء</th>
                  <th>تاريخ التعديل</th>
                  @canany(['Update-Class','Delete-Class'])
                  <th width='15%'>الإعدادات</th>
                  @endcanany
                </tr>
              </tfoot>
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
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
  function performDestroy(id, td){
        confirmDestroy('/cms/admin/class-rooms/'+id, td)
    }
</script>
@endsection