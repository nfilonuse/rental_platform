<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="{{ config('app.locale') }}">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link type="text/css" rel="stylesheet" href="/css/style.css" />
	<link type="text/css" rel="stylesheet" href="/css/mediaqueries.css" />
	<link type="text/css" rel="stylesheet" href="/css/jquery-ui.css">



	<link href="/css/jquery.formstyler.css" rel="stylesheet" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript" src="/js/jquery-ui.min.js"></script>

	<!-- table-->
	<link rel="stylesheet" type="text/css" href="/css/jquery.dataTables.min.css">
	<script type="text/javascript" src="/js/jquery.dataTables.js"></script>
	<link type="text/css" rel="stylesheet" href="/css/responsive.css" />
	<script type="text/javascript" src="/js/responsive.js"></script>
	<!-- / table-->

	<script src="/js/jquery.formstyler.min.js"></script>
	<script>
		(function($) {
		$(function() {
			$('select').styler({
				selectSearch: false,
				locale: 'en',
				locales: {
					'en': {
						filePlaceholder: 'No file selected',
						fileBrowse: 'Browse...',
						fileNumber: 'Selected files: %s',
						selectPlaceholder: 'Select...',
						selectSearchNotFound: 'No matches found',
						selectSearchPlaceholder: 'Search...'
					}
				}
			});
			$('.datepicker').datepicker();

		});
		})(jQuery);
	</script>

    <!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<script type="text/javascript" src="/js/custom.js"></script>

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>

<body>
	<div class="container">
		<div class="wrapper">

			<div class="header">
				<div class="logo"><a href="/"></a></div>
			    <div class="right-buttons">
			        @if (Auth::guest())
				        <a href="{{ route('login') }}" class="login-button">login</a>
			        @else
			   			<a href="{{ route('logout') }}" class="login-button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
			   			@if(Auth::User()->role_id!=3)
				   			<a href="{{ route('account.index') }}" class="login-button amc-account">Account</a>
			   			@endif
			   			<a href="{{ route('web.rentcar.show') }}" class="login-button amc-cart">Cart</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							{{ csrf_field() }}
						</form>
					@endif
		   			<a href="{{ route('web.help.index') }}" target="_blank" class="login-button amc-help">Help</a>
			        <div class="mob-menu-button toggleMenu"><a href=""></a></div>
			    </div>
    <!-- MOBILE MENU -->
		    	<div class="mobile-menu">
					<ul class="mm-nav" style="display: none;">
			        @if (Auth::guest())
				        <li><a href="{{ route('login') }}" class="login-button">login</a></li>
		   				<li><a href="{{ route('web.help.index') }}" target="_blank" class="login-button amc-help">Help</a></li>
			        @else
			   			<li><a href="{{ route('logout') }}" class="login-button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
			   			@if(Auth::User()->role_id!=3)
				   			<li><a href="{{ route('account.index') }}" class="login-button amc-account">Account</a></li>
			   			@endif
			   			<li><a href="{{ route('web.rentcar.show') }}" class="login-button amc-cart">Cart</a></li>
		   				<li><a href="{{ route('web.help.index') }}" target="_blank" class="login-button amc-help">Help</a></li>
						<li><form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							{{ csrf_field() }}
						</form></li>
					@endif
					</ul>
		        </div>
    <!-- / MOBILE MENU -->
			</div>
			<!-- ADMIN page -->
			<div class="admin-page" >
				<div class="ap-wrapper">
			    	<!-- menu -->
			    	<div class="ap-menu">

			            <ul class="ap-nav">
			            	<!-- 1 --
							<li  class="ap-first">
								<a href="#">Profile</a>
								<ul>
									<li>
										<a href="/coming-soon">MY ORDERS</a>
									</li>
									<li>
										<a href="/account/my-profile">EDIT PROFILE</a>
									</li>
								</ul>
							</li>
			                <!-- / 1 -->
			                <!-- 2 -->
							<li>
								<a href="#">Cars</a>
								<ul>
									<li><a href="/admin/retrieveres">RETRIEVE RESERVATION</a></li>
									<li><a href="/admin/cancelres">Cancel Car Reservation</a></li>
								</ul>
							</li>
			                <!-- / 2 -->
			                <!-- 3 -->
							<li>
								<a target="_blank" href="https://gogoflorida.us/hotel-search5.php">Hotels</a>
								<ul>
									<li><a target="_blank" href="https://gogoflorida.us/hotel-search5.php">Markup percentage</a></li>
									<li><a target="_blank" href="https://gogoflorida.us/hotel-search5.php">View Reservation</a></li>
			                        <li><a target="_blank" href="https://gogoflorida.us/hotel-search5.php">View HB Reservation</a></li>
			                        <li><a target="_blank" href="https://gogoflorida.us/hotel-search5.php">Cancel Reservation</a></li>
								</ul>
							</li>
			                <!-- / 3 -->
			                <!-- 4 -->
				   			@if(Auth::User()->role_id==1)
							<li>
								<a href="#">Administrator</a>
								<ul>
									<li><a href="/admin/locations">Locations</a></li>
									<li>
										<a href="#">Users</a>
										<ul>
											<li><a href="/admin/users">All Users</a></li>
											<li><a href="/admin/affiliate_users">Affiliate Users</a></li>
										</ul>
									</li>
									<li>
										<a href="/admin/coupons">Coupons</a>
									</li>
									<li>
										<a href="/admin/rates">Rates</a>
										<ul>
											<li><a href="/admin/rates">Rates</a></li>
											<li><a href="/admin/accounts">Accounts</a></li>
											<li><a href="/admin/packages">Packages</a></li>
											<li><a href="/admin/areas">Areas</a></li>
											<li><a href="/admin/driverlicence">Driver licence</a></li>
											<li><a href="/admin/sipps">Sipps</a></li>
											<li><a href="/admin/carclasses">Car classes</a></li>
											<li><a href="/admin/cardors">Car dors</a></li>
										</ul>
									</li>
									<li>
										<a href="#">System Lits</a>
										<ul>
											<li><a href="/admin/typecoupons">Coupons type</a></li>
											<li><a href="/admin/typerentals">Rentals type</a></li>
											<li><a href="/admin/statuscoupons">Coupons status</a></li>
										</ul>
									</li>
									<li>
										<a href="#">Reports</a>
										<ul>
											<li><a href="/admin/reports/report1">Sales Report 1</a></li>
											<li><a href="/admin/reports/report2">Sales Report 2</a></li>
										</ul>
									</li>
								</ul>
							</li>
							@endif
			                <!-- / 4 -->
			             </ul>

			            <div class="clear"></div>

			        </div>
			    	<!-- / menu -->
			        <!-- search block -->
			        <div class="ap-search-line">
        				<h3>@yield('title')</h3>
			            <!--
			            <div class="ap-search-block">
			            	<div class="ap-search-input"><input type="text" value="Reservation Number/ Name" /></div>
			                <div class="ap-search-submit"><input type="submit" value="Search" /></div>
			                <div class="clear"></div>
			            </div>
			            -->
			            <div class="clear"></div>
			        </div>
			        <!-- / search block -->

	        @yield('content')

		    	</div>
			</div>
			<!-- /ADMIN page -->

			<div class="clear"></div>
			<!-- /RENTAL COMPANY page -->
		</div><!-- /wrapper -->

		<div class="footer"  >
			<div class="footer-wrapper">
    			<div class="footer-upper-line">
					<div class="footer-logo"><a href="/"></a></div>
					<div class="footer-logo amc_gogo"><a target="_blank" href="https://gogoflorida.us"></a></div>
<!--					
        			    <div class="footer-socials">
		            	<ul>
						<li class="footer-twitter"><a target="_blank" href="https://twitter.com/GoGoFloridaUS"></a></li>
						<li class="footer-facebook"><a target="_blank" href="https://www.facebook.com/www.gogoflorida.us"></a></li>
						<li class="footer-linkedin"><a target="_blank" href="https://www.linkedin.com/"></a></li>
						<li class="footer-youtube"><a target="_blank" href="https://www.youtube.com/"></a></li>
					</ul>
		                <div class="clear"></div>
        		    </div>
-->					
		            <div class="footer-menu">
        		    	<ul>
						<li><a href="{{ route('web.pages.about') }}">About</a></li>
						<li><a href="{{ route('web.pages.privacy') }}">Privacy</a></li>
<!--
						<li><a href="/coming-soon">CR8 Protect Package</a></li>
-->							
						<li><a href="{{ route('web.pages.faq') }}">FAQ</a></li>
						<li><a href="https://gogoflorida.us" target="_blank">Legacy Site</a></li>
						<!--
						<li><a href="/coming-soon">Corporate Site</a></li>
						<li><a href="/coming-soon">Reviews</a></li>
	-->							
						<li><a href="{{ route('web.pages.contactus') }}">Contact</a></li>
<!--
						<li><a href="/coming-soon">Discounts</a></li>
						<li><a href="/coming-soon">Conditions</a></li>
	-->							
					</ul>
		                <div class="clear"></div>
		            </div>
        		    <div class="footer-logos">
						<div class="footer-op-logo"><a class="bahamasair-logo" target="_blank" href="http://www.bahamasair.com/"></a></div>
						<div class="footer-op-logo"><a class="thrifty-logo" target="_blank" href="javascript:void(0)"></a></div>
						<div class="footer-op-logo"><a class="herz-logo" target="_blank" href="javascript:void(0)"></a></div>
		            	<div class="footer-op-logo"><a class="dollar-logo" target="_blank" href="javascript:void(0)"></a></div>
		           </div>
		           <div class="clear"></div>
		 		</div>
		 		<div class="clear"></div>
				 <div class="footer-copyright">Copyright	&copy; 2017 - 2018 GoGoFlorida. All Rights Reserved. Developed by <a target="_blank" href="http://www.softaddicts.com/">Softaddicts.com</a></div>
			 </div><!-- /footer wrapper -->
	</div>
</div><!-- /container -->
<!-- menu script-->
<script type="text/javascript" src="/js/header-menu-script.js"></script>
<script type="text/javascript" src="/js/menu-script.js"></script>
<!-- menu script-->

<!-- DataTable script -->
<script>
  $(function(){
    $("#example").dataTable();
  })
  </script>

</body>
</html>