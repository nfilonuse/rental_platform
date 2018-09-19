@extends('layouts.cart')

@section('content')

	<input type="hidden" name="location-pickup-value" value="{{$data['location-pickup-value']}}"/>
	<input type="hidden" name="date-pickup-value" value="{{$data['date-pickup-value']}}"/>
	<input type="hidden" name="location-dropoff-value" value="{{$data['location-dropoff-value']}}"/>
	<input type="hidden" name="date-dropoff-value" value="{{$data['date-dropoff-value']}}"/>

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

<div class="shop-cart-1" ><!--  SHOPPING CART 1st STEP <span>or similar</span> ---------->

	<div class="scart1-left">
    	<div class="scart1-car">
			<div class="ac_package_block">
				<div class="company company{{$data['selectcar']['company']->id}}"></div>
                @foreach ($data['selectcar']['packages'] as $item)
					<div class="package item{{($item->is_additional_details==1?'13':$item->id)}}  amc_qtip_res" title="{{$item->name}}" alt="{{$item->description}}" ></div>
                @endforeach
			</div>
        	<div class="scart1-title"><!--{{$data['selectcar']['code']}}--> {{$data['selectcar']['car_make']}}</div>
            <div class="scart1-options">
            	<div class="scart1-pass">{{$data['selectcar']['seats']}} <span>Passengers</span></div>
                <div class="scart1-doors">{{$data['selectcar']['dors']}} <span>Doors</span></div>
                <div class="scart1-bags">{{$data['selectcar']['baggage']}} <span>Bags</span></div>
<!--
                <div class="scart1-gear">A<span>utomatic</span></div>
-->
                <div class="clear"></div>
            </div>
            <img src="{{$data['selectcar']['image']}}" alt="" />
        </div>
        <div class="scart1-booking">
        	<h3>Booking Information</h3>
            <div class="scart1-table">
            	<div class="scart1-table-left">
                	<div class="grey-line">
                    	<p>Daily Rate:</p>
                        <span>${{$data['selectcar']['daily-price']}}</span>
                    </div>
                    <div>
                    <p>Weekly Rate:</p>
                        <span>${{$data['selectcar']['weekly-price']}}</span>
                    </div>
                    <div  class="grey-line">
                    	<p class="scart1-bold">Total Amount:</p>
                        <span class="scart1-bold">${{$data['selectcar']['total-price']}}</span>
                    </div>
                </div>
                <div class="scart1-table-right">
                	<div  class="grey-line scart-mob-line-white">
                    	<p class="scart1-bold">Class</p>
                        <span>{{$data['selectcar']['carclass']}}</span>
                    </div>
                    <div class="scart-mob-line-grey">
                    	<p class="scart1-bold"></p>
                        <span></span>
                    </div>
                    <div  class="grey-line scart-mob-line-white">
                    	<p>Rate Code:</p>
                        <span>{{$data['selectcar']['rate_code']}}</span>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="scart1-right">
	<form method="POST" action="{{ route('web.rentcar.sendtocart') }}">
        {{ csrf_field() }}
			<input type="hidden" name="infodata" value="{{json_encode($data)}}"/>

    	<div class="scart1-title">Rental Rate Details</div>
        	<div class="scart-input-block">
                   <div class="scart1-input">Rate Code: {{$data['selectcar']['rate_code']}}<!--{{$data['selectcar']['rate']->name}}--></div>
<!--                   
                   <div class="scart1-input">Includes: </div>
-->                   
                @foreach ($data['selectcar']['packages'] as $item)
					<div class="scart1-input packages-info packages-info{{$item->id}}" title="{{$item->name}}">{{$item->name}}: {{$item->description}}</div>
                @endforeach
            </div>
        <div class="scart1-buttons">
        	<div class="scart1-cancel"><input type="button" onClick="javascript:window.history.back();" value="cancel" /></div>
            <div class="scart1-reserve"><input type="submit" value="reserve this car" /></div>
        </div>
</form>        
    </div>
	<div class="clear"></div>

    
    
    
   
</div><!-- / SHOPPING CART 1st STEP ---------->

<!-- / 3 CATALOG -->
@endsection
