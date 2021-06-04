<!DOCTYPE html>
<html>
<head>
	<title></title>


</head>
<body>



@include('header')


<div class="user-profile-wrapper1">




@foreach ($data as $data)

	<div class="left-col">
		<img src="users_profile/{{$data->user_photo}}">
		<h2> {{$data->user_fname . $data->user_lname}} </h2>
		<h4>Buyer/Seller</h4>
		<hr noshade color="#9400d3">
		<div class="user-details">
			<table width="100%">
				<tr>
					<td class="left">From</td>
					<td class="right">{{$data->user_city}}</td>
				</tr>
				<tr>
					<td class="left">Since</td>
					<td class="right"><b>{{$data->created_at}}</b></td>
				</tr>
					<td class="left">All Time Posts</td>
					<td class="right"><b>{{$data->user_needs}}</b></td>
				</tr>
				</tr>
					<td class="left">Offers Maked</td>
					<td class="right"><b>{{$data->user_offers}}</b></td>
				</tr>
		

				<tr><td colspan="2"><hr noshade color="#9400d3"></td></tr>

				<tr>
						<td class="left">Email</td>
						<td class="right"><b>{{$data->email}}</b></td>
				</tr>

				<tr>
						<td class="left">Phone</td>
						<td class="right">{{$data->user_phone}}
						</td>

				</tr>
						<td class="left">Local Address</td>
						<td class="right">{{$data->user_address}}</td>
				</tr>
				</table>

			<a href="{{url('userProfile')}}" class="update-details">View and Edit Profile</a>


				</form>
		</div>
	</div>

@endforeach

<div class="right-col">

	<a href="{{ url('/myPosts') }}">
	<div class="card">
		<img src="/Images/myPostsIcon.png">
		<h3 align="left">Go to Your Posts</h3>
		<br>
		<p>Currently you have Posts:</p>
		<h2 style="color: purple;">
@foreach($totalPost as $totalPost)
			{{ $totalPost->totalPost }}
@endforeach
		</h2>
	</div>
	</a>

	<a href="{{ url('/myOffers') }}">
	<div class="card">
		<img src="/Images/myOffersIcon.png">
		<h3 align="left">Go to Your Offers</h3>
		<br>
		<p>Currently you have Made:</p>
		<h2 style="color: purple;">
@foreach($totalOffer as $totalOffer)
			{{ $totalOffer->totalOffer }}
@endforeach
		</h2>
	</div>
	</a>
	
	<a href="{{ url('/privacy-policy') }}">
	<div class="card">
		<img src="/Images/privacyIcon.png">
		<h3 align="left">Read Privacy Policy</h3>
		<br>
		<p>You Should Read & Agree it</p>
		<h2 style="color: purple;">+</h2>
	</div>
	</a>

	<a href="{{ url('/contactSupport') }}">
	<div class="card">
		<img src="/Images/supportIcon.png">
		<h3 align="left">Get Support Now</h3>
		<br>
		<p>Facing Any Problem? Report</p>
		<h2 style="color: purple;">+</h2>
	</div>
	</a>

	<div class="card" style="width: 730px; height: 200px;">
		<img src="/Images/analytics.gif" style="display: block; width: 730px; height: 230px;">
	</div>		

</div>



</div>


<div class="col-bottom">

<center>
<div class="wrapper-heading" style="float: left; margin-left: 40px; width:94%" id="myads">My Posted Needs</div>

@if(count($myNeeds)>0)	
		
@foreach($myNeeds as $myNeed)
		

		<div class='post-preview'>
		<a href="{{ url('/makeOffer') }}/{{$myNeed->id}}"><img src="postImages/{{$myNeed->post_pic1}}"></a>
		<p class='post-preview-align post-title'>{{$myNeed->post_title}}</p>
		<b style='background: linear-gradient(to top left, #ff00ff 0%, #6600cc 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;' class='post-preview-align'>{{$myNeed->post_city}}</b>

<div class="dropdown">
  <button class="actionBtn">ACTION</button>
  <div class="dropdown-content">

		<a href='{{url("deleteNeed")}}/{{$myNeed->id}}'>Delete Need</a>

		<a href='{{url("editNeed")}}/{{$myNeed->id}}'>Edit Need</a>

		<a href="{{url('offersIGot')}}/{{$myNeed->id}}">View Offers</a>
</div>
</div>

</div>

@endforeach
<a class="loadmore" href="{{ url('myPosts') }}">Load More>></a>


@else
<div class="not-found">

<h2>Ooops,  You didn't posted any need yet</h2>
<img src="/Images/notFound.png">


</div>
@endif

<br>
		



<div class="wrapper-heading" id="myoffers">My Sent Offers</div>


@if(count($myOffers)>0)	



<div class="BoardoffersTable">
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
	 <td><form method="post" action="{{ url('noMoreOffering') }}/{{  $myOffer->id }}">@csrf<img src="/Images/deleteIcon.png" onclick="javascript:this.form.submit();"></form></td>
    </tr>
@endforeach
  </table>
</div> 
<div class="loadmore"><a href="{{ url('myOffers') }}">Load More>></a></div>



</div>

		
</div>

</div>


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