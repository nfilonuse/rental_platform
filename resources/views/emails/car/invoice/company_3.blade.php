@extends('layouts.email')



@section('content')

<table width="694"  border="2" cellpadding="0" cellspacing="0" bordercolor="#999999"  align='center' style="border: 2px solid #999999;">

<tr>

	<td align="center" style='background:#f0f0f0;'>

		<h1><i>Hertz Prepaid Voucher / Cup&#0243;n Prepagado Hertz</i></h1>

	</td>

</tr>

 <TR>

	<td align="center" style='background:#ffffff;'>

		<h2>THIS VOUCHER <U>MUST</U> BE PRESENTED AT TIME OF RENTAL</h2>

		<H3>ESTE CUPON PREPAGADO <U>DEBERA</U> SER PRESENTADO AL MOMENTO DEL ALQUILER</H3>

	</td>

</tr>

</table>

<table width="694"  border="2" cellpadding="0" cellspacing="0" bordercolor="#999999"  align='center' style="border: 2px solid #999999;">

<tr VALIGN=TOP>

<TD WIDTH=50%>

<TABLE height=100% WIDTH=100% align='center' border="1" cellpadding="3" cellspacing="0" style="border: 2px solid #999999;" style='background:#f0f0f0;'>

<tr>

<td colspan=2>

<font size="1" face="Arial, Helvetica, sans-serif"><b>Voucher Number</b>

<br>

N&#0250;mero del Cup&#0243;n</font>

<br>

<big>100055{{$order->voucher_number}}</big>

</td>

</tr>

<tr>

<td colspan=2>

<font size="1" face="Arial, Helvetica, sans-serif"><b>Name of Client</b>

<br>

Nombre del Cliento</font>

<br>

<big>{{$order->reservation_first_name}} {{$order->reservation_last_name}}</big>

</td>

</tr>

<tr>

<td colspan=2>

<font size="1" face="Arial, Helvetica, sans-serif"><b>Rental Location </b> Lugar del Alquiler</font>

<br>

<big>{{$order->plocation->name}}</big>

</td>

</tr>

<tr>

<td colspan=2>

<font size="1" face="Arial, Helvetica, sans-serif"><b>Return Location  </b> Lugar del Devoluci&#0243;n</font>

<br>

<big>{{$order->dlocation->name}}</big>

</td>

</tr>

<tr>

<td >

<font size="1" face="Arial, Helvetica, sans-serif"><b>Rental Date </b><br>Fecha de Alquiler</font>

<br>

<big>{{$order->reservation_pdate. " ".$order->reservation_ptime}}</big>

</td>

<td >

<font size="1" face="Arial, Helvetica, sans-serif"><b>Rental Length (in Days)</b><br> Duraci&#0243;n del Alquiler (No. de dias)</font>

<br>

<big>{{$order->reservation_for_days}}</big>

</td>

</tr>

<tr>

<td colspan=2>

<font size="1" face="Arial, Helvetica, sans-serif"><b>Remarks  </b><BR> Comentarios</font>

<br>

<small>{{$params['voucher_description']}}</small>

</td>

</tr>



</table>





</TD>

<TD WIDTH=50%>

<TABLE height=100% WIDTH=100% align='center' border="1" cellpadding="3" cellspacing="0" style="border: 2px solid #999999;" style='background:#f0f0f0;'>

<tr>

<td >

<font size="1" face="Arial, Helvetica, sans-serif"><b>Voucher Value </b><br>Valor del Cup&#0243;n</font>

<br>

<big>$ {{$order->reservation_total_amount.' '.$order->reservation_currency_code}}</big>

</td>

<td >

<font size="1" face="Arial, Helvetica, sans-serif"><b>Reservation Number</b><br>No. de Recervaci&#0243;n de Hertz</font>

<br>

<big>{{$order->reservation_number}}</big>

</td>

</tr>

<tr>

<td colspan=2>

<font size="1" face="Arial, Helvetica, sans-serif"><b>Voucher Value in Words</b><BR>Valor del Cup&#0243;n Escrito en Palabr&#0225;s</font>

<br>

<big>{{$params['reservation_total_amount_word']}}</big>

</td>

</tr>

<tr>

<td >

<font size="1" face="Arial, Helvetica, sans-serif"><b>Date Issued</b><br>Fecha de Emisi&#0243;n</font>

<br>

<big>{{$order->reservation_date}}</big>

</td>

<td >

<font size="1" face="Arial, Helvetica, sans-serif"><b>Car Class</b><br>Clase de Auto</font>

<br>

<big>{{$order->car_class_code}}</big>

</td>

</tr>

<tr>

<td colspan=2>

<font size="1" face="Arial, Helvetica, sans-serif"><b>Agency / Company Ref.</b><BR>Agencia / Compa&#0241;ia Ref.</font>

<br>

<big>TREASURES CARIBE INTERNATIONAL</big>

</td>

</tr>

<tr>

<td colspan=2>

<font size="1" face="Arial, Helvetica, sans-serif"><b>Billing Information</b><BR>Arreglos Hechos por</font>

<br>

<big>ITHI00295540 (MANDATORY)<BR>

Treasures Caribe International<br>

2682 8708 9992

</big>

</td>

</tr>

</table>



</TD>

</TR>

</TABLE>

<table width="694"  align='center' cellpadding=3 style="border: 2px solid #999999;">

<tr>

<td colspan=2 align=center>

<h3>VOUCHER GUIDELINES FOR HERTZ COUNTER SERVICE REPRESENTATIVES (CSR)</h3>

</td>

</tr>

<tr VALIGN=TOP>

<td width=70%>

<h3>U.S. RENTALS</h3>

<b>Go to tab 5 - Voucher</b><br>

<ol>

<li>TOUR ARRIVAL LOCATION - Enter the renting location (Ex. FLMIA15)</li>

<li>IT NUMBER - Enter ITHI nurnber found un voucher under 'Billing Information' (Ex. ITHIXXXXXXXX)</li>

<li>Press Enter or F6 (Add Voucher)</li>

</ol>

<b>In the following screen:</b>

<ol>

<li>IT NUMBER 1 - Enter ITHI number again (Ex. ITHIXXXXXXXX)</li>

<li>VOUCHER NUMBER 1 - Enter voucher nurnber found on voucher under 'Voucher Number'</li>

<li>VALUE / $ - Enter voucher amount found on voucher under 'Voucher Value'</li>

<li>Press Enter or F8 (Update)</li>

</ol>

</td>

<td width=30%>

<h3>EUROPE RENTALS<br>

IMPORTANT!<br>

PLEASE REFER TO<br>

F.B.2010-R-000-AB</h3>

This is an e-voucher and is acceptable at the rental

counter. On (ALT + 3) screen, select partial value on value

type. This must be handled as a Stated Value Rent a Car

voucher. Standard RCV Procedures apply.

</td>

</tr>

<tr>

<td colspan=2>

<hr noshade>

<h3 align=center>Terms and Conditions</h3>



1. This Hertz Tour Voucher ("E-Voucher") indicates that the person named herein ("Renter") has paid for Hertz Rent-A-Car Services ("Hertz Service")

to the extent of the value indicated hereon and the payment has been accepted by the issuer of the e-voucher ("Agent") as the representative for Renter.

Neither Hertz nor the Agent makes any other representations or warranties with	respect	to the e-voucher of the Hertz Service to be furnished. 2. Hertz

Service shall be provided by Hertz only under a Hertz Standard Rental Agreement executed by the renter at the location indicated herein at the time this

E-Voucher is presented. The car must be picked up at such location. The rental to the Renter is a subject to Renter meeting Hertz standard credit voucher

and driver qualifications in affect at the time and location of the rental. 3. This E-Voucher is not a guarantee of performance or a confirmation of reservation.

Hertz shall make every effort to provide the Hertz Service to the Renter at the location indicated herein. 4. Hertz is not liable for any loss or damage

by reason of the act or omission of the Agent. Hertz is not responsible for any loss, theft or destruction of personal property either owned by the Renter or

by any person with the Renter. 5. Neither Hertz nor the Agent shall be liable to Renter if the E-Voucher is lost, stolen or destroyed, or should the

E-Voucher he honored upon presentation by a party other than the Renter. 6. In issuing this E-Voucher, Agent acts only as the agent for the Renter and is

not liable for any loss, damage or delay, however caused. 7. This E-Voucher is personal to the Renter and is not transferable or negotiable. 8. This

E-Voucher shall be honored only for the value shown. Any excess, charges over the E-Voucher value must be paid directly to Hertz upon termination of

the rental. 9. Hertz retains the right to cancel this E-Voucher and refund the value hereof in accordance with Paragraph 8 above, should Hertz feel, in its

discretion, that it is unable or does not deem it appropriate to furnish the Hertz Service described on the front hereon. Hertz reserves the right to change

the class of car in furnishing the Hertz Service. 10. In the event of occurrence of any event beyond the reasonable control of Hertz, to include without

limitation, acts of God, fire, flooding, explosion, strikes (legal or illegal) or labor stoppages, governmental laws, orders or regulations, war, rebellion or not

rationing, inability to obtain gasoline, vehicles or other supplies, end embargoes and shipping restrictions. Hertz obligation to furnish the Hertz Service

pursuant to this E-Voucher shall be excused and refund shall be made in accordance with Paragraph 9. 11. Accordance of this E-Voucher by the Renter

or by any person purchasing it on behalf of the Renter shall be deemed consent to and acceptance by the Renter of the terms and	conditions herein set

forth. Hertz is fully submitted to the local, state and federal legislation in every country. Please make sure you are aware of all requirements to rent and to

drive a car in other countries. All these information are available on our website www.hertz.com



</td>

</tr>

</table>



			<B>{{$order->reservation_last_name}} {{$order->reservation_first_name}} </B>,<BR /><BR />



			This email confirms your order was received at GoGoFlorida.com.

			Confirmation of reservation is automatic once payment is approved.

			Voucher produced from this web site must be presented to Hertz agent

			at time of pick-up.<BR /><BR />



			GoGoFlorida.com is an Authorized General Sales Agent for Hertz

			Rent-A-Car. Car rental services offered through this web site are not

			available to persons under 21 years of age and holders of United

			States and/or Canadian driver's licenses. Persons over 21years but

			under 25 years will be subject to a surcharge.<BR /><BR />



			Car rental vouchers are non-refundable. In the event of a change in

			your itinerary, a request for voucher re-issue can only be made

			through our support line. Credit card charges will appear on your bill

			as PAYPAL, Treasures Caribe International LLC.<BR /><BR />



			If you have questions about your order, or for vehicle rentals outside

			Florida, contact us via email support@gogoflorida.us or call 954

			636-1327.<BR /><BR />



			<B>Thanks for using GoGoFlorida.com.</B><BR /><BR />







			 <B>Order Information  Additional Information</B>

			<HR />



			<B>Order number:</B> {{$order->voucher_number}}<br />

			<B>Order Date:</B> {{$order->reservation_date}}

			<BR /><BR />





			 <B>Billing Address  Payment Information</B>

			 <HR />

			

			<b>Billing to :</b> {{$order->billing->billing_first_name}} {{$order->billing->billing_last_name}}<BR />

			<b>Address :</b> {{$order->billing->billing_address}}<BR />

			<b>Phone #</b> {{$order->billing->billing_phone}}<BR /><BR />

			<b>Payment method :</b> Online Credit Card PAY PAL



			<BR /><BR />

			<b>Order Summary</b>

			<HR/>



			<b>Shipping to :</b> {{$order->billing->billing_first_name}} {{$order->billing->billing_last_name}}<BR />

			<b>Address :</b> {{$order->billing->billing_address}}<BR />

			<b>Phone #</b> {{$order->billing->billing_phone}}<BR />
			
			<b>E-mail address :</b> {{$order->billing->billing_email}}<BR /><BR />




			<b>{{$order->rate->description}}</b><br />

			CALL FOR RATE INFO **<br />

			<b>Pickup/Dropoff Dropoff Date:</b> {{$order->reservation_pdate}}<br />

			<b>Pickup/Dropoff Pickup Date:</b> {{$order->reservation_ddate}}<br />

			<b>Pickup Time:</b> {{$order->reservation_ptime}}<br />

			<b>Dropoff Time:</b> {{$order->reservation_dtime}}<br />

			<b>Pickup City:</b> {{$order->plocation->name}}<br />

			<b>Dropoff City:</b> {{$order->dlocation->name}}<br /><br />

			

			<hr />



			<b>Subtotal:</b> $ {{round($order->reservation_total_amount,2)}} <BR />

			 @if($order->coupon)

			<b>Discount:</b> $ {{round($order->coupon->get_discount_amount($order->reservation_total_amount),2)}}<BR />

			 @endif

			<b>Sales Tax:</b> $ 0.00<BR />

			 @if($order->coupon)

			<b>Total:</b> $ {{round($order->reservation_total_amount-$order->coupon->get_discount_amount($order->reservation_total_amount),2)}}<BR /><BR />

			@else

			<b>Total:</b> $ {{round($order->reservation_total_amount,2)}}<BR /><BR />

			@endif

			<b>Non Refundable</b><BR /><BR />

			@if($order->coupon)

			<b>Discounts / Promotions / Gift Certificates</b><BR />

			<HR /><BR />

			{{$order->coupon->number}} - {{round($order->coupon->get_discount_amount($order->reservation_total_amount),2)}}<BR/><BR/>

			@endif

			<HR />

			

			<B>GoGoFlorida.com, <BR />

			Phone: 954 636-1327 </B> 

                        <br /><br />Processed by Pay Pal    



@endsection

