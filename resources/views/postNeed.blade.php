<!DOCTYPE html>
<html>
<head>
	<title></title>
	
	

</head>
<body>


@include('header')



<div class="buyer-post-wrapper1">

<div class="wrapper-heading">What Service Are You Looking For?</div>

<div class="buyer-post-box">

	<form method="post" action="needPosting" enctype="multipart/form-data" id="post">
		@csrf

		<h3>Title</h3>
		<span style="color:red; font-size:15px;">@error('title'){{$message}}@enderror</span>
		<textarea name="title" id="title" cols="90" rows="1" minlength="10" maxlength="40" placeholder="I am looking for" form="post" required="">{{old('title')}}</textarea>
		<span id="titleCounter" class="textCounter">40 characters left</span>



		<h3>Describe the service you're looking to purchase:</h3>
		<span style="color:red; font-size:15px;">@error('details'){{$message}}@enderror</span>
		<textarea name="details" cols="90" rows="8" minlength="20" maxlength="500" id="details" placeholder="I am looking for" form="post" required="">{{old('details')}}</textarea>
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


		<h3>You Need it Within How Much Days?</h3>
		<span style="color:red; font-size:15px;">@error('days'){{$message}}@enderror</span><br>

		<input type="number" value="{{old('days')}}" name="days" placeholder="13 Days" min="1" max="30" required>

		<h3>What is Your Maximum Budget?</h3>
		<span style="color:red; font-size:15px;">@error('budget'){{$message}}@enderror</span><br>
		<input type="number" value="{{old('budget')}}" name="budget" placeholder="Rs. 2150" min="50" max="9999999" required>

		<h3>Location?</h3>
		<span style="color:red; font-size:15px;">@error('budget'){{$message}}@enderror</span><br>
		<input type="text" value="{{old('city')}}" name="city" placeholder="Mardan" minlength="3" maxlength="10" required>

		<h3>Upload Images if any</h3>
		<span style="color:red; font-size:15px;">@error('file[]'){{$message}}@enderror</span><br>

		<input type="file" name="image" required="">

		<input type="submit" name="submit" value="Submit Post">


	</form>
</div>

<script type="text/javascript" src="{{ asset('js/postNeed.js') }}"></script>



</div>

@include('footer-menu')

@include('footer')





</body>
</html>