<!DOCTYPE html>
<html>
<head>
	<title></title>

</head>
<body>
	

@include('header')


<div class="wrapper1">
	
	<img src="Images/hero.svg" style="background-color: black;">
	<div class="wrapper1-text">
		<span style="display: block; font-size: 40px; font-weight: bolder; margin-bottom: 20px; text-shadow: 5px 5px 5px black;"><h3>Find Buyer, Sell Product / Service!</h3></span>

	<form action="{{url('search')}}" method="post">
		@csrf
		<input type="hidden" name="id" value="searchBoxFull">
	<input type="search" name="searching" class="wrapper-search" autocomplete="off" placeholder="Find What Buyers Needed">
	<select name="options">
		<option>Search in</option>
		<option value="1">Electronics</option>
		<option value="13">Fashion and Beauty</option>
		<option value="24">Furniture and Home Decor</option>
		<option value="36">Pets</option>
		<option value="48">Sports</option>
		<option value="56">Vehicles</option>
		<option value="66">Property</option>
		<option value="76">Art and Crafts</option>
		<option value="85">Virtual Assistant</option>
		<option value="">Others</option>
	</select>
	<input type="submit" class="wrapper-search-btn" value="Search">
	<div class="wrapper1-tags">
		Popular: <p>Fashion & Jewlerry</p><p>Wallets</p><p>Laptops</p><p>Mobiles</p><p>Kitchen</p><p>Birds</p><p>Makup</p>
	</div>
	</div>

</div>

<div class="wrapper-heading">Featured Needs</div>
<div class="wrapper2">

<center>

@foreach($data1 as $data1)

		<a href='{{url("makeOffer/$data1->id")}}'>
			<div class='post-preview'>
		<img src="postImages/{{$data1->post_pic1}}">
		<b class='post-preview-align'>{{$data1->user_fname}}</b><b style="float: right; background: linear-gradient(to top left, #ff00ff 0%, #6600cc 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;'">{{$data1->post_budget}}Rs</b>
		<p class='post-preview-align post-title'>{{$data1->post_title}}</p>
		<b style='background: linear-gradient(to top left, #ff00ff 0%, #6600cc 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;' class='post-preview-align'>{{$data1->post_city}}</b>
		</div></a>

@endforeach
		
</center>

</div>
<a href="{{url('search')}}" class="loadmore">Load More>></a>


<div class="wrapper-heading">Latest & Urgent Needs</div>
<div class="wrapper2">

<center>
	
@foreach($data2 as $data2)

		<a href='{{url("makeOffer/$data2->id")}}'>
			<div class='post-preview'>
		<img src="postImages/{{$data2->post_pic1}}">
		<b class='post-preview-align'>{{$data2->user_fname}}</b><b style="float: right; background: linear-gradient(to top left, #ff00ff 0%, #6600cc 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;'">{{$data2->post_budget}}Rs</b>
		<p class='post-preview-align post-title'>{{$data2->post_title}}</p>
		<b style='background: linear-gradient(to top left, #ff00ff 0%, #6600cc 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;' class='post-preview-align'>{{$data2->post_city}}</b>
		</div></a>

@endforeach	

</center>

</div>
<a href="{{url('search')}}" class="loadmore">Load More>></a>



<div class="wrapper-heading">Explore by Categories</div>

<div class="wrapper3">
	
	<center>
	<div class="category-icon"><a href="{{url('/search')}}/1"><img src="Images/cat1.png"><br>Electronics</a></div>
	<div class="category-icon"><a href="{{url('/search')}}/13"><img src="Images/cat2.png"><br>Fashion & Beauty</a></div>
	<div class="category-icon"><a href="{{url('/search')}}/76"><img src="Images/cat3.png"><br>Arts & Crafts</a></div>
	<div class="category-icon"><a href="{{url('/search')}}/36"><img src="Images/cat4.png"><br>Pets</a></div>
	<div class="category-icon"><a href="{{url('/search')}}/56"><img src="Images/cat5.png"><br>Vehicles</a></div>
	<div class="category-icon"><a href="{{url('/search')}}/66"><img src="Images/cat6.png"><br>Property</a></div>
	<div class="category-icon"><a href="{{url('/search')}}/24"><img src="Images/cat7.png"><br>Furniture & Decor</a></div>
	<div class="category-icon"><a href="{{url('/search')}}/22"><img src="Images/cat8.png"><br>Wearable</a></div>
	<div class="category-icon"><a href="{{url('/search')}}/2"><img src="Images/cat10.png"><br>Mobiles</a></div>
	<div class="category-icon"><a href="{{url('/search')}}/17"><img src="Images/cat11.png"><br>Watches</a></div>
	<div class="category-icon"><a href="{{url('/search')}}/4"><img src="Images/cat12.png"><br>Audio & Sterio</a></div>
	<div class="category-icon"><a href="{{url('/search')}}/85"><img src="Images/cat9.png"><br>Virtual Assistant</a></div>	
	</center>

</div>


<div class="wrapper4">
	
	<img src="Images/hero.svg" style="background-color: black;">
	
	<div class="wrapper1-text"><span style="display: block; font-size: 40px; font-weight: bolder; margin-bottom: 20px; text-shadow: 5px 5px 5px black;"><h3>Deal it, Buy it NOW!</h3></span>
	<a href="{{ url('postNeed') }}" class="top-right-btn">Get Started</a>
	</div>

</div>


@include('footer-menu')

@include('footer')



</body>
</html>