@extends('layouts.admin')
@section('title', 'Sales Report 2')
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

		return true;
	}
);

$(function(){

	minDateFilter = new Date($("#min").val()).getTime();
	maxDateFilter = new Date($("#max").val()).getTime();

	var table = $("#example_reports1").dataTable({
		"bProcessing": true,
        "bServerSide": true,
		"aoColumnDefs": [ { "bSortable": false, "aTargets": [ 6 ] } ],
		"columns": [
            { "data": "account_number" },
            { "data": "voucher_number" },
            { "data": "reservation_number" },
            { "data": "reservation_date" },
            { "data": "reservation_for_days" },
            { "data": "reservation_name" },
            { "data": "total_amount" },
            { "data": "status_name" },
        ],
        "ajax": "/api/report1",	

		"fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
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
		{!!Form::open(array('url' => route('admin.reports.exportreport2'), 'method' => 'get', "enctype" => "multipart/form-data"))!!}
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
						<th class="desktop">Account No.</th>
						<th class="all">Voucher</th>
						<th class="all">Conf.</th>
						<th class="desktop">Invoice Date</th>
						<th class="desktop">Voucher DAYS</th>
						<th class="desktop">Renter</th>
						<th class="all">Amount</th>
                    	<th class="all">Status</th>
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
