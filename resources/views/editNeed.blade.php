<!DOCTYPE html>
<html>
<head>
	<title></title>


</head>


@include('header')

<div class="wrapper-heading">What Service Are You Looking For?</div>

<div class="buyer-post-box">

@foreach ($data as $data)

	<form method="post" action="{{('needUpdate')}}/{{ $data->id }}" enctype="multipart/form-data" id="post">
		@csrf

		<h3>Title</h3>
		<span style="color:red; font-size:15px;">@error('title'){{$message}}@enderror</span>
		<textarea name="title" id="title" cols="90" rows="1" minlength="10" maxlength="40" placeholder="I am looking for" form="post" required="">{{ $data->post_title }}</textarea>
		<span id="titleCounter" class="textCounter">40 characters left</span>


		<h3>Describe the service you're looking to purchase:</h3>
		<span style="color:red; font-size:15px;">@error('details'){{$message}}@enderror</span>
		<textarea name="details" id="details" cols="90" rows="8" minlength="20" maxlength="500" placeholder="I am looking for" form="post" required="">{{ $data->post_details }}</textarea>
		<span id="detailsCounter" class="textCounter">500 characters left</span>

		<h3>Choose a Category:</h3>
		
		<span style="color:red; font-size:15px;">@error('category'){{$message}}@enderror</span><br>

		
<select name="mainCat" id="mainCat">
	<option value="">Main Category</option>
	@foreach($mainCat as $mainCat)
	<option value="{{ $mainCat->id }}">{{ $mainCat->cat_name }}</option>
	@endforeach
</select>

<select name="subCat" id="subCat">
	<option value="">Sub Category</option>
</select>


		<h3>Once you place your order, when would you like your Product delivered?</h3>
		<span style="color:red; font-size:15px;">@error('days'){{$message}}@enderror</span><br>

		<input type="number" value="{{ $data->post_maxdays }}" name="days" placeholder="13 Days" required="">

		<span style="float: right; margin-right: 50px; transition: 0.35s ease; box-shadow: 0px 0px 10px 2px lightgray; cursor: pointer;"><img src="/postImages/{{ $data->post_pic1 }}" width="400px" height="400px"></span>

		<h3>What is Your Budget?</h3>
		<span style="color:red; font-size:15px;">@error('budget'){{$message}}@enderror</span><br>
		<input type="number" value="{{ $data->post_budget }}" name="budget" placeholder="Rs. 2150" required="">

		<h3>Location?</h3>
		<span style="color:red; font-size:15px;">@error('budget'){{$message}}@enderror</span><br>
		<input type="text" value="{{ $data->post_city }}" name="city" placeholder="Mardan" required="">

		<h3>Upload Images if any</h3>
		<span style="color:red; font-size:15px;">@error('file[]'){{$message}}@enderror</span><br>

		<input type="file" name="image">

		<input type="submit" name="submit" value="Submit Post">
@endforeach

	</form>
</div>

<script type="text/javascript" src="{{ asset('js/postNeed.js') }}"></script>


@include('footer-menu')

@include('footer')






</body>
</html>