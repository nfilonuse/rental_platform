@extends('layouts.cart')

@section('content')
	<form role="form" name="formbilling" method="POST" action="{{ route('web.rentcar.addbilling') }}">
       {{ csrf_field() }}
<div class="shop-cart-3" ><!--  SHOPPING CART 3st STEP ---------->
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
   		<div class="scart3-left-title">Reservation Information</div>
        <div class="scart3-billing">
        	<div class="scart3-input"><input type="text" name="account_first_name" placeholder="First Name" value="{{($checkoutinfo?$checkoutinfo->account_first_name:'')}}" required/></div>
            <div class="scart3-input"><input type="text" name="account_last_name" placeholder="Last Name" value="{{($checkoutinfo?$checkoutinfo->account_last_name:'')}}" required/></div>
            <div class="scart3-input not-required"><input type="text" name="account_company" placeholder="Company" value="{{($checkoutinfo?$checkoutinfo->account_company:'')}}" /></div>
            <div class="scart3-input"><input type="tel" pattern="[0-9]{10}" name="account_phone" placeholder="Phone (Format: 0000000000)" value="{{($checkoutinfo?$checkoutinfo->account_phone:'')}}" required/></div>
            <div class="scart3-input"><input type="text" name="account_address" placeholder="Address" value="{{($checkoutinfo?$checkoutinfo->account_address:'')}}" required/></div>
            <div class="scart3-input"><input type="email" name="account_email" placeholder="Email Address" value="{{($checkoutinfo?$checkoutinfo->account_email:'')}}" required/></div>
            <div class="scart3-input not-required"><input type="text" name="account_art" placeholder="Suite/ Apt #" value="{{($checkoutinfo?$checkoutinfo->account_art:'')}}" /></div>
            <div class="scart3-input"><input type="text" name="account_city" placeholder="City" value="{{($checkoutinfo?$checkoutinfo->account_city:'')}}" required/></div>
            <div class="scart3-input billing-country">
				{{Form::select('account_country_id', $countries,($checkoutinfo?$checkoutinfo->account_country_id:''),array('id' => 'account_country_id','onchange' => 'changestateaccount(this.value)','required' => 'required'))}}
            </div>
            <!--
            <div class="scart3-input"><input type="text" name="account_state_id" placeholder="State" required/></div>
            -->
            <div class="scart3-input billing-state not-required">
				{{Form::select('account_state_id', $states,($checkoutinfo?$checkoutinfo->account_state_id:''),array('id' => 'account_state_id'))}}
            </div>
            <div class="scart3-input not-required"><input type="text" name="account_zip_code" placeholder="Zip" value="{{($checkoutinfo?$checkoutinfo->account_zip_code:'')}}"/></div>
            <div class="scart3-line"><p>are mandatory fields</p></div>
			<div class="scart3-check">
           		<input type="checkbox" class="scart3-checkbox" name="useaccountinfo" checked="checked" id="useaccountinfo" />
				<label for="useaccountinfo">Use My reservation information for billing</label>
			</div>
        </div>
   		<div class="scart3-left-title billing-action amc-billing-close">Billing Information</div>
        <div class="scart3-billing billing-cont" style="display:none">
        	<div class="scart3-input"><input type="text" name="billing_first_name" placeholder="First Name" class="billing_input_req" value="{{($checkoutinfo?$checkoutinfo->billing_first_name:'')}}" /></div>
            <div class="scart3-input"><input type="text" name="billing_last_name" placeholder="Last Name" class="billing_input_req" value="{{($checkoutinfo?$checkoutinfo->billing_last_name:'')}}" /></div>
            <div class="scart3-input not-required"><input type="text" name="billing_company" placeholder="Company" value="{{($checkoutinfo?$checkoutinfo->billing_company:'')}}" /></div>
            <div class="scart3-input"><input type="tel" class="billing_input_req" pattern="[0-9]{10}" name="billing_phone" placeholder="Phone (Format: 0000000000)" value="{{($checkoutinfo?$checkoutinfo->billing_phone:'')}}" /></div>
            <div class="scart3-input"><input type="text" class="billing_input_req" name="billing_address" placeholder="Address" value="{{($checkoutinfo?$checkoutinfo->billing_address:'')}}" /></div>
            <div class="scart3-input"><input type="email" class="billing_input_req" name="billing_email" placeholder="Email Address" value="{{($checkoutinfo?$checkoutinfo->billing_email:'')}}" /></div>
            <div class="scart3-input not-required"><input type="text" name="billing_art" placeholder="Suite/ Apt #" value="{{($checkoutinfo?$checkoutinfo->billing_art:'')}}" /></div>
            <div class="scart3-input"><input type="text" class="billing_input_req" name="billing_city" placeholder="City" value="{{($checkoutinfo?$checkoutinfo->billing_city:'')}}" /></div>
            <div class="scart3-input billing-country">
				{{Form::select('billing_country_id', $countries,($checkoutinfo?$checkoutinfo->billing_country_id:''),array('id' => 'billing_country_id','class' => 'billing_input_req','onchange' => 'changestate(this.value)'))}}
            </div>
            <!--
            <div class="scart3-input"><input type="text" name="billing_state_id" placeholder="State" required/></div>
            -->
            <div class="scart3-input billing-state not-required">
				{{Form::select('billing_state_id', $states,($checkoutinfo?$checkoutinfo->billing_state_id:''),array('id' => 'billing_state_id'))}}
            </div>
            <div class="scart3-input not-required"><input type="text" name="billing_zip_code" placeholder="Zip" value="{{($checkoutinfo?$checkoutinfo->billing_zip_code:'')}}"/></div>
            <div class="scart3-line"><p>are mandatory fields</p></div>
            <div class="scart3-check">
            	<input type="checkbox" class="scart3-checkbox" {{($checkoutinfo&&$checkoutinfo->send_notified==1?'checked="checked"':'')}} name="send_notified" id="scart3-checkbox1"/>
				<label for="scart3-checkbox1">Yes, I would like to be notified of product updates</label>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>
<div class="scart3-button"><a href="javascript:billingformsubmit();">Reserve Now</a></div>
      	<input type="submit" id="billingformbtn" style="display:none"/>
	</form>

<!-- / 3 CATALOG -->

@endsection
