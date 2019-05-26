@extends ('master-dashboard')

@section ('title', 'Yearly Report')

@section ('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Yearly Report</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <i class="fa fa-home"></i>
                </li>
                <li><span>Yearly Report</span></li>
            </ol>
            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>
        

    <div class="row">
        <div class="col">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>
                    </div>
                    <h2 class="panel-title">Yearly Transaction Chart</h2>
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
                    <h2 class="panel-title">Yearly Transaction Table</h2>
                </header>
                <div class="panel-body">
                    <table class="table table-bordered table-hover mb-none" id="datatable-default">
							<thead>
								<tr>
                                    <th>#</th>
                                    <th>Tahun</th>
                                    <th>Jumlah</th>
                                    <th>Ongkir</th>
                                    <th>Bersih</th>
								</tr>
							</thead>
							<tbody>
                                @if ($data->isEmpty())
                                    <tr>
                                        <td colspan="5"><center><h3>Tidak ada data!</h3></center></td>
                                    </tr>
                                @else
                                    @foreach ($data as $row)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
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