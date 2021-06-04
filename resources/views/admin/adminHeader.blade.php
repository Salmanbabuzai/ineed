<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="{{ url('/css/admin.css') }}">


	<script src="{{ asset('/js/jquery-min.js') }}"></script>	
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">

	<style type="text/css">
	.w-5{
		display: none;
	}
</style>

<body>


<div class="header">

	<a href="{{url('admin')}}"><img src="/Images/logo.jpg" class="top-logo"></a>
	
	<div class="top-menu">
	
			<a href="{{url('adminManager')}}">Dashboard</a>
			<form method="POST" action="{{ route('logout') }}" style="display: inline;">
            @csrf
            <input type="submit" name="logout" value="Log out" class="top-right-btn">
			</form>

		<img src="/users_profile/{{ \Auth::user()->user_photo }}" style="border-radius: 50%;">

		<span class="myName">{{ Auth::user()->user_fname }} {{ Auth::user()->user_lname }}</span>
	</div>
</div>

@if ($message = Session::get('success'))

        <div>
              <center><strong style="color:white; font-size:20px; background-color: green; width: 100%; display: block; position: absolute; z-index:100;">{{ $message }}</strong></center>
        </div>

@endif