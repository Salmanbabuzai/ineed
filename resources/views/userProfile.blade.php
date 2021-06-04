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

		<label for="imgUpdate">
		<img src="users_profile/{{$data->user_photo}}" style="cursor: pointer;">
		</label>
		<span style="color:red; font-size:12px; display: block;">@error('imgUpdate'){{$message}}@enderror</span>

		<form method="post" action="/updateUserImage" enctype="multipart/form-data">
			@csrf
		<input type="file" name="imgUpdate" onchange="javascript:this.form.submit();" id="imgUpdate" style="display: none;">
		</form>

		<h2>{{$data->user_fname}}</h2>
		<a href="{{url('userBoard')}}"><h4>View Dashboard</h4></a>

		<ul>	
			<a href="{{url('userBoard')}}"><li>Contact Information</li></a>
			<a href="{{url('myPosts')}}"><li>My Posts</li></a>
			<a href="{{url('myOffers')}}"><li>My Offers</li></a>
			<a href="{{url('search')}}"><li>Search Now</li></a>
			<a href="{{url('userProfile#password')}}"><li>Change Password</li></a>
			<li><form method="POST" action="{{ route('logout') }}">
            @csrf
            <input type="submit" name="logout" value="Log out" style="border: none;outline: none;background-color: inherit; color: white; font-size: 17px; cursor: pointer;">
			</form></li>
			<li>Social Networks</li>
			<li>Delete Account</li>
		</ul>
	</div>

	

	<div class="right-col">

		<p class="main-heading">CONTACT INFORMATION</p>

		<form method="post" action="{{url('userPersonalProfile')}}">
			@csrf
			<input type="hidden" name="id" value="{{ $data->id }}">
			<p class="update-heading">Personal Info</p>

			<table>
				<tr>
					<td>Full Name</td>
					<td><input type="text" name="fullName" class="input" value="{{$data->user_fname . $data->user_lname}}" disabled=""></td>
				</tr>

				<tr>
					<td>Email Address</td>
					<td><input type="email" name="email" class="input" value="{{$data->email}}" disabled=""></td>
				</tr>

				<tr>		
					<td>Phone Number</td>
					<td><input type="number" name="phone" class="input" value="{{$data->user_phone}}" maxlength="13" minlength="11"></td>
				</tr>
				<tr>
					<td colspan="3"><span style="color:red; font-size:15px;">@error('phone'){{$message}}@enderror</span></td>
				</tr>

				<tr>
					<td><input type="submit" name="update-password" value="Update" class="edit-update-btn"></td>
				</tr>
			</table>
		</form>

		<form method="post" action="{{url('userAddressProfile')}}">
			@csrf
			<input type="hidden" name="id" value="{{ $data->id }}">
			<p class="update-heading">Address</p>

			<table>
				<tr>
					<td>City</td>
					<td><input type="text" name="city" class="input" value="{{$data->user_city}}" maxlength="20" minlength="3"></td>
				</tr>

				<tr>
					<td>Local Address</td>
					<td><textarea name="address" minlength="5" maxlength="50" class="input" rows="5" style="font-family: sans-serif;">{{$data->user_address}}</textarea></td>
				</tr>
					<tr>
					<td colspan="3"><span style="color:red; font-size:15px;">@error('city'){{$message}}@enderror @error('address'){{$message}}@enderror</span></td>
				</tr>
				<tr>
					<td><input type="submit" name="update-password" value="Update" class="edit-update-btn"></td>
				</tr>
			
			</table>
		</form>


		<form method="post" action="{{url('updatePassword')}}">
			@csrf
			<input type="hidden" name="id" value="{{$data->id}}">
			<p class="update-heading">Update Password</p>

			<table id="password">
			<tr>
				<td>Old Password</td>
				<td><input type="password" class="input" name="currentPass" required=""></td>
			</tr>
			<tr><td colspan="3"><span style="color:red; font-size:15px;">@error('currentPass'){{$message}}@enderror</span></td></tr>
			
			<tr>
				<td>New Password</td>
				<td><input type="password" class="input" name="newPass" required=""></td>
			</tr>
			<tr><td colspan="3"><span style="color:red; font-size:15px;">@error('currentPass'){{$message}}@enderror</span></td></tr>

			<tr>
				<td>Confirm New Password</td>
				<td><input type="password" class="input" name="confirmNewPass" required=""></td>
			</tr>
			<tr><td colspan="3"><span style="color:red; font-size:15px;">@error('confirmNewPass'){{$message}}@enderror</span></td></tr>

			<tr>
			<td>
			<input type="submit" class="edit-update-btn" name="update-password" value="Update Password"></td></tr></table>

		</form>

	</div>
</div>

 @endforeach

@include('footer')



</body>
</html>