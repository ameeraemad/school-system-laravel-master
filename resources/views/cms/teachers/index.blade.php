@extends('cms.parent')

@section('page-title','المدرسين')

@section('styles')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="{{ asset('cms/plugins/toastr/toastr.min.css') }}">
@endsection

@section('page_name','المدرسين')
@section('main_page','الرئيسية')
@section('current_page','المدرسين')

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
                  <th>المدرسة</th>
                  <th>البريد الإلكتروني</th>
                  <th>الجوال</th>
                  <th>تاريخ الميلاد</th>
                  <th>الفئة</th>
                  <th>المواد</th>
                  <th>المدينة</th>
                  <th>الفعالية</th>
                  <th>تاريخ الإنشاء</th>
                  <th>تاريخ التعديل</th>
                  <th width='15%'>الإعدادات</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($teachers as $teacher)
                <tr>
                  <td>{{ $teacher->id }}</td>
                  <td>{{ $teacher->name }}</td>
                  <td><span class="badge bg-success">{{ $teacher->school->name }}</span></td>
                  <td>{{ $teacher->email }}</td>
                  <td>{{ $teacher->mobile }}</td>
                  <td>{{ $teacher->birth_date }}</td>
                  <td><span class="badge bg-primary">{{$teacher->gender_type}}</span></td>
                  <td>
                    <a href="{{route('teacher.subjects.index', $teacher->id)}}"
                      class="btn btn-warning">{{$teacher->teacher_subjects_count}}
                      مادة</a>
                  </td>
                  <td><span class="badge bg-info">{{$teacher->city->name}}</span></td>
                  <td><span
                      class="@if($teacher->active) badge bg-success @else badge bg-danger @endif">{{ $teacher->status }}</span>
                  </td>
                  <td>{{ $teacher->created_at->format('Y-m-d') }}</td>
                  <td>{{ $teacher->updated_at->format('Y-m-d') }}</td>
                  <td>
                    {{-- @can('Update-Feeds') --}}
                    <a class="btn btn-info btn-sm" href="{{route('teachers.edit',$teacher->id)}}"><i
                        class="fas fa-pencil-alt"></i>
                      تعديل</a>
                    {{-- @endcan --}}
                    {{-- @can('Delete-Feeds') --}}
                    <a class="btn btn-danger  btn-sm" href="#" onclick="performDestroy('{{ $teacher->id }}',this)"><i
                        class="fas fa-trash"></i> حذف</a>
                    {{-- @endcan --}}
                  </td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th>#</th>
                  <th>الإسم</th>
                  <th>المدرسة</th>
                  <th>البريد الإلكتروني</th>
                  <th>الجوال</th>
                  <th>تاريخ الميلاد</th>
                  <th>الفئة</th>
                  <th>المواد</th>
                  <th>المدينة</th>
                  <th>الفعالية</th>
                  <th>تاريخ الإنشاء</th>
                  <th>تاريخ التعديل</th>
                  <th width='15%'>الإعدادات</th>
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
        confirmDestroy('/cms/admin/teachers/'+id, td)
    }
</script>
@endsection