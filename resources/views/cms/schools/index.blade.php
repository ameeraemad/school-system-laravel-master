@extends('cms.parent')

@section('page-title','المدارس')

@section('styles')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="{{ asset('cms/plugins/toastr/toastr.min.css') }}">
@endsection

@section('page_name','المدارس')
@section('main_page','الرئيسية')
@section('current_page','المدارس')

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
                  <th>البريد الإلكتروني</th>
                  <th>الجوال</th>
                  <th>الهاتف</th>
                  <th>العنوان</th>
                  <th>الفئة</th>
                  <th>المدينة</th>
                  <th>الفعالية</th>
                  <th>تاريخ الإنشاء</th>
                  <th>تاريخ التعديل</th>
                  <th width='15%'>الإعدادات</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($schools as $school)
                <tr>
                  <td>{{ $school->id }}</td>
                  <td>{{ $school->name }}</td>
                  <td>{{ $school->email}}</td>
                  <td>{{ $school->mobile }}</td>
                  <td>{{ $school->telephone }}</td>
                  <td>{{ $school->address }}</td>
                  <td><span class="badge bg-primary">{{$school->gender_type}}</span></td>
                  <td><span class="badge bg-info">{{$school->city->name}}</span></td>
                  <td><span
                      class="@if($school->active) badge bg-success @else badge bg-danger @endif">{{ $school->status }}</span>
                  </td>
                  <td>{{ $school->created_at->format('Y-m-d') }}</td>
                  <td>{{ $school->updated_at->format('Y-m-d') }}</td>
                  <td>
                    {{-- @can('Update-Feeds') --}}
                    <a class="btn btn-info btn-sm" href="{{route('schools.edit',$school->id)}}"><i
                        class="fas fa-pencil-alt"></i> تعديل</a>
                    {{-- @endcan --}}
                    {{-- @can('Delete-Feeds') --}}
                    <a class="btn btn-danger  btn-sm" href="#" onclick="performDestroy('{{ $school->id }}',this)"><i
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
                  <th>البريد الإلكتروني</th>
                  <th>الجوال</th>
                  <th>الهاتف</th>
                  <th>العنوان</th>
                  <th>الفئة</th>
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
        confirmDestroy('/cms/admin/schools/'+id, td)
    }
</script>
@endsection