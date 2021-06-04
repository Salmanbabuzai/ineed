<!DOCTYPE html>
<html>
<head>
	<title></title>


</head>
<body>



@include('header')



<div class="col-bottom">

<center>

@if(count($myOffers)>0)	

<div class="wrapper-heading" style="float: left; margin-left: 40px; width:94%" id="myads">Offers I Sent</div>

<div class="BoardoffersTable" style="margin-bottom: 300px;">
  <table>
  <tr>
      <th style="	background: linear-gradient(to top left, #ff00ff 0%, #6600cc 100%); font-weight: bold; color: #fff;">Post Title</th>
      <th>Offer Date</th>
      <th>My Offer Price</th>
      <th>Days</th>
      <th>Delviery Charges</th>
      <th>Payment Method</th>
      <th colspan="2">Action</th>
    </tr>

@foreach($myOffers as $myOffer)

   <tr class="BoardoffersTabletd">
    	<td>{{ $myOffer->post_title }}</td>
      <td>{{ \Carbon\Carbon::parse($myOffer->offer_date)->diffForHumans() }}</td>
      <td>{{ $myOffer->offer_amount }}</td>
      <td>{{ $myOffer->delivery_time }}</td>
      <td>{{ $myOffer->delivery_charges }}</td>
      <td>{{ $myOffer->payment_method }}</td>
      <td><a href="/makeOffer/{{ $myOffer->postId }}"><img src="/Images/gotoIcon.png"></a></td>
	 <td><a href="{{ url('noMoreOffering') }}/{{  $myOffer->id }}"><img src="/Images/deleteIcon.png"onclick="this.parentNode.form.submit();"></a></td>
    </tr>
@endforeach
  </table>
</div> 

<br>

<span>
	{{ $myOffers->links() }}
</span>



@else
<div class="not-found">

<h2>Ooops,  You have not made any offer yet</h2>
<img src="/Images/notFound.png">


</div>
@endif



</center>

@include('footer')



</body>
</html>