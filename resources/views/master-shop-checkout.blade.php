<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield ('title')</title>
	<link rel="icon" href="{!! asset('shop-assets/img/Fevicon.png')!!}" type="image/png">
  <link rel="stylesheet" href="{!! asset('shop-assets/vendors/bootstrap/bootstrap.min.css')!!}">
  <link rel="stylesheet" href="{!! asset('shop-assets/vendors/fontawesome/css/all.min.css')!!}">
	<link rel="stylesheet" href="{!! asset('shop-assets/vendors/themify-icons/themify-icons.css')!!}">
  <link rel="stylesheet" href="{!! asset('shop-assets/vendors/nice-select/nice-select.css')!!}">
  <link rel="stylesheet" href="{!! asset('shop-assets/vendors/owl-carousel/owl.theme.default.min.css')!!}">
  <link rel="stylesheet" href="{!! asset('shop-assets/vendors/owl-carousel/owl.carousel.min.css')!!}">

  <link rel="stylesheet" href="{!! asset('shop-assets/css/style.css')!!}">
</head>
<body>
  <!--================ Start Header Menu Area =================-->
	<header class="header_area">
    <div class="main_menu">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
          <a class="navbar-brand logo_h" href="{{route('index')}}"><img src="{!! asset('shop-assets/img/logo.png')!!}" alt=""></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
            <ul class="nav navbar-nav menu_nav ml-auto mr-auto">
              <li class="nav-item active"><a class="nav-link" href="{{route('index')}}">Home</a></li>
              <li class="nav-item submenu dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                  aria-expanded="false">Shop</a>
                <ul class="dropdown-menu">
                  <li class="nav-item"><a class="nav-link" href="{{route('user.product_list')}}">All Product</a></li>
                </ul>
			    </li>
            </ul>

            <ul class="nav-shop">
							@if (Route::has('login'))
							@auth
								<div class="dropdown">
								<li><button class="nav-item dropdown-toggle" data-toggle="dropdown"><i class="ti-bell"></i>@if (!$user->unreadNotifications->isEmpty())<span class="nav-shop__circle">{{$user->unreadNotifications->count()}}</span>@endif</button>
										<div class="dropdown-menu">
											<div class="dropdown-header">Notifications</div>
											@if ($user->unreadNotifications->isEmpty())
											<a class="dropdown-item" href="#">Nothing to show.</a>
											@else
												@foreach ($user->unreadNotifications as $notification)
													@switch($notification->type)
															@case('App\Notifications\AdminResponse')
															<div class="dropdown-divider"></div>
																<a class="dropdown-item" href="{{route('user.notifications',$notification->id)}}">
																	Your review was replied by admin.
																	<p class="small">Product : {{$notification->data['product_name']}}</p>
																</a>
																@break
															@case('App\Notifications\AdminVerify')
															<div class="dropdown-divider"></div>
																<a class="dropdown-item" href="{{route('user.notifications',$notification->id)}}">
																	Your transaction has been verified.
																	<p class="small">Transaction ID : {{$notification->data['transaction_id']}}</p>
																</a>
																@break
															@case('App\Notifications\AdminDeliver')
															<div class="dropdown-divider"></div>
																<a class="dropdown-item" href="{{route('user.notifications',$notification->id)}}">
																	Your package is delivered to your location.
																	<p class="small">Transaction ID : {{$notification->data['transaction_id']}}</p>
																</a>
																@break
															@case('App\Notifications\CancelPurchase')
															<div class="dropdown-divider"></div>
																<a class="dropdown-item" href="{{route('user.notifications',$notification->id)}}">
																	Your purchase has been cancelled by admin.
																	<p class="small">Transaction ID : {{$notification->data['transaction_id']}}</p>
																</a>
																@break
															@default
																	Go on and fuck u'r self.
													@endswitch
												@endforeach
												<div class="dropdown-divider"></div>
													<a class="dropdown-item" href="{{route('user.forget_notification')}}">
														<p class="small">Mark all as Read</p>
													</a>
											@endif
										</div>
									</li>
								<li class="nav-item"><a href="{{route('user.view_cart')}}"><button><i class="ti-shopping-cart"></i>@if (!$cartcount == null)<span class="nav-shop__circle">{{$cartcount}}</span>@endif</button></a></li>
								</div>
							@endauth
							@endif
            </ul>
            <ul class="nav navbar-nav menu_nav ml-auto ml-auto">
							@if (Route::has('login'))
								@auth
									<li class="nav-item submenu dropdown">
										<a class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
									aria-expanded="false" href="#">{{$user->name}}<i class="fas fa-caret-down fa-fw"></i></a>
										<ul class="dropdown-menu">
											<li class="nav-item"><a class="nav-link" href="#">Edit Account</a></li>
											<li class="nav-item"><a class="nav-link" href="{{route('user.transactions')}}">My Transaction</a></li>
											<li class="nav-item"><a class="nav-link" href="{{route('user.logout')}}">Logout</a></li>
										</ul>
									</li>
								@else
									<li class="nav-item"><a class="button button-header" href="{{route('login')}}">Login</a></li>
								@endauth
							@endif
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </header>
	<!--================ End Header Menu Area =================-->


    @yield ('content')


  <!--================ Start footer Area  =================-->	
	<footer class="footer">
		<div class="footer-area">
			<div class="container">
				<div class="row section_gap">
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="single-footer-widget tp_widgets">
							<h4 class="footer_title large_title">Our Mission</h4>
							<p>
								So seed seed green that winged cattle in. Gathering thing made fly you're no 
								divided deep moved us lan Gathering thing us land years living.
							</p>
							<p>
								So seed seed green that winged cattle in. Gathering thing made fly you're no divided deep moved 
							</p>
						</div>
					</div>
					<div class="offset-lg-1 col-lg-2 col-md-6 col-sm-6">
						<div class="single-footer-widget tp_widgets">
							<h4 class="footer_title">Quick Links</h4>
							<ul class="list">
								<li><a href="{{route('index')}}">Home</a></li>
								<li><a href="#">Shop</a></li>
								<li><a href="#">Blog</a></li>
								<li><a href="#">Product</a></li>
								<li><a href="#">Brand</a></li>
								<li><a href="#">Contact</a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-2 col-md-6 col-sm-6">
						<div class="single-footer-widget instafeed">
							<h4 class="footer_title">Gallery</h4>
							<ul class="list instafeed d-flex flex-wrap">
								<li><img src="{!! asset('shop-assets/img/gallery/r1.jpg')!!}" alt=""></li>
								<li><img src="{!! asset('shop-assets/img/gallery/r2.jpg')!!}" alt=""></li>
								<li><img src="{!! asset('shop-assets/img/gallery/r3.jpg')!!}" alt=""></li>
								<li><img src="{!! asset('shop-assets/img/gallery/r5.jpg')!!}" alt=""></li>
								<li><img src="{!! asset('shop-assets/img/gallery/r7.jpg')!!}" alt=""></li>
								<li><img src="{!! asset('shop-assets/img/gallery/r8.jpg')!!}" alt=""></li>
							</ul>
						</div>
					</div>
					<div class="offset-lg-1 col-lg-3 col-md-6 col-sm-6">
						<div class="single-footer-widget tp_widgets">
							<h4 class="footer_title">Contact Us</h4>
							<div class="ml-40">
								<p class="sm-head">
									<span class="fa fa-location-arrow"></span>
									Head Office
								</p>
								<p>123, Main Street, Your City</p>
	
								<p class="sm-head">
									<span class="fa fa-phone"></span>
									Phone Number
								</p>
								<p>
									+123 456 7890 <br>
									+123 456 7890
								</p>
	
								<p class="sm-head">
									<span class="fa fa-envelope"></span>
									Email
								</p>
								<p>
									free@infoexample.com <br>
									www.infoexample.com
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="footer-bottom">
			<div class="container">
				<div class="row d-flex">
					<p class="col-lg-12 footer-text text-center">
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
				</div>
			</div>
		</div>
	</footer>
	<!--================ End footer Area  =================-->



  <script src="{!! asset('shop-assets/vendors/jquery/jquery-3.2.1.min.js')!!}"></script>
  <script src="{!! asset('shop-assets/vendors/bootstrap/bootstrap.bundle.min.js')!!}"></script>
  <script src="{!! asset('shop-assets/vendors/skrollr.min.js')!!}"></script>
  <script src="{!! asset('shop-assets/vendors/owl-carousel/owl.carousel.min.js')!!}"></script>
  <script src="{!! asset('shop-assets/vendors/nice-select/jquery.nice-select.min.js')!!}"></script>
  <script src="{!! asset('shop-assets/vendors/jquery.ajaxchimp.min.js')!!}"></script>
  <script src="{!! asset('shop-assets/vendors/mail-script.js')!!}"></script>
  <script src="{!! asset('shop-assets/js/main.js')!!}"></script>
</body>
</html>
<script>
$("#qty1").on('change',function(){
	$("#qty2").val($(this).val());
});

$("input[name=province]").focusout(function(){
	var province_id = $(this).val();
	var city = {!! json_encode($city) !!};
	$("#regency").empty();
	for(var i = 0 in city){
		if (city[i]['province_id'] == province_id) {
			$('#regency').append($('<option>',
			{
				value: city[i]['city_id'],
				text : city[i]['city_name']
				}));
		}
	}
	console.log(regency); 
});

</script>