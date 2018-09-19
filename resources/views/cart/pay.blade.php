@extends('layouts.cart')

@section('content')
<div class="shop-cart-3" ><!--  SHOPPING CART 4st STEP ---------->
<h3>Secure Booking</h3>
<div class="scart3-container">
	<div class="scart3-right">
    	<div class="scart3-right-title">Reservation Details</div>
        <div class="scart3-details">
        	<div class="scart3-number"></div>
                <div class="scart3-description">
                	<ul>
					<!--
                    	<li>Item Type: car</li>
					-->
                        <li>Company Name:  {{$item['company']['name']}}</li>
                        <li>Rate Code: {{$item['selectcar']['rate_code']}}</li>
                        <li>Pickup Date: {{date('F d Y, h:i A',strtotime($data['date-pickup-value']))}}</li>
                        <li>Dropoff Date: {{date('F d Y, h:i A',strtotime($data['date-dropoff-value']))}}</li>
                        <li>Reservation for Days: {{$item['reservation_for_days']}}</li>
                        <li class="scart3-amount">
                        	<div>Amount:</div>
                            <p>${{number_format($item['reservation_total_amount'],2)}}</p>
                        </li>
						@if ($item['coupon_id']>0)
                        <li class="scart3-redeem">
                        	<div>Less redeem amount:</div>
                            <p>${{number_format($item['reservation_total_discont'],2)}}</p>
                        </li>
						@endif
                        <li class="scart3-total">
                        	<div>Total:</div>
                            <p>{{number_format($item['reservation_total_amount']-$item['reservation_total_discont'],2)}}</p>
                        </li>
                    </ul>
                </div>
                <div class="clear"></div>
        </div>
    </div>
    <div class="scart3-left">
   		<div class="scart3-left-title">Billing Information</div>
        <div class="scart4-billing">
        	<ul>
            	<li>
                	<div>First Name</div>
                    <p>{{$item['billing']['billing_first_name']}}</p>
                </li>
                <li>
                	<div>Last Name</div>
                    <p>{{$item['billing']['billing_last_name']}}</p>
                </li>
                <li>
                	<div>Company</div>
                    <p>{{$item['billing']['billing_company']}}</p>
                </li>
                <li>
                	<div>Phone</div>
                    <p>{{$item['billing']['billing_phone']}}</p>
                </li>
                <li>
                	<div>Address</div>
                    <p>{{$item['billing']['billing_address']}}</p>
                </li>
                <li>
                	<div>Suite/ Apt #</div>
                    <p>{{$item['billing']['billing_art']}}</p>
                </li>
                <li>
                	<div>City</div>
                    <p>{{$item['billing']['billing_city']}}</p>
                </li>
                <li>
                	<div>Country</div>
                    <p>{{$item['billing']['billing_country']}}</p>
                </li>
                <li>
                	<div>State</div>
                    <p>{{$item['billing']['billing_state']}}</p>
                </li>
                <li>
                	<div>Zip</div>
                    <p>{{$item['billing']['billing_zip_code']}}</p>
                </li>
                <div class="clear"></div>
            </ul>
        </div>
    </div>
    <div class="clear"></div>
	<form role="form" name="formbilling" id="amc_formbilling" method="POST" action="{{ route('web.rentcar.paymantproccess') }}">
       {{ csrf_field() }}
    <div class="scart4-secure-payment">
    	<div class="scart4-pay-title">Secure Payment</div>
        <div class="scart4-pay">
        	<!-- / credit card -->
        	<div class="scart4-credit scart4-paypal">
            	<div class="scart4-radio">
                	<input type="radio" name="selectpayment" class="sc4-radio" value="paypal" style="display:none" checked="checked" id="credit-radio" required/>
					<label for="credit-radio">Credit Card processed by PayPal (note: Exp. Date must be MM/YY)</label>
                </div>
                <div class="scart4-paypal-form">
                	<a href="javascript:void(0)" class="scart4-visa"></a>
                    <a href="javascript:void(0)" class="scart4-master"></a>
                    <a href="javascript:void(0)" class="scart4-american"></a>
                    <a href="javascript:void(0)" class="scart4-discover"></a>
                    <div class="clear"></div>
                </div>
                <div class="scart4-credit-form">

                    	<div class="scart4-line">
                        	<p>Credit Card Number</p>
                            <div class="scart4-card-left" id="amc_card-number"></div>
                            <div class="clear"></div>
                        </div>
                        <div class="scart4-line">
                        	<p>Card Expiry Date</p>
                            <div class="scart4-card-left" id="amc_expiration-date"></div>
                            <div class="clear"></div>
                        </div>
                        <div class="scart4-line">
                        	<p>CVV2</p>
                            <div class="scart4-card-left" id="amc_cvv"></div>
                            <div class="clear"></div>
                        </div>

                </div>
            </div>
            <script src="https://js.braintreegateway.com/js/braintree-2.32.1.min.js"></script>
            <script>
            braintree.setup("{{$clientToken}}", "custom", {
                id: "amc_formbilling",
                hostedFields: {
                    number: {
                        selector: "#amc_card-number"
                    },
                    cvv: {
                        selector: "#amc_cvv"
                    },
                    expirationDate: {
                        selector: "#amc_expiration-date"
                    }
                }
            });
            </script>            
            <!-- / credit card -->
            <!-- paypal --
            <div class="scart4-paypal">
            	<div class="scart4-radio">
                	<input type="radio" name="selectpayment" class="sc4-radio" id="credit-radio2" />
					<label for="credit-radio2">Pay Pal</label>
                </div>
                <div class="scart4-paypal-form">
                	<a href="" class="scart4-visa"></a>
                    <a href="" class="scart4-master"></a>
                    <a href="" class="scart4-american"></a>
                    <a href="" class="scart4-discover"></a>
                    <div class="clear"></div>
                </div>

            </div>
            <!--  /paypal -->
            <!-- stripe --
            <div class="scart4-stripe">
            	<div class="scart4-radio">
                	<input type="radio" name="selectpayment" class="sc4-radio" value="stripe" id="credit-radio3" required/>
					<label for="credit-radio3">Stripe</label>
                </div>
                <div class="scart4-stripe-form">
                	<div class="scart4-line">
                        	<p>Credit Card Number</p>
                            <div  class="scart4-card-left"><input type="text" name="stripe[number]" value="" /></div>
                            <div class="clear"></div>
                        </div>
                        <div class="scart4-line">
                        	<p>Card Expiry Date</p>
                            <div class="scart4-card-left">
                            	<div class="scart4-month">
                            		<select name="stripe[month]" >
					                    @foreach ($monthes as $key=>$month)
					                    <option value="{{$key}}">{{$month}}</option>
                    					@endforeach
                               		</select>
                                </div>
                                <div class="scart4-year">
                            		<select name="stripe[year]">
					                    @foreach ($years as $key=>$year)
					                    <option value="{{$key}}">{{$year}}</option>
                    					@endforeach
                               		</select>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="scart4-line">
                        	<p>CVV2</p>
                            <div  class="scart4-card-left"><input type="text" name="stripe[cvv2]" value="" /></div>
                            <div class="clear"></div>
                        </div>
                </div>
            </div>
            <!--/ stripe -->
        </div>

    </div>
     	<input type="submit" id="billingformbtn" style="display:none"/>
    </form>
</div>
<div class="scart3-button"><a href="javascript:billingformsubmit();">Pay Now</a></div>

@endsection
