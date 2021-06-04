<!DOCTYPE html>
<html>
<head>
	<title></title>


</head>
<body>


@include('header')



<div class="col-bottom">

<center>

@if(count($myNeeds)>0)	


<div class="wrapper-heading" style="float: left; margin-left: 40px; width:94%" id="myads">My Posted Needs</div>
		
@foreach($myNeeds as $myNeed)
		

		<div class='post-preview'>
		<a href="{{ url('/makeOffer') }}/{{$myNeed->id}}"><img src="postImages/{{$myNeed->post_pic1}}"></a>
		<p class='post-preview-align post-title'>{{$myNeed->post_title}}</p>
		<b style='background: linear-gradient(to top left, #ff00ff 0%, #6600cc 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;' class='post-preview-align'>{{$myNeed->post_city}}</b>

<div class="dropdown">
  <button class="actionBtn">ACTION</button>
  <div class="dropdown-content">

		<a onclick="this.form.submit()"><form method="post" action='{{url("deleteNeed")}}/{{$myNeed->id}}' id="deleteNeed"><input id="sub" type="submit" style="display: none;">
			@csrf</form>Delete Need</a>

		<a href='{{url("editNeed")}}/{{$myNeed->id}}'>Edit Need</a>

		<a href="{{url('offersIGot')}}/{{$myNeed->id}}">View Offers</a>
</div>
</div>

</div>

@endforeach

<br>
<span>
	{{ $myNeeds->links() }}
</span>


@else
<div class="not-found">

<h2>Ooops,  You didn't posted any need yet</h2>
<img src="/Images/notFound.png">


</div>
@endif




</center>

@include('footer')



</body>
</html>