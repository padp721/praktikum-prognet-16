@extends ('master-dashboard')

@section ('title', 'Product Review')

@section ('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Product Review</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <i class="fa fa-home"></i>
                </li>
                <li><span>Product Review</span></li>
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
                    <h2 class="panel-title">Tabel Review</h2>
                </header>
                <div class="panel-body">
                    <table class="table table-bordered table-hover mb-none" id="datatable-default">
							<thead>
								<tr>
						    		<th>#</th>
                                    <th>R. ID</th>
                                    <th>Product</th>
									<th>User</th>
									<th>Rate</th>
									<th>Content</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
                                @if ($reviews->isEmpty())
                                    <tr>
                                        <td colspan="7"><center><h3>Tidak ada data!</h3></center></td>
                                    </tr>
                                @else
                                    @foreach ($reviews as $review)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$review->id}}</td>
                                            <td>{{$review->product->product_name}}</td>
                                            <td>{{$review->user->name}}</td>
                                            <td>{{$review->rate}}</td>
                                            <td>
                                                <button class="btn btn-default" data-toggle="modal" data-target="#modalContent-{{ $review->id}}">Load Review</button>
                                                @if ($review->has('response'))
                                                <button class="btn btn-default" data-toggle="modal" data-target="#modalContentAdmin-{{ $review->id}}">Load Response</button>
                                                @endif
                                            </td>
                                            <td class="actions-fade">
                                                <button class="btn btn-default" data-toggle="modal" data-target="#modalResponse-{{ $review->id}}"><i class="fa fa-pencil"></i></button>
										        <button class="btn btn-danger" data-toggle="modal" data-target="#modalDeleteReview-{{ $review->id}}"><i class="fa fa-trash-o"></i></button>
									        </td>
                                        </tr>

<!-- Modal content -->
<div class="modal fade" id="modalContent-{{ $review->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Users Review</h4>
            </div>
            <div class="modal-body">
                <textarea class="form-control" name="desc" id="desc" rows="5" readonly>{{$review->content}}</textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- end modal content --}}

@if ($review->has('response'))
<!-- Modal content -->
<div class="modal fade" id="modalContentAdmin-{{ $review->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Admins Response</h4>
            </div>
            <div class="modal-body">
                @foreach ($review->response as $respon)
                <h4>{{$respon->admin->name}}</h4>
                <textarea class="form-control" name="desc" id="desc" rows="5" readonly>{{$respon->content}}</textarea>
                <form action="{{route('response.destroy',$respon->id)}}" method="post">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" name="delres" id="delres">
                    <input type="submit" style="margin-top:2%;margin-bottom:5%;" class="btn btn-sm btn-danger" value="Delete">
                </form>
                <br>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- end modal content --}}
@endif

{{-- Modal Delete Review --}}
<div class="modal fade" id="modalDeleteReview-{{$review->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4>
            </div>
            <div class="modal-body">
                <form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate" method="POST" action="{{route('response.destroy',$review->id)}}">
                    @method('DELETE')
                    @csrf
                    <div class="form-group mt-lg">
                        <div class="text-center">
                            <input type="hidden" name="delrev" id="delrev">
                            <h5>Are you sure want to delete this review?</h5>
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
{{-- end modal delete Review --}}


{{-- Modal Delete Product --}}
<div class="modal fade" id="modalResponse-{{$review->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Admins Response</h4>
            </div>
            <div class="modal-body">
                <form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate" method="POST" action="{{route('response.store')}}">
										@csrf
							<p>Your Response</p>
							<div class="review_box">
                                <input type="hidden" name="review_id" value="{{$review->id}}">
                  <div class="form-group">
                    <textarea class="form-control different-control w-100" name="content" id="content" cols="30" rows="5" placeholder="Enter Message"></textarea>
                  </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Submit</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </form>
            </div>
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
            </section>
        </div>
    </div>
</section>

@endsection