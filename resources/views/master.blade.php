<!doctype html>
<html class="fixed sidebar-left-collapsed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Menu Collapsed Layout | Okler Themes | Porto-Admin</title>
		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="{!! asset('dashboard-assets/vendor/bootstrap/css/bootstrap.css')!!}" />
		<link rel="stylesheet" href="{!! asset('dashboard-assets/vendor/font-awesome/css/font-awesome.css')!!}" />
		<link rel="stylesheet" href="{!! asset('dashboard-assets/vendor/magnific-popup/magnific-popup.css')!!}" />
		<link rel="stylesheet" href="{!! asset('dashboard-assets/vendor/bootstrap-datepicker/css/datepicker3.css')!!}" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="{!! asset('dashboard-assets/stylesheets/theme.css')!!}" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="{!! asset('dashboard-assets/stylesheets/skins/default.css')!!}" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="{!! asset('dashboard-assets/stylesheets/theme-custom.css')!!}">

		<!-- Head Libs -->
		<script src="{!! asset('dashboard-assets/vendor/modernizr/modernizr.js')!!}"></script>

	</head>
	<body>
		<section class="body">

			<!-- start: header -->
			<header class="header">
				<div class="logo-container">
					<a href="#" class="logo">
						<img src="{!! asset('dashboard-assets/images/logo.png')!!}" height="35" alt="Porto Admin" />
					</a>
					<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>
			
				<!-- start: search & user box -->
				<div class="header-right">
			
					<form action="#" class="search nav-form">
						<div class="input-group input-search">
							<input type="text" class="form-control" name="q" id="q" placeholder="Search...">
							<span class="input-group-btn">
								<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
							</span>
						</div>
					</form>
			
					<span class="separator"></span>
			
					<ul class="notifications">
						<li>
							<a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
								<i class="fa fa-bell"></i>
								{{-- <span class="badge">3</span> --}}
							</a>
			
							<div class="dropdown-menu notification-menu">
								<div class="notification-title">
									{{-- <span class="pull-right label label-default">3</span> --}}
									Notification
								</div>
			
								<div class="content">
									<ul>
										<li>
											<a href="#" class="clearfix">
												<div class="image">
													<i class="fa fa-thumbs-down bg-danger"></i>
												</div>
												<span class="title">Server is Down!</span>
												<span class="message">Just now</span>
											</a>
										</li>
										<li>
											<a href="#" class="clearfix">
												<div class="image">
													<i class="fa fa-lock bg-warning"></i>
												</div>
												<span class="title">User Locked</span>
												<span class="message">15 minutes ago</span>
											</a>
										</li>
										<li>
											<a href="#" class="clearfix">
												<div class="image">
													<i class="fa fa-signal bg-success"></i>
												</div>
												<span class="title">Connection Restaured</span>
												<span class="message">10/10/2014</span>
											</a>
										</li>
									</ul>
			
									<hr />
			
									<div class="text-right">
										<a href="#" class="view-more">View All</a>
									</div>
								</div>
							</div>
						</li>
					</ul>
			
					<span class="separator"></span>
			
					<div id="userbox" class="userbox">
						<a href="#" data-toggle="dropdown">
							<figure class="profile-picture">
								<img src="{!! asset('dashboard-assets/images/!logged-user.jpg')!!}" alt="Joseph Doe" class="img-circle" data-lock-picture="{!! asset('dashboard-assets/images/!logged-user.jpg')!!}" />
							</figure>
							<div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
								<span class="name">John Doe Junior</span>
								<span class="role">administrator</span>
							</div>
			
							<i class="fa custom-caret"></i>
						</a>
			
						<div class="dropdown-menu">
							<ul class="list-unstyled">
								<li class="divider"></li>
								<li>
									<a role="menuitem" tabindex="-1" href="#"><i class="fa fa-user"></i> My Profile</a>
								</li>
								<li>
									<a role="menuitem" tabindex="-1" href="#"><i class="fa fa-power-off"></i> Logout</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- end: search & user box -->
			</header>
			<!-- end: header -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<aside id="sidebar-left" class="sidebar-left">
				
					<div class="sidebar-header">
						<div class="sidebar-title">
							Navigation
						</div>
						<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
							<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
						</div>
					</div>
				
					<div class="nano">
						<div class="nano-content">
							<nav id="menu" class="nav-main" role="navigation">
								<ul class="nav nav-main">
									<li>
										<a href="#">
											<i class="fa fa-home" aria-hidden="true"></i>
											<span>Dashboard</span>
										</a>
									</li>
									<li>
										<a href="#">
											<i class="fa fa-envelope" aria-hidden="true"></i>
											<span>Mailbox</span>
										</a>
									</li>
									<li class="nav-parent">
										<a>
											<i class="fa fa-copy" aria-hidden="true"></i>
											<span>Pages</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="#">
													 Sign Up
												</a>
											</li>
											<li>
												<a href="#">
													 Sign In
												</a>
											</li>
											<li>
												<a href="#">
													 Recover Password
												</a>
											</li>
											<li>
												<a href="#">
													 Locked Screen
												</a>
											</li>
										</ul>
									</li>
								</ul>
							</nav>
						</div>
					</div>
				
				</aside>
				<!-- end: sidebar -->

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Dashboard</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<i class="fa fa-home"></i>
								</li>
							</ol>
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- start: page -->

					<!-- end: page -->
				</section>
			</div>

			<aside id="sidebar-right" class="sidebar-right">
				<div class="nano">
					<div class="nano-content">
						<a href="#" class="mobile-close visible-xs">
							Collapse <i class="fa fa-chevron-right"></i>
						</a>
			
						<div class="sidebar-right-wrapper">
			
							<div class="sidebar-widget widget-calendar">
								<h6>Calendar</h6>
								<div data-plugin-datepicker data-plugin-skin="dark" ></div>
							</div>
			
						</div>
					</div>
				</div>
			</aside>
			<!-- Vendor -->
			<script src="{!! asset('dashboard-assets/vendor/jquery/jquery.js')!!}"></script>
			<script src="{!! asset('dashboard-assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js')!!}"></script>
			<script src="{!! asset('dashboard-assets/vendor/bootstrap/js/bootstrap.js')!!}"></script>
			<script src="{!! asset('dashboard-assets/vendor/nanoscroller/nanoscroller.js')!!}"></script>
			<script src="{!! asset('dashboard-assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js')!!}"></script>
			<script src="{!! asset('dashboard-assets/vendor/magnific-popup/magnific-popup.js')!!}"></script>
			<script src="{!! asset('dashboard-assets/vendor/jquery-placeholder/jquery.placeholder.js')!!}"></script>
			
			<!-- Specific Page Vendor -->
			
			<!-- Theme Base, Components and Settings -->
			<script src="{!! asset('dashboard-assets/javascripts/theme.js')!!}"></script>
			
			<!-- Theme Custom -->
			<script src="{!! asset('dashboard-assets/javascripts/theme.custom.js')!!}"></script>
			
			<!-- Theme Initialization Files -->
			<script src="{!! asset('dashboard-assets/javascripts/theme.init.js')!!}"></script>

		</section>
	</body>
</html>