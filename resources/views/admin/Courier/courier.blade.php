@extends ('master-dashboard')

@section ('title', 'Courier')

@section ('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Courier</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <i class="fa fa-home"></i>
                </li>
                <li><span>Courier</span></li>
            </ol>
            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>
    <!-- start: page -->
    <div class="row">
        <div class="col-md-6">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>
                    </div>
                    <h2 class="panel-title">Courier Data</h2>
                </header>
                <div class="panel-body">
                    <div class="table-responsive">
					    <table class="table table-hover mb-none">
							<thead>
								<tr>
						    		<th>#</th>
									<th>Couriers Name</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
                                @if ($data_courier->isEmpty())
                                    <tr>
                                        <td colspan="3"><center><h3>Tidak ada data!</h3></center></td>
                                    </tr>
                                @else
                                    @foreach ($data_courier as $row)
                                        <tr>
                                            <td>{{ ($data_courier ->currentpage()-1) * $data_courier ->perpage() + $loop->index + 1 }}</td>
                                            <td>{{$row->courier}}</td>
                                            <td class="actions-hover actions-fade">
										        <a href="#"><i class="fa fa-pencil"></i></a>
										        <a href="#" class="delete-row"><i class="fa fa-trash-o"></i></a>
									        </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        {{ $data_courier->links() }} 
					</div>
                </div>
            </section>
        </div>
        <div class="col-md-6">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>
                    </div>
                    <h2 class="panel-title">Add New Courier</h2>
                </header>
                <div class="panel-body">
                    <form class="form-horizontal form-bordered" method="POST" action="{{route('courier.store')}}">
                        @csrf
                        <div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Courier Name</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="inputDefault" name="courier" required>
							</div>
						</div>
                    </div>
                    <footer class="panel-footer">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-default">Reset</button>
                            </div>
                        </div>
                    </footer>
                </form>
            </section>
        </div>
    </div>
</section>

@endsection