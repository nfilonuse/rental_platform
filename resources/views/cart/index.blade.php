@extends('layouts.cart')

@section('content')
<!-- 3 CATALOG -->
<div class="location-block"  >
	<div class="loc-picup">
    	<div class="loc-picup-left"></div>
        <div class="loc-picup-right">
        	<p class="loc-picup-city">{{$data['location-pickup']}}</p>
            <p class="loc-picup-time">{{date('F d Y, h:i A',strtotime($data['date-pickup-value']))}}</p>
        </div>
        <div class="clear"></div>
    </div>
    <div class="loc-picup loc-dropoff">
    	<div class="loc-picup-left"></div>
        <div class="loc-picup-right">
        	<p class="loc-picup-city">{{$data['location-dropoff']}}</p>
            <p class="loc-picup-time">{{date('F d Y, h:i A',strtotime($data['date-dropoff-value']))}}</p>
        </div>
        <div class="clear"></div>
    </div>
    <div class="change-search"><a href="{{ route('web.rentcar.index') }}"><div>Change<br />search</div></a></div>
</div> <div class="clear"></div>
<div class="shop-cart-2" ><!--  SHOPPING CART 2st STEP ---------->

	<h3><!--View Trips-->{{$item['selectcar']['name']}}</h3>
    <div class="scart2-upper">
    	<div class="scart2-u-left">
        	<div class="scart2-left-title">Description</div>
            <div class="scart2-left-content">
            	<div class="scart2-number"></div>
                <div class="scart2-description">
                	<ul>
					<!--
                    	<li>Item Type: car</li>
					-->
                        <li>Company Name:  {{$item['company']['name']}}</li>
                        <li>Rate Code: {{$item['selectcar']['rate_code']}}</li>
                        <li>Pickup Date: {{date('F d Y, h:i A',strtotime($data['date-pickup-value']))}}</li>
                        <li>Dropoff Date: {{date('F d Y, h:i A',strtotime($data['date-dropoff-value']))}}</li>
                        <li>Reservation for Days: {{$item['reservation_for_days']}}</li>
                    </ul>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="scart2-u-right">
        	<div class="scart2-right-title">Amount</div>
            <div class="scart2-right-content">${{number_format($item['reservation_total_amount'],2)}}</div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="scart2-lower">
		<form role="form" method="POST" action="{{ route('web.rentcar.addcoupon') }}">
        {{ csrf_field() }}
    	<div class="scart2-lover-left">
			@if (session('couponerror'))
				<span class="error-couponcode">{{session('couponerror')}}</span>
			@endif
        	<div class="scart2-redeem-line">
            	<div class="scart2-redeem-input"><input type="text" name="coupon_code" placeholder="Car Discount Code" required /></div>
                <div class="scart2-redeem-submit"><input type="submit" value="Redeem" /></div>
                <div class="clear"></div>
            </div>
            <a href="">To apply for a discount code contact support@gogoflorida.us</a>
        </div>
		</form>
        <div class="scart2-lover-right">
        	<ul>
            	<li>
                	<div>Gross Total:</div>
                    <p>${{number_format($item['reservation_total_amount'],2)}}</p>
                </li>
				@if ($item['coupon_id']>0)
                <li>
                	<div>Discount:</div>
                    <p>${{number_format($item['reservation_total_discont'],2)}}</p>
                </li>
				@endif
                <li>
                	<div>Total:</div>
                    <p>${{number_format($item['reservation_total_amount']-$item['reservation_total_discont'],2)}}</p>
                </li>
				@if ($item['coupon_id']>0)
                <li class="scart2-total-redeem">
                	<div>Total Redeem Amount:</div>
                    <p>${{number_format($item['reservation_total_discont'],2)}}</p>
                </li>
                <li class="scart2-total">
                	<div>Total:</div>
                    <p>${{number_format($item['reservation_total_amount']-$item['reservation_total_discont'],2)}}</p>
                </li>
				@endif
            </ul>
        </div>
        <div class="clear"></div>
    </div>

    <div class="scart2-reserve"><a href="{{ route('web.rentcar.billing') }}">Reserve Now</a></div>
    <div class="clear"></div>



</div><!-- / SHOPPING CART 1st STEP ---------->

<!-- / 3 CATALOG -->

@endsection
