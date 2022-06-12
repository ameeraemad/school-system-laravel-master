@extends('cms.parent')

@section('page-title','الرئيسية')

@section('styles')

@endsection

@section('page_name','الرئيسية')
@section('main_page','نظام المزرعة')
@section('current_page','الرئيسية')

@section('content')
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $regimentsCount }}</h3>

                <p>الأفواج</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{ route('regiments.index') }}" class="small-box-footer">التفاصيل <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $breedersCount }}</h3>

                <p>المربيين</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{ route('breeders.index') }}" class="small-box-footer">التفاصيل <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $operationsCount }}</h3>

                <p>أنواع العمليات</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{ route('operations.index') }}" class="small-box-footer">التفاصيل <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $incubatorsCount }}</h3>

                <p>الفقاسات</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{ route('incubators.index') }}" class="small-box-footer">التفاصيل <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <!-- Left col -->
          <div class="col-md-12">
            <!-- TABLE: LATEST ORDERS -->
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">الأفواج</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>#</th>
                      <th>رقم الفوج</th>
                      <th>نوع الصوص</th>
                      <th>عدد الصيصان</th>
                      <th>سعر الصوص</th>
                      <th>الإجمالي</th>
                      <th>تاريخ البدء</th>
                      <th>الفقاسة</th>
                      <th>المُربي</th>
                      <th>تكلفة المُربي</th>
                      <th>المُباع</th>
                      <th>تاريخ الإنشاء</th>
                      <th>تاريخ التعديل</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($regiments as $regiment)
                        <tr>
                            <td>{{ $regiment->id }}</td>
                            <td><span class="badge bg-info">{{ $regiment->serial_number }}</span></td>
                            <td><span class="badge bg-warning">{{ $regiment->chickType->name }}</span></td>
                            <td><span class="badge bg-warning">{{ $regiment->chicks_count }}</span></td>
                            <td><span class="badge bg-warning">{{ $regiment->chick_price }}</span></td>
                            <td><span class="badge bg-black">{{ $regiment->total_price }}</span></td>
                            <td><span class="badge bg-success">{{ $regiment->start_date }}</span></td>
                            <td><span class="badge bg-success">{{ $regiment->incubator->name }}</span></td>
                            <td><span class="badge bg-purple">{{ $regiment->breeder->name }}</span></td>
                            <td><span class="badge bg-primary">{{ $regiment->breeder_cost }}</span></td>
                            <td><span class="badge bg-pink">{{ $regiment->sold_count }}</span></td>
                            {{-- <td><a class="btn btn-info btn-sm" href="#"><i class="fas fa-book"></i>  0 - دورات</a></td> --}}
                            <td>{{ $regiment->created_at->format('m/d/Y') }}</td>
                            <td>{{ $regiment->updated_at->format('m/d/Y') }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                {{-- <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a>
                <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All Orders</a> --}}
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection

@section('scripts')

@endsection
