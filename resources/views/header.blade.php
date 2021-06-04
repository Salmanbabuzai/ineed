<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('/css/form.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('/css/seller.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('/css/userProfile.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('/css/postNeed.css') }}">

	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
	<script src="{{ asset('/js/jquery-min.js') }}"></script>	

	
<style type="text/css">
	.w-5{
		display: none;
	}
</style>




<div class="header">
	
	<a href="{{url('index')}}"><img src="/Images/logo.jpg" class="top-logo"></a>

	<form action="{{url('search')}}" method="post">
		@csrf
		<input type="hidden" name="id" value="searchBox">
		<input type="search" autocomplete="off" name="searching" class="search" placeholder="What's people needed">
		<input type="submit" name="search" value="Find" class="search-btn">
	</form>

	<div class="top-menu">
	
			<a href="{{ url('userBoard') }}" class="top-menu-a">Dashboard</a>

@auth
@if($signal==1)
@foreach($postId as $postId)
			<a href="{{ url('gotNotification') }}/{{ $postId->post_id }}" class="top-menu-a">Notification<sup><img src="/Images/noti.png" style="vertical-align:middle; width: 10px; margin: 0px;"></a>
@endforeach			
@else
			<a href="#" class="top-menu-a" style="">Notification</a>
@endif			
@endauth	
@guest
			<a href="#" class="top-menu-a">Notification</a>
@endguest			
			<a href="{{url('help')}}" class="top-menu-a">Help</a>
			<a href="{{url('search')}}" class="top-menu-a">Search It</a>
			

@auth

<a href="{{url('postNeed')}}" class="top-right-btn">POST NEED</a>
<div class="container" onclick="show()">
    <label for="profile2" class="profile-dropdown">
      <input type="checkbox" id="profile2">
      <img src="/users_profile/{{ \Auth::user()->user_photo }}">
      <ul id="topRightBox" onmouseleave="hide()">
        <li><a href="{{ url('/userBoard') }}">Dashboard</a></li>
        <li><a href="{{ url('/userProfile') }}">My Profile</a></li>
        <li><a href="{{ url('myPosts') }}">My Posts</a></li>
        <li><a href="{{ url('myOffers') }}">Sent Offers</a></li>
        <li><a href="{{ url('userProfile') }}">Settings</a></li>
        <li><a href="">

        	<form method="POST" action="{{ route('logout') }}">
            @csrf
            <input type="submit" name="logout" value="Log out" class="top-right-btn">
			</form>

        </a></li>
      </ul>
<span class="myName">{{ Auth::user()->user_fname }} {{ Auth::user()->user_lname }}</span>

    </label>
</div>
@endauth

			@guest
			<a href="{{url('/login')}}" class="top-menu-a">Sign in</a>
			<a href="{{url('/postNeed')}}" class="top-menu-a">Need</a>
			<a href="{{url('/register')}}" class="top-right-btn">Join Now</a>

			@endguest
			
	</div>

</div>

<div class="menu">
	<center><ul>

		<div class="dropdown">
			<li class="dropbtn">Electronics</li>
			<div class="dropdown-content">
				@foreach ($cat1 as $cat1)
				<a href="{{url('/search')}}/{{$cat1->id}}">{{ $cat1->cat_name }}</a>
				@endforeach
			</div>
		</div>
		

		<div class="dropdown">
			<li class="dropbtn">Fashion & Beauty</li>
			<div class="dropdown-content">
				@foreach ($cat2 as $cat2)
				<a href="{{url('/search')}}/{{$cat2->id}}">{{ $cat2->cat_name }}</a>
				@endforeach
			</div>
		</div>

		<div class="dropdown">
			<li class="dropbtn">Furniture & Home Decor</li>
			<div class="dropdown-content">
				@foreach ($cat3 as $cat3)
				<a href="{{url('/search')}}/{{$cat3->id}}">{{ $cat3->cat_name }}</a>
				@endforeach
			</div>
		</div>

		<div class="dropdown">
			<li class="dropbtn">Pets</li>
			<div class="dropdown-content">
				@foreach ($cat4 as $cat4)
				<a href="{{url('/search')}}/{{$cat4->id}}">{{ $cat4->cat_name }}</a>
				@endforeach
			</div>
		</div>

		<div class="dropdown">
			<li class="dropbtn">Sports</li>
			<div class="dropdown-content">
				@foreach ($cat5 as $cat5)
				<a href="{{url('/search')}}/{{$cat5->id}}">{{ $cat5->cat_name }}</a>
				@endforeach
			</div>
		</div>
		<div class="dropdown">
			<li class="dropbtn">Vehicles</li>
			<div class="dropdown-content">
				@foreach ($cat6 as $cat6)
				<a href="{{url('/search')}}/{{$cat6->id}}">{{ $cat6->cat_name }}</a>
				@endforeach

			</div>
		</div>

		<div class="dropdown">
			<li class="dropbtn">Property</li>
			<div class="dropdown-content">
				@foreach ($cat7 as $cat7)
				<a href="{{url('/search')}}/{{$cat7->id}}">{{ $cat7->cat_name }}</a>
				@endforeach
			</div>
		</div>

		<div class="dropdown">
			<li class="dropbtn">Arts & Crafts</li>
			<div class="dropdown-content">
				@foreach ($cat8 as $cat8)
				<a href="{{url('/search')}}/{{$cat8->id}}">{{ $cat8->cat_name }}</a>
				@endforeach
			</div>
		</div>

		<div class="dropdown">
			<li class="dropbtn">Virtual Assistant</li>
			<div class="dropdown-content">
				@foreach ($cat9 as $cat9)
				<a href="{{url('/search')}}/{{$cat9->id}}">{{ $cat9->cat_name }}</a>
				@endforeach
			</div>
		</div>

		<div class="dropdown">
			<li class="dropbtn" style="color: white; font-weight: bold;">Others</li>
			<div class="dropdown-content">
				
			</div>
		</div>

	</ul></center>
</div>

@if ($message = Session::get('msg'))

        <div>
              <center><strong style="color:white; font-size:20px; background-color: black; width: 100%; display: block; z-index:1;">{{ $message }}</strong></center>
        </div>

@endif

@if ($message = Session::get('success'))

        <div>
              <center><strong style="color:white; font-size:20px; background-color: green; width: 100%; display: block; position: absolute; z-index:1;">{{ $message }}</strong></center>
        </div>

@endif

@if ($message = Session::get('error'))

        <div>
              <center><strong style="color:white; font-size:20px; background-color: red; width: 100%; display: block; position: absolute; z-index:1;">{{ $message }}</strong></center>
        </div>

@endif

@if ($message = Session::get('warn'))

        <div>
              <center><strong style="color:white; font-size:20px; background-color: orange; width: 100%; display: block; position: absolute; z-index:1;">{{ $message }}</strong></center>
        </div>

@endif

<script type="text/javascript">

	cont = document.getElementById('topRightBox');

	function show() {
		cont.style.display = 'block';
	}

	function hide() {
		cont.style.display = 'none';
	}

</script>