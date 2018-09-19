@extends('layouts.cart')

@section('content')
<div class="filter-layer-bg" style="display:none"></div>
<!-- /layer -->
<!-- filter layer -->
<div class="filter-layer" style="display:none">
	<div class="fl-header">
    	<div class="fl-name">Filters</div>
        <a class="fl-close" href="javascript:closefilters(false)"></a>
    </div>
    <div class="fl-options" >
    	<h3>options</h3>
        <div>
		@foreach ($data['lpackages'] as $key=>$package) 
			@if (!$package['package_order']==0)
		    <div  class="fl-cb fl-bg popitem{{$package['id']}} amc_qtip package_div" title="{{$package['name']}}" alt="{{$package['description']}}"  rel="{{$package['id']}}">
				<input type="checkbox" {{(in_array($package['id'],$data['packages'])?'checked="checked"':'')}} class="fl-radio packages" value="{{$package['id']}}" id="fl-radio{{$package['id']}}"/>
				<label for="fl-radio{{$package['id']}}" class="label_package" rel="{{$package['id']}}">{{$package['smallname']}}</label>
		    </div>
			@else
		       	<input type="radio" checked="checked" style="display:none" class="fl-radio packages" id="fl-radio{{$package['id']}}" value="{{$package['id']}}"/>
			@endif
		@endforeach
        <div class="clear"></div>
        </div>
    </div>
    <div class="fl-separator"></div>
    <div class="fl-rental">
    	<h3>Rental Companies</h3>
		@foreach ($data['lcompanies'] as $key=>$company)
			@if ($data['driverlicence']>1||($data['driverlicence']==1&&$company['id']==3))
		    <div class="fl-re">
				<input type="checkbox" class="fl-checkbox companies" checked="checked" value="{{$company['id']}}" id="fl-rental{{$company['id']}}" />
				<label for="fl-rental{{$company['id']}}">{{$company['name']}}</label>
	        </div>
			@endif
		@endforeach
        <div class="clear"></div>
    </div>
    
    <div class="fl-footer">
<!--
    	<div class="fl-results">40 Results Found </div>
-->
        <a href="javascript:closefilters(true)" class="fl-ok">OK</a>
<!--
        <a href="" class="fl-clear">Clear Filters</a>
-->
        
    </div>
	<input type="hidden" id="location-pickup-value" value="{{$data['location-pickup-value']}}"/>
	<input type="hidden" id="date-pickup-value" value="{{$data['date-pickup-value']}}"/>
	<input type="hidden" id="location-dropoff-value" value="{{$data['location-dropoff-value']}}"/>
	<input type="hidden" id="date-dropoff-value" value="{{$data['date-dropoff-value']}}"/>
	<input type="hidden" id="driverlicence" value="{{$data['driverlicence']}}"/>
	
</div>
<!-- filter layer -->

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
            <p class="loc-picup-time">{{$data['date-pickup-value-show']}}</p>
        </div>
        <div class="clear"></div>
    </div>
    <div class="loc-picup loc-dropoff">
    	<div class="loc-picup-left"></div>
        <div class="loc-picup-right">
        	<p class="loc-picup-city">{{$data['location-dropoff']}}</p>
            <p class="loc-picup-time">{{$data['date-dropoff-value-show']}}</p>
        </div>
        <div class="clear"></div>
    </div>
    <div class="change-search"><a href="{{ route('web.rentcar.index') }}"><div>Change<br />search</div></a></div>
    <div class="left-buttons">
    	<a class="filters" href="javascript:openfilters()"><div>Filters</div></a>
    </div>
	<div class="amc-res-text-info"><p>Too many results? Too few? Click <span>"Filters"</span> to refine you results</p></div> 

</div> <div class="clear"></div>

<div class="catalog-block" ><!--  CATALOG BLOCK ---------->
</div><!--  CATALOG BLOCK ---------->

<!-- / 3 CATALOG -->
@endsection
