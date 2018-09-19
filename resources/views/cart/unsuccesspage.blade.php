@extends('layouts.cart')

@section('content')
<!-- 3 CATALOG -->
<div class="location-block"  >
</div> <div class="clear"></div>

<div class="shop-cart-3" ><!--  SHOPPING CART 2st STEP ---------->

	<h3>Whoops, something went wrong!</h3>
	<div class="scart3-container">
        <div class="scart3-details">
            <div class="scart3-description amc-message">
<!--
				<p>Error# {{$errors}}</p>
-->
				<p>We are sorry, but payment was unsuccessful! Please try again! If you have a questions, please contact us at (954) 636-1327; (954) 662 1493 or support@gogoflorida.us</p>
				<p><a href="{{route('web.rentcar.show')}}" class="amc-btn">Back to Cart</a> <a href="{{route('web.rentcar.index')}}" class="amc-btn">BACK TO HOME PAGE</a></p>
            </div>
            <div class="clear"></div>
        </div>
	</div>


</div><!-- / SHOPPING CART 1st STEP ---------->

<!-- / 3 CATALOG -->

@endsection
