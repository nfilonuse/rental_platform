@extends('layouts.email')



@section('content')

<table width="694" height="331" border="1" cellpadding="0" cellspacing="0" bordercolor="#333333"  align='center'>

  <tr valign='top'>

					<td align="center" height='40' colspan='12' style='background:#f0f0f0;'>

						<h2>E-Confirmation car Voucher</h2>

					</td>

				</tr>

  <tr>

    <td height="46" colspan="4" valign="top"><font size="1" face="Arial, Helvetica, sans-serif">

      CUSTOMER NAME<br>

      &nbsp;<font size="2">{{$order->reservation_last_name}} , {{$order->reservation_first_name}} </font></font></td>

    <td colspan="3" valign="top"><font size="1" face="Arial, Helvetica, sans-serif">DATE

      ISSUED<br>

      &nbsp; <font size="2">{{$order->reservation_date}}</font> </font></td>

    <td colspan="4" valign="top"><font size="1" face="Arial, Helvetica, sans-serif">MCO

      NUMBER<br>

	   {{$order->reservation_mco_number}}

      </font></td>

    <td width="122" valign="top"><font size="1" face="Arial, Helvetica, sans-serif">VOUCHER

      NUMBER<br>

      &nbsp; <font size="2">{{$order->voucher_number}}</font> </font></td>

  </tr>

  <tr>

    <td height="14" colspan="12" valign="top"><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;</font></td>

  </tr>

  <tr>

    <td height="38" colspan="5" valign="top"><font size="1" face="Arial, Helvetica, sans-serif">RENTAL

      LOCATION<br>

      &nbsp; <font size="2">{{$order->plocation->name}}</font> </font></td>

    <td colspan="6" valign="top"><font size="1" face="Arial, Helvetica, sans-serif">RETURN

      LOCATION<br>

      &nbsp; <font size="2">{{$order->dlocation->name}}</font> </font></td>

    <td rowspan="4" valign="top"><font size="1" face="Arial, Helvetica, sans-serif">VALIDATION

      STAMP<br>

      </font></td>

  </tr>

  <tr> <font size="1">

    <td height="14" colspan="11" valign="top"><font face="Arial, Helvetica, sans-serif">&nbsp;</font></td>

    </font>

  <tr>

    <td width="95" height="38" colspan="2" valign="top"><font size="1" face="Arial, Helvetica, sans-serif">RENTAL

      DATE<br>

      &nbsp; <font size="2">{{$order->reservation_pdate. " ".$order->reservation_ptime}}</font> </font></td>

    <td colspan="8" valign="top"><font size="1" face="Arial, Helvetica, sans-serif">RETURN

      DATE<br>

      &nbsp; <font size="2">{{$order->reservation_ddate. " ".$order->reservation_dtime}}</font> </font></td>

    <td width="127" valign="top"><font size="1" face="Arial, Helvetica, sans-serif">NUMBER

      OF DAYS<br>

      &nbsp;&nbsp;&nbsp; <font size="2">{{$order->reservation_for_days}}</font> </font></td>

  </tr>

  <tr>

    <td height="14" colspan="11" valign="top"><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;</font></td>

  </tr>

  <tr>

    <td width="95" height="38" valign="top"><font size="1" face="Arial, Helvetica, sans-serif">CURRENCY<br>

      &nbsp; <font size="2">US Dollars</font></font></td>

    <td colspan="5" valign="top"><font size="1" face="Arial, Helvetica, sans-serif">VOUCHER

      VALUE<br>

      &nbsp; <font size="2">{{$order->reservation_total_amount}}<br />Non Refundable</font> </font>

       </td>

    <td colspan="3" valign="top"><font size="1" face="Arial, Helvetica, sans-serif">RATE

      CODE<br>

      &nbsp; <font size="2">{{$order->rate_code}}</font> </font></td>

    <td colspan="3" valign="top"><font size="1" face="Arial, Helvetica, sans-serif">AGENCY

      REFERENCE<br>

      &nbsp; <font size="2">GOGOFLORIDA.COM</font> </font></td>

  </tr>

  <tr>

    <td height="14" colspan="12" valign="top"><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;</font></td>

  </tr>

  <tr>

    <td height="38" colspan="3" valign="top"><font size="1" face="Arial, Helvetica, sans-serif">RESERVATION

      NUMBER<br>

      &nbsp; <font size="2">{{$order->reservation_number}}</font> </font></td>

    <td colspan="5" valign="top"><font size="1" face="Arial, Helvetica, sans-serif">CAR

      CATEGORY<br>

      &nbsp; <font size="2">{{$order->car_class_code}}</font> </font></td>

    <td colspan="4" rowspan="3"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">



        <tr>

          <td height="12" colspan="2" valign="top"><font size="1" face="Arial, Helvetica, sans-serif">AUTHORIZED

            SALES AGENT</font></td>

        </tr>

        <tr valign="middle">

          <td height="41" colspan="2"><font face="Arial, Helvetica, sans-serif">Treasures Caribe International</font></td>

        </tr>

        <tr>

          <td width="170" height="49" valign="top"><div align="center" class="style2"><font face="Arial, Helvetica, sans-serif">IT

              NUMBER : <br>

          {{$order->account->account_number}}<br> <br>IATA Number: <br>{{empty($order->account->iata_number)?'00295540':$order->account->iata_number}}</font></div></td>

          <td width="134" valign="top"><div align="center"><img src="/img/dollar_logo.jpg" width='120' /></div></td>

        </tr>

      </table></td>

  </tr>

<tr><td colspan=8 align=center><div align="center" style="color:red;font-size:14px"><font face="Arial, Helvetica, sans-serif">Processed by Pay Pal</font></div></td>

</tr>

  <tr>

    <td height="14" colspan="8" valign="top"><font size="1" face="Arial, Helvetica, sans-serif">&nbsp;</font></td>

  </tr>

  <tr>

    <td height="48" colspan="8" valign="top"><font size="1" face="Arial, Helvetica, sans-serif">OPTIONS

      INCLUDED<br>



      &nbsp; <font size="2">{{$params['voucher_description']}}</font></td>

  </tr>

  <tr>

    <td height="13" colspan="12" valign="top"><div align="right"><font size="1" face="Arial, Helvetica, sans-serif"><strong><!--AGENT

        COPY--></strong></font></div></td>

  </tr>

</table>

<br>

<table width="694" border="3" cellpadding="0" cellspacing="0" bordercolor="#000000"  align='center'>

  <tr>

    <td height="29"><div align="center"><strong>***REGULAR*** PREPAID LAC VOUCHER</strong></div></td>

  </tr>

</table>

<br>

<table width="694" border="3" cellpadding="0" cellspacing="0" bordercolor="#000000"  align='center'>

  <tr>

    <td height="29"><div align="center"><strong><font color="#ff0000">Customer Support Call 954 662 1493</font></strong></div></td>

  </tr>

</table>

<br>



<table width="694" border="0" cellspacing="0" cellpadding="0"  align='center'>

  <tr>

    <td><div align="center"><strong><font size="2"><u>GENERAL CONDITIONS</u></font></strong></div></td>

  </tr>

</table>



<br>

<table width="694" border="0" cellpadding="2"  align='center'>

  <tr>

    <td width="330" height="450" valign="top">

	<font size="1" face="Arial, Helvetica, sans-serif"><strong><font color="#000000" face="Verdana, Arial, Helvetica, sans-serif">Vouchers are non-refundable</font><font face="Verdana, Arial, Helvetica, sans-serif"></font></strong>

	<br />



	<font size="1" face="Arial, Helvetica, sans-serif"><strong><font color="#000000" face="Verdana, Arial, Helvetica, sans-serif">Rental

      Requirements</font><font face="Verdana, Arial, Helvetica, sans-serif">:</font></strong>

      All renters should be at least 21 years old. Renters between the ages of

      21 and 25 are subject to a surcharge. <br>

      <strong><font face="Verdana, Arial, Helvetica, sans-serif">Deposit:</font></strong>

      Renters with prepaid voucher including LDW may pay the additional charges

      with either cash or credit card. Renters accepting LDW and paying cash may

      be required to leave a refundable deposit in addition to the estimated charge

      of the rental. Cash refund may be subject to a mail refund. If the renter

      wishes to decline the LDW must leave a $1,500.00 refundable deposit either

      in cash or credit card (some locations only rent with credit card if LDW

      is declined). This deposit will be refunded after returning the car providing

      car is returned in the same condition as time of rental. Refund may be subject

      to a mail refund.<br>

      <?php /*?><strong><font face="Verdana, Arial, Helvetica, sans-serif">Cash Payment:</font></strong>

      Renter must present a valid passport and close return airline ticket. The

      airline ticket return date should match the closing date on Dollar&#8217;s

      contract, or a deposit and additional documents together with proof of residence

      outside the USA will be required.<br>



      <strong><font face="Verdana, Arial, Helvetica, sans-serif">Additional Drivers</font></strong>:Must

      be listed on the rental contract, be in possession of a valid driver&#8217;s

      license, comply with age requirements and be present when rental contract

      is signed. Under no circumstances can anyone drive the vehicle whose name

      does not appear on the rental contract. <br>

      <strong><font face="Verdana, Arial, Helvetica, sans-serif">Child Seat:</font></strong>

      Use of child seat for children under 4 years old or weighing less than 40

      lb. is mandatory. Seats are obtainable at a low cost and are subject to

      availability at time of rental. <br clear=all>

      <strong><font face="Verdana, Arial, Helvetica, sans-serif">Fuel:</font></strong>

      There are two options for the surcharge of fuel. One option is to accept

      the vehicle full of fuel and return it full. If the vehicle is returned

      less than full, the charge for the difference will be higher than actual

      market price. The other option is for the renter to take the vehicle with

      a full tank at a cost that is less than or equal to actual market price

      and return it empty. There is no refund for fuel if the second option is

      taken. <br clear=all>

      <strong><font face="Verdana, Arial, Helvetica, sans-serif">Airport/Hotel

      Access/Privilege or Operating Fee:</font></strong> A fee to cover the various

      airport/hotel concession/ access fees in Florida, plus the additional cost

      of doing business on or near airport/hotel. This fee varies by location.

      Miami Airport mandatory Concession Facility Charge (CFC) will be collected at the <br>

      Miami Airport Location.<br>



      <strong><font face="Verdana, Arial, Helvetica, sans-serif">Florida Surcharge

      and Fees:</font></strong> Is a surcharge on all rental vehicles based on

      a per car per day fee of $2.52, $2.00 of which is state revenue, $0.47 License

      and $0.05 Recycling Fee Recovery. <font face="Verdana, Arial, Helvetica, sans-serif"><strong><br clear=all>

      Florida Sales Tax:</strong></font> Tax imposed by the State of Florida.

      Differs depending on the city. Miami 7% - Orlando 6.5% - Ft. Lauderdale

      6.0% - Tampa 6.5% <br clear=all>

      <br clear=all>

      <strong>FOR ADDITONAL INFORMATION CONSULT A DOLLAR RENT A CAR RENTAL AGENT

      AT THE TIME OF RENTAL</strong> <br>

      <strong><font face="Verdana, Arial, Helvetica, sans-serif">Surcharges, Fees

      and Taxes are Subject to Change Without Notice</font></strong> </font><?php */?>&nbsp;</td>

  </tr>

</table>



			<B>{{$order->reservation_last_name}} {{$order->reservation_first_name}} </B>,<BR /><BR />



			This email confirms your order was received at GoGoFlorida.com.

			Confirmation of reservation is automatic once payment is approved.

			Voucher produced from this web site must be presented to Dollar agent

			at time of pick-up.<BR /><BR />



			GoGoFlorida.com is an Authorized General Sales Agent for Dollar

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

