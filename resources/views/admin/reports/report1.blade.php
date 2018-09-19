@extends('layouts.admin')
@section('title', 'Sales Report 1')
@section('content')
        <!-- table block -->
<script>
// Date range filter
var minDateFilter = "";
var maxDateFilter = "";

$.fn.dataTableExt.afnFiltering.push(
	function(oSettings, aData, iDataIndex) {
		if (typeof aData._date == 'undefined') {
			aData._date = new Date(aData[0]).getTime();
		}

		if (minDateFilter && !isNaN(minDateFilter)) {
			if (aData._date < minDateFilter) {
				return false;
			}
		}

		if (maxDateFilter && !isNaN(maxDateFilter)) {
			if (aData._date > maxDateFilter) {
				return false;
			}
		}
	}
);

$(function(){

	minDateFilter = new Date($("#min").val()).getTime();
	maxDateFilter = new Date($("#max").val()).getTime();

	var table = $("#example_reports1").dataTable({

		"bProcessing": true,
        "bServerSide": true,
		"aoColumnDefs": [ { "bSortable": false, "aTargets": [ 11, 13, 14, 15 ] } ],
		"columns": [
            { "data": "reservation_number" },
            { "data": "account_number" },
            { "data": "company_name" },
            { "data": "reservation_name" },
            { "data": "reservation_phone_number" },
            { "data": "reservation_email" },
            { "data": "reservation_pdatetime" },
            { "data": "reservation_ddatetime" },
            { "data": "reservation_plocation" },
            { "data": "reservation_dlocation" },
            { "data": "voucher_number" },
            { "data": "reservation_for_days" },
            { "data": "coupon_number" },
            { "data": "reservation_total_amount" },
            { "data": "discont_amount" },
            { "data": "total_amount" },
            { "data": "referral_id" },
            { "data": "status_name" },
            { "data": "reservation_date" }
        ],
        "ajax": "/api/report1",

		"fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
			//aoData.push( { 'name' : 'mindate', 'value' : minDateFilter/ 1000 } );
			//aoData.push( { 'name' : 'maxdate', 'value' : maxDateFilter/ 1000 } );
			aoData.push( { 'name' : 'mindate', 'value' : $("#min").val() } );
			aoData.push( { 'name' : 'maxdate', 'value' : $("#max").val() } );
			var tmp = {};
			var rbracket = /(.*?)\[\]$/;
	
			$.each( aoData, function (key, val) {
				var match = val.name.match(rbracket);
	
				if ( match ) {
					// Support for arrays
					var name = match[0];
	
					if ( ! tmp[ name ] ) {
						tmp[ name ] = [];
					}
					tmp[ name ].push( val.value );
				}
				else {
					tmp[val.name] = val.value;
				}
			} );
			aoData = tmp;
			oSettings.jqXHR = $.ajax( {
				"dataType": 'json',
				"type": "GET",
				"url": "/api/report1",
				"data": aoData,
				"success": fnCallback
			} );

	    }
	});
    $("#min").datepicker({ 
		onSelect: function (date) { 
			minDateFilter = new Date(date).getTime();
	        table.fnDraw();
		}, 
		changeMonth: true, 
		changeYear: true 
	});
    $("#max").datepicker({ 
		onSelect: function (date) { 
			maxDateFilter = new Date(date).getTime();
	        table.fnDraw();
			console.log(maxDateFilter);
		}, 
		changeMonth: true, 
		changeYear: true 
	});
})
</script>
		{!!Form::open(array('url' => route('admin.reports.exportreport1'), 'method' => 'get', "enctype" => "multipart/form-data"))!!}
        <div class="ap-table report">
			<div class="additional-filter">
				<div class="amc-field-cont">
					{{Form::text('min', date('m/d/Y',strtotime('-7 days')), array('placeholder' => 'Date min','class' => 'form-control date_range_filter date', 'id' => 'min'))}}
			    </div>
				<div class="amc-field-cont">
					{{Form::text('max', date('m/d/Y'), array('placeholder' => 'Date max','class' => 'form-control date_range_filter date', 'id' => 'max'))}}
			    </div>
			</div>
        	<table id="example_reports1"  class="display responsive" cellpadding="0" cellspacing="0">
            	<thead>
                	<tr>
						<th class="all">RES #</th>
						<th class="min-tablet-l">Account No.</th>
						<th class="all">Company</th>
						<th class="min-tablet-p">Name</th>
						<th class="min-tablet-p">Phone</th>
						<th class="min-tablet-p">Email</th>
						<th class="desktop">Pkup-DATE</th>
						<th class="desktop">Drop-DATE</th>
						<th class="desktop">Pickup-LOC</th>
						<th class="desktop">Drop-LOC</th>
						<th class="all">Voucher</th>
						<th class="desktop">DAYS</th>
						<th class="desktop">COUPON-CODE</th>
						<th class="desktop">Value</th>
						<th class="desktop">DISCOUNT</th>
						<th class="all">TOTAL</th>
						<th class="all">REFERRAL</th>
                    	<th class="all">STATUS</th>
						<th class="desktop">Date</th>
                    </tr>
                </thead>
            </table>



			<div class="row amc-exporttoexcel">
				<div class="col-xs-12 col-md-12 text-center">
				<input type="submit" class="btn btn-danger" value="Export to excel">
					 <div class="clear"></div>
				</div>
			</div>
        </div>
		{{ Form::close() }}

@endsection
