<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="{{ config('app.locale') }}">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link type="text/css" rel="stylesheet" href="/css/style.css" />
	<link type="text/css" rel="stylesheet" href="/css/splash-style.css" />
	<link type="text/css" rel="stylesheet" href="/css/mediaqueries.css" />
	<link rel="stylesheet" href="/css/jquery-ui.css">
	<link rel="stylesheet" href="/css/jquery.qtip.min.css">

	<link href="/css/jquery.formstyler.css" rel="stylesheet" />
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="/js/gogocalendar.js"></script>

	<script type="text/javascript" src="/js/jquery.formstyler.min.js"></script>
	<script type="text/javascript" src="/js/jquery.qtip/jquery.qtip.min.js"></script>

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
			$('.amc_qtip').qtip({
				content: {
					text: function(event, api) {
						console.log($(this).attr('alt'));
						return $(this).attr('alt');

					},
					title: function(event, api) {
						return ''+$(this).attr('title');
					}
				},
				position: {
					my: 'top left',  // Position my top left...
					at: 'bottom left' // at the bottom right of...
				},
				style: {
					classes: 'qtip-light qtip-rounded'
				}
			});
		});
		})(jQuery);
	</script>

	<script type="text/javascript" src="/js/custom.js"></script>

    <!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

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
			    <div class="center-buttons">
			    	<a class="rentcar" href="{{ route('web.rentcar.index') }}">Rent a Car</a>
			        <a class="bookhotel" href="https://gogoflorida.us/hotel-search5.php" target="_blank">Book a Hotel</a>
			    </div>
			    <div class="right-buttons">
<!--					
			    	<div class="share">
        				<ul>
							<li>
								<a href="#"></a>
								<ul>
									<li><a class="menu-facebook" target="_blank" href="https://www.facebook.com/www.gogoflorida.us"></a></li>
									<li><a class="menu-twitter" target="_blank" href="https://twitter.com/GoGoFloridaUS"></a></li>
									<li><a class="menu-google" target="_blank" href="https://plus.google.com/"></a></li>
								</ul>
							</li>
						</ul>
					</div>
		-->					
					<a class="login-button twitter" target="_blank" href="https://twitter.com/GoGoFloridaUS"></a>
					<a class="login-button facebook" target="_blank" href="https://www.facebook.com/www.gogoflorida.us"></a>
			        @if (Auth::guest())
				        <a href="{{ route('login') }}" class="login-button">login</a>
			   			<a href="{{ route('web.rentcar.show') }}" class="login-button amc-cart">Cart</a>
			        @else
			   			<a href="{{ route('logout') }}" class="login-button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
			   			<a href="{{ route('account.index') }}" class="login-button amc-account">Account</a>
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
			   			<li><a href="{{ route('web.rentcar.show') }}" class="login-button amc-cart">Cart</a></li>
		   				<li><a href="{{ route('web.help.index') }}" target="_blank" class="login-button amc-help">Help</a></li>
			        @else
			   			<li><a href="{{ route('logout') }}" class="login-button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
			   			<li><a href="{{ route('account.index') }}" class="login-button amc-account">Account</a></li>
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
<!--
			<div class="ap-page-title">
   				<h3>@yield('title')</h3>
				<div class="clear"></div>
	        </div>
-->			
	        @yield('content')


			<div class="clear"></div>
			<!-- /RENTAL COMPANY page -->
			<!--
			@if(!isset($_COOKIE['amc_dontshowspalsh']))
			<div class="splash">
				<div class="spl-logo"></div>
    			<h1>Pick your perference - our new site or the one you’re used to.</h1>
    			<h2>You’ll get the same great rates at either.</h2>
    			<div class="spl-central">
    				<a href="{{ route('web.rentcar.index') }}" class="spl-left">
       					<div class="spl-left-pic"><img src="img/sp-new-site.jpg"  alt=""/></div>
            			<h3>GoGoFlorida.com</h3>
						<p>Our new feature rich website with the same great rates you love! <br /><span>Click here</span> to test drive the new site.</p>
					</a>
        			<a  href="https://www.gogoflorida.us/" target="_blank" class="spl-right">
        				<div class="spl-right-pic"><img src="img/sp-old-site.jpg"  alt=""/></div>
            			<h3>GoGoFlorida.us</h3>
            			<p>Our legacy website. We’ve changed the URL but not the rates you love! <br /><span>Click here</span></p>
        			</a>
				</div>
				<div class="clear"></div>
    			<div class="spl-dont-show">
    				<input type="checkbox" onclick="dontshowspalsh(this)" class="spl-checkbox" id="spl-checkbox1" />
					<label for="spl-checkbox1"><span>Don’t show me this message again.</span> <span class="spl-span2">I know where I want to go!</span></label>
    			</div>
			</div>
			@endif
			-->
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
		                <div class="clear"></div>
<!--
						<li><a href="/coming-soon">CR8 Protect Package</a></li>
-->							
						<li><a href="{{ route('web.pages.faq') }}">FAQ</a></li>
						<li><a href="https://gogoflorida.us" target="_blank">Legacy Site</a></li>
		                <div class="clear"></div>
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
	@yield('footercontent')
</div><!-- /container -->
<!-- menu script-->
<script type="text/javascript" src="/js/header-menu-script.js"></script>
<script type="text/javascript" src="/js/menu-script.js"></script>
<!-- menu script-->
</body>
</html>