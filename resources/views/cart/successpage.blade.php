@extends('layouts.cart')

@section('content')
<!-- 3 CATALOG -->
<div class="location-block"  >
</div> <div class="clear"></div>

<div class="shop-cart-3" ><!--  SHOPPING CART 2st STEP ---------->

	<h3>Thank you</h3>
	<div class="scart3-container">
        <div class="scart3-details">
            <div class="scart3-description amc-message">
				<p>Thank You for your car reservation! Please, print your voucher!</p> <a href="/voucher/{{$order->company_id}}/{{$order->id}}" target="_blank" class="amc-btn">Print voucher</a> <a href="{{route('web.rentcar.index')}}" class="amc-btn">Back to Rental Car</a>
            </div>
            <div class="clear"></div>
        </div>
	</div>

</div><!-- / SHOPPING CART 1st STEP ---------->

<!-- / 3 CATALOG -->

@endsection
