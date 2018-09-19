@extends('layouts.app')

@section('content')
<div class="amc_info">The Cheapest Way to Rent A Car and GoGo!</div>
<form role="form" id="form-step1" method="POST" action="{{ route('web.rentcar.cookadd') }}">
        {{ csrf_field() }}
<!-- CENTRAL BLOCK -->
<div class="central-block" >

<div id="collector" data-pickup="{{(isset($data['backdata'])?$data['backdata']['date-pickup-value']:'')}}" data-dropoff="{{(isset($data['backdata'])?$data['backdata']['date-dropoff-value']:'')}}"></div>

	<div class="central-left">
    	<div class="left-container"><!-- left container -->

            <div class="pickup-marker">Pickup<p>options</p></div>
        	<div class="lc-input">
        		<input type="text" id="location-pickup" name="location-pickup" placeholder="Enter Pickup Location" value="{{(isset($data['backdata'])?$data['backdata']['location-pickup']:'')}}"  required/>
				<input type="hidden" id="location-pickup-value" name="location-pickup-value" value="{{(isset($data['backdata'])?$data['backdata']['location-pickup-value']:'')}}"/>
				<input type="hidden" id="date-pickup-value" name="date-pickup-value" value="{{(isset($data['backdata'])?$data['backdata']['date-pickup-value']:'')}}"/>
        	</div>

            <div class="data-input" id="date-pickup"><!-- data input -->
            	<div class="di-month">

                <select id="date-pickup-month">

                        <option value ="1">January</option>
                        <option value ="2">February</option>
                        <option value ="3">March</option>
                        <option value ="4">April</option>
                        <option value ="5">May</option>
                        <option value ="6">June</option>
                        <option value ="7">July</option>
                        <option value ="8">August</option>
                        <option value ="9">September</option>
                        <option value ="10">October</option>
                        <option value ="11">November</option>
                        <option value ="12">December</option>

                </select>

                </div>
               <div class="di-day">
                <select id="date-pickup-day"></select>


                </div>
                <div class="di-time">
                	<select id="date-pickup-time">
						@foreach ($times as $key=>$time)
							@if ($time=='12:00 pm')
		                		<option selected="selected" value="{{$key}}">{{$time}}</option>
							@else
	                    		<option value="{{$key}}">{{$time}}</option>
							@endif
						@endforeach
                    </select>
                </div>
                <div class="clear"></div>
            </div><!-- /data input -->


    <div id="gogocalendar-pickup"></div>

        </div><!--/left container -->
    </div>
    <div class="central-right">

    <div class="right-container"><!-- right container -->

            <div class="pickup-marker">Dropoff<p>options</p></div>

        	<div class="lc-input">
        		<input type="text" id="location-dropoff" name="location-dropoff" placeholder="Enter Dropoff Location" value="{{(isset($data['backdata'])?$data['backdata']['location-dropoff']:'')}}" required/>
				<input type="hidden" id="location-dropoff-value" name="location-dropoff-value" value="{{(isset($data['backdata'])?$data['backdata']['location-dropoff-value']:'')}}"/>
				<input type="hidden" id="date-dropoff-value" name="date-dropoff-value" value="{{(isset($data['backdata'])?$data['backdata']['date-dropoff-value']:'')}}"/>
        	</div>
            <div class="data-input"><!-- data input -->
            	<div class="di-month">
                <select id="date-dropoff-month">

                        <option value ="1">January</option>
                        <option value ="2">February</option>
                        <option value ="3">March</option>
                        <option value ="4">April</option>
                        <option value ="5">May</option>
                        <option value ="6">June</option>
                        <option value ="7">July</option>
                        <option value ="8">August</option>
                        <option value ="9">September</option>
                        <option value ="10">October</option>
                        <option value ="11">November</option>
                        <option value ="12">December</option>

                </select>
                </div>
               <div class="di-day">
                    <select id="date-dropoff-day"></select>
                </div>
                <div class="di-time">
                	<select id="date-dropoff-time">
						@foreach ($times as $key=>$time)
							@if ($time=='12:00 pm')
		                		<option selected="selected" value="{{$key}}">{{$time}}</option>
							@else
	                    		<option value="{{$key}}">{{$time}}</option>
							@endif
						@endforeach
                    </select>
                </div>
                <div class="clear"></div>
            </div><!-- /data input -->

    <div id="gogocalendar-dropoff"></div>





        </div><!--/right container -->

    </div>


</div>
<div class="clear"></div>
<!-- /CENTRAL BLOCK -->

<!-- ADDITIONAL BLOCK -->
<div class="additional-block"  >
	<div class="add-container">
		<div class="additional-center">
        	<div class="ac_country">
            	<select id="driverlicence" name="driverlicence" required>
                    @foreach ($driverlicence as $item)
                    <option value="{{$item['id']}}" {{(isset($data['backdata'])?($data['backdata']['driverlicence']==$item['id']?'selected="selected"':''):'')}}>{{$item['name']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="ac_packages">
				<div class="ac_add_info">INCLUDE OPTIONS ></div>
                @foreach ($packages as $item)
					@if ($item['package_order']==0) 
						<div rel="{{$item['id']}}" class="package item{{$item['id']}} amc_qtip" title="{{$item['name']}}" alt="{{$item['description']}}" style="display:none"><input type="checkbox" checked="checked" id="package{{$item['id']}}" name="packages[]" value="{{$item['id']}}" rel="{{$item['id']}}"><label for="package{{$item['id']}}">{{$item['smallname']}}</label></div>
					@else
						<div rel="{{$item['id']}}" class="package item{{$item['id']}} amc_qtip" title="{{$item['name']}}" alt="{{$item['description']}}" {{($item['package_order']==0?'style="display:none"':'')}}><input type="checkbox" {{(isset($data['backdata'])?(in_array($item['id'],$data['backdata']['packages'])?'checked="checked"':''):($item['defaultcheck']==1?'checked="checked"':''))}} id="package{{$item['id']}}" name="packages[]" value="{{$item['id']}}" rel="{{$item['id']}}"><label for="package{{$item['id']}}">{{$item['smallname']}}</label></div>
					@endif
                @endforeach
            </div>
            <div class="ac_search"><input type="submit" value="SEARCH" /></div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<script>
/*
var amc_pid;
var amc_is_select;
$(document).ready(function () {
    $(".package").bind("click", function(e) {
        amc_pid = $(this).attr("rel");
        amc_is_select = $("#package"+amc_pid+":checked").length>0;
        console.log(amc_pid,amc_is_select)
    }).bind("change", function(e) {
        if (amc_is_select==false)
        {
            if (amc_pid==7||amc_pid==6)
            {
                if (($("#package6").prop( "checked")||$("#package7").prop( "checked")))
                    $( "#package4" ).prop( "checked", true );
                else
                    $( "#package4" ).prop( "checked", false );
            }
            if (amc_pid==4)
            {
                if (($("#package6").prop( "checked")||$("#package7").prop( "checked")))
                    $( "#package4" ).prop( "checked", true );
                else
                    $( "#package4" ).prop( "checked", false );
            }

        }
        else
        {
            if (amc_pid==7||amc_pid==6)
            {
                $( "#package4" ).prop( "checked", true );
            }
        }
    });
});
*/
</script>
<!-- /ADDITIONAL BLOCK -->
</form>

@endsection
