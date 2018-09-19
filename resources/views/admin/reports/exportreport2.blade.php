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
		<th>CONFIRMATION</th>
		<th>TYPE</th>
		<th>LASTNAME</th>
		<th>FIRSTNAME</th>
		<th>VOUCHER</th>
		<th>AMOUNT</th>
		<th>BOOKED ON</th>
		<th>STATUS</th>
		<th>Voided On</th>
	</tr>
	@if (count($reportdata)>0)

	    @foreach ($reportdata as $item)
  		<tr>
	        <td>{{$item->reservation_number}}</td>
		    <td>Car</td>
			<td>{{$item->reservation_first_name}}</td>
			<td>{{$item->reservation_last_name}}</td>
			<td>{{$item->voucher_number}}</td>
			<td>{{$item->reservation_total_amount}}</td>
			<td>{{$item->reservation_date}}</td>
			<td>{{($order->reservation_cancel?'Canceled':'')}}</td>
			<td>{{($item->reservation_cancel==1?$item->reservation_cancel_date:'')}}</td>
		</tr>
		@endforeach
		<tr><td colspan='6' align='right'><br /> <b>Total : {{$sum}} USD</b><br /><br /></td></tr>
	@else
		<tr><td colspan='6'><br /><center>No Record Found.<br /><br /></center></td></tr>
	@endif
	</table>	
</body>
</html>