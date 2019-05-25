@extends ('master-dashboard')

@section ('title', 'Transaction')

@section ('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Transaction</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <i class="fa fa-home"></i>
                </li>
                <li><span>Transaction</span></li>
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
                    <h2 class="panel-title">Tabel Transaction</h2>
                </header>
                <div class="panel-body">
                    <table class="table table-bordered table-hover mb-none" id="datatable-default">
							<thead>
								<tr>
						    		<th>#</th>
                                    <th>T. ID</th>
                                    <th>Date</th>
									<th>Timeout</th>
									<th>Regency</th>
									<th>Province</th>
									<th>Name</th>
									<th>Courier</th>
									<th>Status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
                                @if ($transaction->isEmpty())
                                    <tr>
                                        <td colspan="9"><center><h3>Tidak ada data!</h3></center></td>
                                    </tr>
                                @else
                                    @foreach ($transaction as $row)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$row->id}}</td>
                                            <td>{{$row->date}}</td>
                                            <td>{{$row->timeout}}</td>
                                            <td>{{$city[$row->regency-1]['city_name']}}</td>
                                            <td>{{$province[$row->province-1]['province']}}</td>
                                            <td>{{$row->user->name}}</td>
                                            <td>{{$row->courier->courier}}</td>
                                            <td>{{$row->status}}</td>
                                            <td class="actions-fade">
                                                <a href="{{route('transaction.edit',$row->id)}}" class="btn btn-default" role="button"><i class="fa fa-pencil"></i></a>
										        <button class="btn btn-danger" data-toggle="modal" data-target="#modalDeleteProduct-{{ $row->id}}"><i class="fa fa-trash-o"></i></button>
									        </td>
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