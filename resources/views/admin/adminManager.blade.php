 <!DOCTYPE html>
<html>
<head>
	<title></title>


</head>

@include('admin/adminHeader')


<div class="wrapper2">
	
<div class="allUsers">
<table class="table1">
	<tr class="tableHeading">
		<td colspan="9" class="tableHeading">Post Manager for All Users</td>
		<td align="right" colspan="2" class="tableHeading"><span onclick="showAddModel()" class="btn">ADD NEW USER</span></td>
	</tr>
</table>

<table class="table2">
	<tr>
		<th>ID</th>
		<th>Avatar</th>
		<th>First name</th>
		<th>Last Lname</th>
		<th>Email</th>
		<th>Phone</th>
		<th>City</th>
		<th>Address</th>
		<th>Posts</th>
		<th>Offers</th>
		<th>Action</th>
	</tr>
	@foreach ($dataa as $data)
	<tr>
		<td>{{$data->id}}</td>
		<td><img src="users_profile/{{$data->user_photo}}"></td>
		<td>{{$data->user_fname}}</td>
		<td>{{$data->user_lname}}</td>
		<td>{{$data->email}}</td>
		<td>{{$data->user_phone}}</td>
		<td>{{$data->user_city}}</td>
		<td>{{$data->user_address}}</td>
		<td><a href="{{url('adminPostManager')}}/{{$data->id}}" class="btn">Manage</a></td>
		<td><a href="{{url('adminOfferManager')}}/{{$data->id}}" class="btn">Manage</a></td>
		<td><a href="{{url('adminDeleteUser')}}/{{$data->id}}"><img src="/Images/deleteIcon.png" class="icon"></a><span onclick="showEditModel()" class="showEditUserModel"><img src="/Images/editIcon.png" class="icon"></span></td>
	</tr>
	@endforeach
</table>

<span class="links">
	{{ $dataa->links() }}
</span>
</div>


<!--ADD NEW USER FORM &times;-->

<div id="addUser-dialog" class="modal">
<div class="modal-content">
<span class="close"></span>

<div class="form-field">
<div class="form">
      
     <a class="heading">Add New User</a>
       
          
          <form action="{{url('adminAddUser')}}" method="post" enctype="multipart/form-data">
            @csrf
          

            <div class="field-wrap">
              <input type="text" name="fname" value="{{old('fname')}}" placeholder="First Name*" required autocomplete="off"/>
              <span style="color:red; font-size:15px;">@error('fname'){{$message}}@enderror</span>
            </div>
        
            <div class="field-wrap">
              <input type="text" name="lname" value="{{old('lname')}}" placeholder="Last Name*" required autocomplete="off"/>
              <span style="color:red; font-size:15px;">@error('lname'){{$message}}@enderror</span>
            </div>
       

          <div class="field-wrap">
            <input type="email" name="email" value="{{old('email')}}" placeholder="Email Address*" required autocomplete="off"/>
            <span style="color:red; font-size:15px;">@error('email'){{$message}}@enderror</span>
          </div>

          <div class="field-wrap">
            <input type="text" name="phone" value="{{old('phone')}}" placeholder="Phone" autocomplete="off"/>
            <span style="color:red; font-size:15px;">@error('phone'){{$message}}@enderror</span>
          </div>
          
          <div class="field-wrap">
            <input type="password" name="password" placeholder="Password*" required autocomplete="off"/>
            <span style="color:red; font-size:15px;">@error('password'){{$message}}@enderror</span>
          </div>

          <div class="field-wrap">
            <input type="password" name="confirm_password" placeholder="Confirm Password*" required autocomplete="off"/>
            <span style="color:red; font-size:15px;">@error('confirm_password'){{$message}}@enderror</span>
          </div>

          <div class="field-wrap">
            <input type="text" name="city" value="{{old('city')}}" placeholder="City" autocomplete="off"/>
            <span style="color:red; font-size:15px;">@error('city'){{$message}}@enderror</span>
          </div>

          <div class="field-wrap">
            <input type="text" name="address" value="{{old('address')}}" placeholder="Full Address" autocomplete="off"/>
            <span style="color:red; font-size:15px;">@error('address'){{$message}}@enderror</span>
          </div>

          <br>

         <div class="field-wrap">
            <label for="user_photo">
              <img src="/Images/uploadProfilePic.png" width="50px" style="vertical-align: middle;">Upload Profile Picture
            </label><input type="file" id="user_photo" name="user_photo"  autocomplete="off" style="display: none;">
            <br>
            <span style="color:red; font-size:15px;">@error('user_photo'){{$message}}@enderror</span>
          </div>
          
          <button type="submit" class="button button-block"/>Register</button>
          
          </form>

        </div>        
      </div><!-- tab-content -->
      
</div> <!-- /form -->
</div>
</div>

<!--ADD NEW USER ENDS-->


<!--EDIT USER DETAILS MODEL &times;-->


<div id="editUser-dialog" class="modal">
<div class="modal-content">
<span class="close"></span>

<div class="form-field">
<div class="form">
      
     <a class="heading">Update Details</a>
       
          
          <form action="{{url('adminUpdateUser')}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" id="id">

            <div class="field-wrap">
              <input type="text" name="fname" id="fname" placeholder="First Name*" required autocomplete="off"/>
              <span style="color:red; font-size:15px;">@error('fname'){{$message}}@enderror</span>
            </div>
        
            <div class="field-wrap">
              <input type="text" name="lname" id="lname" placeholder="Last Name*" required autocomplete="off"/>
              <span style="color:red; font-size:15px;">@error('lname'){{$message}}@enderror</span>
            </div>
       

          <div class="field-wrap">
            <input type="email" name="email" id="email" placeholder="Email Address*" required disabled autocomplete="off"/>
            <span style="color:red; font-size:15px;">@error('email'){{$message}}@enderror</span>
          </div>

          <div class="field-wrap">
            <input type="text" name="phone" id="phone" placeholder="Phone" autocomplete="off"/>
            <span style="color:red; font-size:15px;">@error('phone'){{$message}}@enderror</span>
          </div>
          
          <div class="field-wrap">
            <input type="password" name="currentPass" placeholder="Old Password" disabled autocomplete="off"/>
            <span style="color:red; font-size:15px;">@error('currentPass'){{$message}}@enderror</span>
          </div>

          <div class="field-wrap">
            <input type="password" name="currentPass" placeholder="New Password"  autocomplete="off"/>
            <span style="color:red; font-size:15px;">@error('currentPass'){{$message}}@enderror</span>
          </div>

          <div class="field-wrap">
            <input type="text" name="city" id="city" placeholder="City" autocomplete="off"/>
            <span style="color:red; font-size:15px;">@error('city'){{$message}}@enderror</span>
          </div>

          <div class="field-wrap">
            <input type="text" name="address" id="address" placeholder="Full Address" autocomplete="off"/>
            <span style="color:red; font-size:15px;">@error('address'){{$message}}@enderror</span>
          </div>
          
          <button type="submit" class="button button-block"/>Update</button>
          
          </form>

        </div>        
      </div><!-- tab-content -->
      
</div> <!-- /form -->
</div>
</div>

<script type="text/javascript" src="{{ asset('/js/adminManager.js') }}">
</script>




<!--EDIT USER DETAILS MODEL ENDS-->

















</div>

@include('footer')


</body>
</html>