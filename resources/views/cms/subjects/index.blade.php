@extends('cms.parent')

@section('page-title','المواد')

@section('styles')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="{{ asset('cms/plugins/toastr/toastr.min.css') }}">
@endsection

@section('page_name','المواد')
@section('main_page','الرئيسية')
@section('current_page','المواد')

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
                  <th>الوصف</th>
                  <th>الفعالية</th>
                  <th>تاريخ الإنشاء</th>
                  <th>تاريخ التعديل</th>
                  @canany(['Update-Subject','Delete-Subject'])
                  <th width='15%'>الإعدادات</th>
                  @endcanany
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $subject)
                <tr>
                  <td>{{ $subject->id }}</td>
                  <td>{{ $subject->name }}</td>
                  <td>{{ $subject->details ?? 'لا يوجد' }}</td>
                  <td><span
                      class="@if($subject->active) badge bg-success @else badge bg-danger @endif">{{ $subject->status }}</span>
                  </td>
                  <td>{{ $subject->created_at->format('Y-m-d') }}</td>
                  <td>{{ $subject->updated_at->format('Y-m-d') }}</td>

                  @canany(['Update-Subject','Delete-Subject'])
                  <td>
                    @can('Update-Subject')
                    <a class="btn btn-info btn-sm" href="{{route('subjects.edit',$subject->id)}}"><i
                        class="fas fa-pencil-alt"></i> تعديل</a>
                    @endcan
                    @can('Delete-Subject')
                    <a class="btn btn-danger  btn-sm" href="#" onclick="performDestroy('{{ $subject->id }}',this)"><i
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
                  <th>الوصف</th>
                  <th>الفعالية</th>
                  <th>تاريخ الإنشاء</th>
                  <th>تاريخ التعديل</th>
                  @canany(['Update-Subject','Delete-Subject'])
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
        confirmDestroy('/cms/admin/subjects/'+id, td)
    }
</script>
@endsection