@extends ('master-dashboard')

@section ('title', 'Monthly Report')

@section ('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Monthly Report</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <i class="fa fa-home"></i>
                </li>
                <li><span>Monthly Report</span></li>
            </ol>
            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <!-- start: page -->
    <div class="row">
        <div class="col">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>
                    </div>
                    <h2 class="panel-title">Filter Monthly Report</h2>
                </header>
								<div class="panel-body">
                  <div class="row">
                        <form method="POST" class="form-inline float-right">
                        @csrf
                    <div class="col-md-8">
                        <input type="text" style="width:100%" class="form-control float-right" name="tahun" required placeholder="Tahun">
                    </div>
                    <div class="col-md-2">
                        <button style="width:100%" class="btn btn-default" type="Submit"><i class="fa fa-search"></i><span>Cari</span></button>
                    </div>
                    <div class="col-md-2">
                        <a href="{{route('report.bulanan.now')}}"><button style="width:100%" class="btn btn-default" type="button">Tahun Ini</button></a>
                    </div>
                        </form>

                  </div>
								</div>
            </section>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>
                    </div>
                    <h2 class="panel-title">Monthly Transaction Chart</h2>
                </header>
								<div class="panel-body">
                  <div style="margin: 3%;">
                  {!! $chart->container() !!}
                  </div>
								</div>
            </section>
        </div>
    </div>
                    
    <!-- start: page -->
    <div class="row">
        <div class="col">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>
                    </div>
                    <h2 class="panel-title">Monthly Transaction Table</h2>
                </header>
                <div class="panel-body">
                    <table class="table table-bordered table-hover mb-none" id="datatable-default">
							<thead>
								<tr>
                                    <th>#</th>
                                    <th>Bulan</th>
                                    <th>Tahun</th>
                                    <th>Jumlah</th>
                                    <th>Ongkir</th>
                                    <th>Bersih</th>
								</tr>
							</thead>
							<tbody>
                                @if ($data->isEmpty())
                                    <tr>
                                        <td colspan="6"><center><h3>Tidak ada data!</h3></center></td>
                                    </tr>
                                @else
                                    @foreach ($data as $row)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            @if ($row->bulan==1)
                                    <td>Januari</td>
                                  @elseif ($row->bulan==2)
                                    <td>Februari</td>
                                  @elseif ($row->bulan==3)
                                    <td>Maret</td>
                                  @elseif ($row->bulan==4)
                                    <td>April</td>
                                  @elseif ($row->bulan==5)
                                    <td>Mei</td>
                                  @elseif ($row->bulan==6)
                                    <td>Juni</td>
                                  @elseif ($row->bulan==7)
                                    <td>Juli</td>
                                  @elseif ($row->bulan==8)
                                    <td>Agustus</td>
                                  @elseif ($row->bulan==9)
                                    <td>September</td>
                                  @elseif ($row->bulan==10)
                                    <td>Oktober</td>
                                  @elseif ($row->bulan==11)
                                    <td>November</td>
                                  @elseif ($row->bulan==12)
                                    <td>Desember</td>
                                  @endif
                                            <td>{{$row->tahun}}</td>
                                            <td>Rp {{number_format($row->income)}}</td>
                                            <td>Rp {{number_format($row->shipping_cost)}}</td>
                                            <td>Rp {{number_format($row->clean_income)}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                </div>
            </section>
        </div>
    </div>
</section>

@endsection
@section ('chart')
            {!! $chart->script() !!}
            @endsection