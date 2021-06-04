<!DOCTYPE html>
<html>
<head>
	<title>Search</title>
</head>
<body>



@include('header')


<div class="wrapper1">
	

<div class="search-filter">

<form method="get" id="myForm" action="../searchFiter">

  	<p>Budget Range: </p>
  <select name="budget">
		<option value="">Budget Range</option>
		<option value="level0">Less than 100</option>
		<option value="level1">100 - 500</option>
		<option value="level2">500 - 1500</option>
		<option value="level3">1500 - 4000</option>
		<option value="level4">4000 - 8000</option>
		<option value="level5">8000 - 15000</option>
		<option value="level6">15000 - 30000</option>
		<option value="level7">30000 - 50000</option>
		<option value="level8">50000 - 75000</option>
		<option value="level9">75000 - 99999</option>
		<option value="level10">Greater than 99999</option>
	</select>

	<p style="margin-left: 50px;">Type: </p>
	<select name="category">
		<option value="">All Categories</option>
		@foreach ($category as $category)
		<option value="{{ $category->cat_name }}">{{ $category->cat_name }}</option>
		@endforeach
	</select>
	<p style="margin-left: 50px;">Location: </p>
	<select name="city">
		<option value="">Everywhere</option>
		@foreach ($cityList as $cityList)
		<option value="{{ $cityList->post_city }}">{{ $cityList->post_city }}</option>
		@endforeach
	</select>

	<input type="submit" name="filter" value="Filter">

</form>


<!-- <p style="margin-left: 50px;">Order By:</p>
	<select name="orderBy">
		<option value="">Matched</option>
		<option value="99">Price Low to High</option>
		<option value="11">Price High to Low</option>
	</select>

-->

</div>


@if(count($data)>0)

  <div class="wrapper-heading">You Searched For: <i style='background: linear-gradient(to top left, #ff00ff 0%, #6600cc 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;'>{{$query}}</i></div>


<center>
@foreach ($data as $dataa)

		<a href='{{url("makeOffer/$dataa->id")}}'>
			<div class='post-preview'>
		<img src="/postImages/{{$dataa->post_pic1}}">
		<b class='post-preview-align'>{{$dataa->user_fname}}</b><b style="float: right; background: linear-gradient(to top left, #ff00ff 0%, #6600cc 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;'">{{$dataa->post_budget}}Rs</b>
		<p class='post-preview-align post-title'>{{$dataa->post_title}}</p>
		<b style='background: linear-gradient(to top left, #ff00ff 0%, #6600cc 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;' class='post-preview-align'>{{$dataa->post_city}}</b>
		</div></a>

@endforeach


@else
<div class="not-found">

<h2>Ooops,  Item Not Found</h2>
<h4>Try search for something more general, change the filters or check for spelling mistakes</h4>
<img src="/Images/notFound.png">


</div>
@endif





<div class="wrapper-heading"><img src="/Images/arrow.gif">People Also Need<img src="/Images/arrow.gif"></div>



@foreach ($searchRecom as $searchRecom)

		<a href='{{url("makeOffer/$searchRecom->id")}}'>
			<div class='post-preview'>
		<img src="/postImages/{{$searchRecom->post_pic1}}">
		<b class='post-preview-align'>{{$searchRecom->user_fname}}</b><b style="float: right; background: linear-gradient(to top left, #ff00ff 0%, #6600cc 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;'">{{$searchRecom->post_budget}}Rs</b>
		<p class='post-preview-align post-title'>{{$searchRecom->post_title}}</p>
		<b style='background: linear-gradient(to top left, #ff00ff 0%, #6600cc 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;' class='post-preview-align'>{{$searchRecom->post_city}}</b>
		</div></a>

@endforeach



</center>
</div>

	
@include('footer')



</body>
</html>