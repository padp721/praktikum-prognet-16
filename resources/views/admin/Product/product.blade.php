@extends ('master-dashboard')

@section ('title', 'Product List')

@section ('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Product</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <i class="fa fa-home"></i>
                </li>
                <li><span>Product</span></li>
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
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>
                    </div>
                    <h2 class="panel-title">Product List</h2>
                </header>
                <div class="panel-body">
                    <div class="">
                        <a href="{{ route('product.create') }}" class="btn btn-primary" ><i class="fa fa-plus"></i>&nbsp; Add New Product</a><br><br>
					    <table class="table table-bordered table-hover mb-none" id="datatable-default">
							<thead>
								<tr>
						    		<th>#</th>
                                    <th>Product Name</th>
                                    <th>Categories</th>
									<th>Price</th>
									<th>Description</th>
									<th>Product Rate</th>
									<th>Stock</th>
									<th>Diskon</th>
									<th>Images</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
                                @if ($data_product->isEmpty())
                                    <tr>
                                        <td colspan="9"><center><h3>Tidak ada data!</h3></center></td>
                                    </tr>
                                @else
                                    @foreach ($data_product as $row)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$row->product_name}}</td>
                                            <td>
                                                @foreach ($row->categories as $category)
                                                    <ul>
                                                        <li>{{$category->category_name}}</li>
                                                    </ul>
                                                @endforeach
                                            </td>
                                            <td>Rp {{number_format($row->price)}}</td>
                                            <td><button class="btn btn-default" data-desc="{{$row->description}}" data-toggle="modal" data-target="#modalViewDesc">View Description</button></td>
                                            <td>{{$row->product_rate}}</td>
                                            <td>{{$row->stock}}</td>
                                            <td>{{$row->discount}}%</td>
                                            <td>
                                                {{-- @foreach ($row->product_images as $image)
                                                <img src="{{ asset('/storage/product_image/'.$image->image_name) }}" alt="logo_simple"  width="200px" height="200px">                                                    
                                                @endforeach --}}
                                                <button class="btn btn-default" data-toggle="modal" data-target="#modalViewImages-{{ $row->id}}">View Images</button>
                                            </td>
                                            <td class="actions-fade">
                                                <a href="{{route('product.edit',$row->id)}}" class="btn btn-default" role="button"><i class="fa fa-pencil"></i></a>
										        <button class="btn btn-danger" data-toggle="modal" data-target="#modalDeleteProduct-{{ $row->id}}"><i class="fa fa-trash-o"></i></button>
									        </td>
                                        </tr>
                                        
<!-- Modal Gambars -->
<div class="modal fade" id="modalViewImages-{{ $row->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Product Images</h4>
            </div>
            <div class="modal-body">
                <center>
                    <div id="gambar" class="owl-carousel" data-plugin-carousel data-plugin-options='{ "items": 1,  "navigation": true, "pagination": false }'>
                        @foreach ($row->product_images as $image)
                            <div class="item">
                                <img alt="" class="img-responsive" src="{{ asset('/storage/product_image/'.$image->image_name) }}">
                            </div> 
                        @endforeach
                    </div>
                </center>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Gambars -->

{{-- Modal Delete Product --}}
<div class="modal fade" id="modalDeleteProduct-{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4>
            </div>
            <div class="modal-body">
                <form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate" method="POST" action="{{route('product.destroy',$row->id)}}">
                    @method('DELETE')
                    @csrf
                    <div class="form-group mt-lg">
                        <div class="text-center">
                            <input type="hidden" name="idcategories" id="idcategories">
                            <h5>Are you sure want to delete this product?</h5>
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
{{-- end modal delete product --}}

                                    @endforeach
                                @endif
                            </tbody>
                        </table>
					</div>
                </div>
            </section>
        </div>
    </div>
</section>

<!-- Modal Deskripsi -->
<div class="modal fade" id="modalViewDesc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Product Description</h4>
            </div>
            <div class="modal-body">
                <textarea class="form-control" name="desc" id="desc" rows="5" readonly>

                </textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection