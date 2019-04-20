@extends ('master-dashboard')

@section ('title', 'Product Categories')

@section ('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Product Categories</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <i class="fa fa-home"></i>
                </li>
                <li><span>Product Categories</span></li>
            </ol>
            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>
    <!-- start: page -->
    <div class="row">
        @if (session('success'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ session('success') }}
                </div>
            @endif
            @if (session('fail'))
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ session('fail') }}
                </div>
            @endif
        <div class="col-md-6">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>
                    </div>
                    <h2 class="panel-title">Product Categories Data</h2>
                </header>
                <div class="panel-body">
                    <div class="">
					    <table class="table table-bordered table-hover mb-none" id="datatable-default">
							<thead>
								<tr>
						    		<th>#</th>
									<th>Product Categories</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
                                @if ($data_categories->isEmpty())
                                    <tr>
                                        <td colspan="3"><center><h3>Tidak ada data!</h3></center></td>
                                    </tr>
                                @else
                                    @foreach ($data_categories as $row)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$row->category_name}}</td>
                                            <td class="actions-fade">
                                                <button class="btn btn-default" data-mycategories="{{$row->category_name}}" data-idcategories="{{$row->id}}" data-toggle="modal" data-target="#modalEditCategories"><i class="fa fa-pencil"></i></button>
										        <button class="btn btn-danger" data-idcategories="{{$row->id}}" data-toggle="modal" data-target="#modalDeleteCategories"><i class="fa fa-trash-o"></i></button>
									        </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
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
                    <h2 class="panel-title">Add New Category</h2>
                </header>
                <div class="panel-body">
                    <form class="form-horizontal form-bordered" method="POST" action="{{route('categories.store')}}">
                        @csrf
                        <div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Category Name</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="inputDefault" name="category_name" placeholder="Type category name..." required>
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

<!-- Modal Form -->
<div class="modal fade" id="modalEditCategories" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Categories</h4>
            </div>
            <div class="modal-body">
                <form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate" method="POST" action="{{route('categories.update','do-update')}}">
                    @method('PATCH')
                    @csrf
                    <div class="form-group mt-lg">
                        <label class="col-sm-3 control-label">Categories Name</label>
                        <div class="col-sm-8">
                            <input type="hidden" name="idcategories" id="idcategories">
                            <input type="text" name="category_name" id="category_name" class="form-control" placeholder="Type category name..." required />
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Confirm</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="modalDeleteCategories" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4>
            </div>
            <div class="modal-body">
                <form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate" method="POST" action="{{route('categories.destroy','do-delete')}}">
                    @method('DELETE')
                    @csrf
                    <div class="form-group mt-lg">
                        <div class="text-center">
                            <input type="hidden" name="idcategories" id="idcategories">
                            <h5>Are you sure want to delete this courier?</h5>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Yes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection