<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style>
	body {margin:0px;}
	table,th,td,b{font-family:verdana;font-size:10px;}

</style>
</head>
<body>
<table border='1' cellspacing="3" cellpadding="3">
	<tr>
		<th class="all">RES #</th>
		<th class="all">Account No.</th>
		<th class="all">Company</th>
		<th class="all">Name</th>
		<th class="all">Phone</th>
		<th class="all">Email</th>
		<th class="all">Pkup-DATE</th>
		<th class="all">Drop-DATE</th>
		<th class="all">Pickup-LOC</th>
		<th class="all">Drop-LOC</th>
		<th class="all">Voucher</th>
		<th class="all">DAYS</th>
		<th class="all">COUPON-CODE</th>
		<th class="all">Value</th>
		<th class="all">DISCOUNT</th>
		<th class="all">TOTAL</th>
		<th class="all">REFERRAL</th>
		<th class="all">STATUS</th>
		<th class="all">Date</th>
	</tr>
	@if (count($reportdata)>0)

	    @foreach ($reportdata as $order)
  		<tr>
			<td class="all">{{$order->reservation_number}}</td>
			<td class="all">{{$order->account->account_number}}</td>
			<td class="all">{{$order->company->name}}</td>
			<td class="all">{{trim($order->reservation_first_name.' '.$order->reservation_last_name)}}</td>
			<td class="all">{{$order->reservation_phone_number}}</td>
			<td class="all">{{$order->reservation_email}}</td>
			<td class="all">{{$order->reservation_pdate.' '.$order->reservation_ptime}}</td>
			<td class="all">{{$order->reservation_ddate.' '.$order->reservation_dtime}}</td>
			<td class="all">{{$order->plocation->name}}</td>
			<td class="all">{{$order->plocation->name}}</td>
			<td class="all">{{$order->voucher_number}}</td>
			<td class="all">{{$order->reservation_for_days}}</td>
			<td class="all">{{($order->coupon?$order->coupon->number:'')}}</td>
			<td class="all">{{$order->reservation_total_amount}}</td>
			<td class="all">{{($order->coupon?$order->coupon->get_discount_amount($order->reservation_total_amount):'')}}</td>
			<td class="all">{{($order->coupon?$order->reservation_total_amount-$order->coupon->get_discount_amount($order->reservation_total_amount):$order->reservation_total_amount)}}</td>
			<td class="all">{{$order->referral_id}}</td>
			<td class="all">{{($order->reservation_cancel?'Canceled':'')}}</td>
			<td class="all">{{$order->reservation_date}}</td>
		</tr>
		@endforeach
		<tr><td colspan='16' align='right'><br /> <b>Total : {{$sum}} USD</b><br /><br /></td></tr>
	@else
		<tr><td colspan='16'><br /><center>No Record Found.<br /><br /></center></td></tr>
	@endif
	</table>	
</body>
</html>