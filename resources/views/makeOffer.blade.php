<!DOCTYPE html>
<html>
<head>
	
	<title></title>

</head>
<body>


@include('header')


<div class="seller-wrapper1">

	<div class="seller-post-title">


		
@foreach ($data as $data)
		

		<h2>{{ $data->post_title }}</h2>

		
		<span style="float: right;">{{ $sent }}</span>
		
		<div class="within-days">Needed in: {{ $data->post_maxdays }} Days | </div>
		<div class="days-ago">Posted: {{ \Carbon\Carbon::parse($data->post_date)->diffForHumans() }}</div>
		<div class="under-amount">Under Rs {{ $data->post_budget }}</div>
		<div class="posted-by">{{ $data->user_fname ." ". $data->user_lname}} | </div>
		<div class="country">{{ $data->post_city }}</div>

		@if($sent=='Offer Sent Already')
		<a href="{{url('myOffers')}}">Offer I Sent</a>
		@else
		<a href="#" id="opener">Create Offer</a>
		@endif
		</div>
 





 
<div id="offer-dialog" class="modal">
 <div class="modal-content">
 	<span class="close">&times;</span>
 	<p>
 		{{ $data->post_title }}
 	</p>

		<form action="{{url('sendOffer')}}" method="post" class="offer-form">	
			@csrf
			<input type="hidden" name="id" value="{{ $data->id }}">
			
			<div class="offer-form-options">
				<b>Total Offer Amount</b> <input type="number" minlength="2" maxlength="10" name="offerAmount" placeholder="Offer Amount" required="">
			</div>

			<div class="offer-form-options">
			<b>Delivery Time in Days</b> <input type="number" minlength="1" maxlength="5" name="deliveryTime" placeholder="3 Days" required="">
			</div>

			<div class="offer-form-options">
			<b>Delivery Charges</b> <select name="deliveryCharges" required="">
				<option disabled="">Delivery Charges</option>
				<option value="Not Applicable">Not Applicable</option>
				<option value="Applicable">Applicable</option>
			</select>
			</div>

			<div class="offer-form-options">
			<b>Payment Method</b> <select name="paymentMethod" required="">
				<option disabled="">Payment Method</option>
				<option value="Cash on Delivery">Cash on Delivery</option>
				<option value="Pay before">Pay before</option>
				<option value="Other">Other</option>
			</select>
			</div>

			<div class="offer-form-options">
			<input type="submit" value="submit">
			</div>	
		</form>
	</div>
</div>




		

<div class="seller-post-details">

	<div class="seller-post-desc">

		<h3>@foreach($getMainCat as $getMainCat) {{ $getMainCat->cat_name }} @endforeach / @foreach($getSubCat as $getSubCat) {{ $getSubCat->cat_name }} @endforeach</h3>

		<p>{{ $data->post_details }}</p>
	</div>

	<img src="../postImages/{{$data->post_pic1}}">

@endforeach
</div>
</div>
</div>


<div class="wrapper-heading">You May Also Sell</div>

@foreach ($searchRecom as $searchRecom)

		<a href='{{url("makeOffer/$searchRecom->id")}}'>
			<div class='post-preview'>
		<img src="/postImages/{{$searchRecom->post_pic1}}">
		<b class='post-preview-align'>{{$searchRecom->user_fname}}</b>
		<p class='post-preview-align post-title'>{{$searchRecom->post_title}}</p>
		<b style='background: linear-gradient(to top left, #ff00ff 0%, #6600cc 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;' class='post-preview-align'>{{$searchRecom->post_city}}</b>
		</div></a>

@endforeach




@include('footer-menu')

@include('footer')










<script>
// Get the modal
var modal = document.getElementById("offer-dialog");

// Get the button that opens the modal
var btn = document.getElementById("opener");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

</body>
</html>