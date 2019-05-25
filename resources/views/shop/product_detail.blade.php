@extends ('master-shop')

@section ('title', 'Toko Kerajinan Online - Product Detail')

@section ('content')

  <!--================Single Product Area =================-->
	<div class="product_image_area">
		<div class="container">
			<div class="row s_product_inner">
				<div class="col-lg-6">
					<div class="owl-carousel owl-theme s_Product_carousel">
                        @foreach ($product->product_images as $image)
                            <div class="single-prd-item">
							    <img class="img-fluid" src="{{ asset('/storage/product_image/'.$image->image_name) }}" alt="">
						    </div>
                        @endforeach
					</div>
				</div>
				<div class="col-lg-5 offset-lg-1">
					<div class="s_product_text">
						<h3>{{$product->product_name}}</h3>
						<h2>Rp {{number_format($product->price)}}</h2>
						<ul class="list">
							<li><a class="active" href="#"><span>Category</span> : @foreach ($product->categories as $category) {{$category->category_name}} @endforeach</a></li>
							<li><a href="#"><span>Availibility</span> : {{$product->stock}}</a></li>
						</ul>
                        <p>{{$product->description}}</p>
                        <div class="row">
                            <div class="col-md-6">
                                <form action="{{ route('user.add_cart',$product->id) }}" method="post">
                                    @csrf
                                    <div class="product_count">
                                        Quantity :
                                        <input type="number" class="form-control" id="qty1" name="qty" min="1" max="{{$product->stock}}" value="1" required>           
                                    </div>
                                    <button type="submit" class="button primary-btn" name="addcart">Add to Cart</button> 
                                </form>
                            </div>
                            <div class="col-md-6">
                                <form method="post" action="{{ route('user.add_cart',$product->id) }}">
                                    @csrf
                                    <input type="hidden" id="qty2" name="qty" value="1" required>
                                    <button type="submit" class="button primary-btn" name="buynow" style="position: absolute; bottom: 0;">Buy Now</button>
                                </form>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
    <!--================End Single Product Area =================-->
    
	<!--================Product Description Area =================-->
	<section class="product_description_area">
		<div class="container">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review"
					 aria-selected="false">Reviews</a>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">
					<div class="row">
						<div class="col-lg-6">
							<div class="row total_rate">
								<div class="col-6">
									<div class="box_total">
										<h5>Overall</h5>
										<h4>{{round($product->product_rate,1)}}</h4>
										<h6>({{$product->reviews->count()}} Reviews)</h6>
									</div>
								</div>
								<div class="col-6">
									<div class="rating_list">
										<h3>Based on {{$product->reviews->count()}} Reviews</h3>
										<ul class="list">
											<li><a href="#">{{$product->reviews->where('rate',5)->count()}}x5 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></a></li>
											<li><a href="#">{{$product->reviews->where('rate',4)->count()}}x4 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></a></li>
											<li><a href="#">{{$product->reviews->where('rate',3)->count()}}x3 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></a></li>
											<li><a href="#">{{$product->reviews->where('rate',2)->count()}}x2 Star <i class="fa fa-star"></i><i class="fa fa-star"></i></a></li>
											<li><a href="#">{{$product->reviews->where('rate',1)->count()}}x1 Star <i class="fa fa-star"></i></a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="review_list">
								<div id="reviews" class="collapse">
								@foreach ($product->reviews as $review)
								<div class="review_item">
									<div class="media">
										<div class="d-flex">
											<img src="{!! asset('shop-assets/img/product/review-1.png')!!}" alt="">
										</div>
										<div class="media-body">
											<h4>{{$review->user->name}}</h4>
											@for ($i = 0; $i < $review->rate; $i++)
											<i class="fa fa-star"></i>
											@endfor
										</div>
										
										<div class="dropdown dropleft">
										<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"></button>
										<div class="dropdown-menu">
											<a class="dropdown-item" data-toggle="modal" data-target="#modalContentAdmin-{{$review->id}}">Lihat Balasan Admin</a>
										@if (Auth::check())
										@if ($user->id == $review->user->id)
											<a class="dropdown-item" data-toggle="modal" data-target="#modalEditReview-{{$review->id}}">Edit</a>
											<a class="dropdown-item" data-toggle="modal" data-target="#modalDeleteReview-{{$review->id}}">Hapus</a>
											@endif
										@endif
										</div>
									</div>
									</div>
									<p>{{$review->content}}</p>
								</div>
								<br><br>

{{-- Modal Delete Product --}}
<div class="modal fade" style="margin-top:5%" id="modalDeleteReview-{{$review->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body">
                <form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate" method="POST" action="{{route('review.destroy',$review->id)}}">
                    @method('DELETE')
                    @csrf
                    <div class="form-group mt-lg">
                        <div class="text-center">
                            <input type="hidden" name="idcategories" id="idcategories">
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
{{-- end modal delete product --}}

{{-- Modal Delete Product --}}
<div class="modal fade" style="margin-top:5%" id="modalEditReview-{{$review->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body">
                <form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate" method="POST" action="{{route('review.update',$review->id)}}">
                    @method('PATCH')
										@csrf
										<h3>Edit Review</h3>
							<p>Your Rating:</p>
							<div class="review_box">
								<select name="rate" id="rate">
									<option value="5" @if ($review->rate == 5) selected  @endif>5</option>
									<option value="4" @if ($review->rate == 4) selected  @endif>4</option>
									<option value="3" @if ($review->rate == 3) selected  @endif>3</option>
									<option value="2" @if ($review->rate == 2) selected  @endif>2</option>
									<option value="1" @if ($review->rate == 1) selected  @endif>1</option>
								</select>
								<br><br>
                  <div class="form-group">
                    <textarea class="form-control different-control w-100" name="content" id="content" cols="30" rows="5" placeholder="Enter Message">{{$review->content}}</textarea>
                  </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Yes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </form>
            </div>
        </div>
    </div>
</div>
								</div>
{{-- end modal delete product --}}

<!-- Modal content -->
<div class="modal fade" style="margin-top:5%" id="modalContentAdmin-{{ $review->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body">
				@if ($review->response->isempty())
					<h1>Tidak ada balasan</h1>
				@else
				@foreach ($review->response as $respon)
					<h4>{{$respon->admin->name}}</h4>
					<textarea class="form-control" name="desc" id="desc" rows="5" readonly>{{$respon->content}}</textarea>
					<br>
					@endforeach
				@endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- end modal content --}}

								@endforeach
								</div>
					</div>
				</div>
				
						<div class="col-lg-6">
							<form action="{{route('review.store')}}" method="POST" class="form-contact form-review mt-3">
								@csrf
							<h4>Add a Review</h4>
							<p>Your Rating:</p>
							<div class="review_box">
								<input type="hidden" name="product_id" value="{{$product->id}}">
								<select name="rate" id="rate">
									<option value="5">5</option>
									<option value="4">4</option>
									<option value="3">3</option>
									<option value="2">2</option>
									<option value="1">1</option>
								</select>
								<br><br>
                  <div class="form-group">
                    <textarea class="form-control different-control w-100" name="content" id="content" cols="30" rows="5" placeholder="Enter Message"></textarea>
                  </div>
                  <div class="form-group text-center text-md-right mt-3">
                    <button type="submit" name="submit" class="button button--active button-review">Submit Now</button>
                  </div>
                </form>
							</div>
						</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group text-center text-md mt-3">
						<a href="#reviews"  data-toggle="collapse" class="button button--active button-review">Show All Review</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Product Description Area =================-->

  @endsection