	@if ($data['car_error'])
	<div class="search-error">
		<h2>No cars found.<h2>
		<p>Please change your search options and try again</p>
	</div>
	@else
		@foreach ($cars as $key=>$car)
		<!--  item ------------->
		<form role="form" id="formsendtocart{{$key}}" name="formsendtocart{{$key}}" method="POST" action="{{ route('web.rentcar.step4') }}">
			<input type="hidden" name="_token" value="{{$data['_token']}}">
			<input type="hidden" name="infodata" value="{{json_encode($data)}}"/>
			<input type="hidden" name="infocar" value="{{json_encode($car)}}"/>
		<a href="javascript:document.formsendtocart{{$key}}.submit();" class="catalog-item">
			<div class="ac_package_block">
				<div class="company company{{$car['company']['id']}}"></div>
                @foreach ($car['packages'] as $item)
					<div class="package item{{($item['is_additional_details']==1?'13':$item['id'])}}  amc_qtip_res" title="{{$item['name']}}" alt="{{$item['description']}}" ></div>
                @endforeach


			</div>
	    	<div class="ci-daily-price">${{$car['daily-price']}}<p>daily</p></div>
		    <div class="item-info">
				<div class="item-row">
					<div class="item-name"><p>Class: {{$car['carclass']}} <span style="float:right;padding-right: 20px;">Total ${{$car['total-price']}}</span></p><div class="clear"></div>{{$car['car_make']}}</div>
					<div class="item-seats">{{$car['seats']}}</div>
					<div class="item-luggage">{{$car['baggage']}}</div>
					<div class="item-doors">{{$car['dors']}}</div>
				</div>
			</div>
			<img src="{{$car['image']}}"  alt="" />
		</a>
		</form>
		<!--  /  item ------------->
		@endforeach
	@endif

 <div class="clear"></div>
