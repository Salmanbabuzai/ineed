<!DOCTYPE html>
<html>
<head>
  <title></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('/css/form.css') }}">
  <script src="https://code.jquery.com/jquery-2.2.3.min.js"></script>


  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">

</head>

<body>

@include('header')


<div class="form-field">
<div class="form">
      
     <a class="heading">Sign Up</a>
       
          <h1>Sign Up for Free</h1>
          
          <form action="{{url('register')}}" method="post" enctype="multipart/form-data">
            @csrf
          
          <div class="top-row">
            <div class="field-wrap">
              <input type="text" name="fname" value="{{old('fname')}}" placeholder="First Name" autocomplete="off"/>
              <span style="color:red; font-size:15px;">@error('fname'){{$message}}@enderror</span>
            </div>
        
            <div class="field-wrap">
              <input type="text" name="lname" value="{{old('lname')}}" placeholder="Last Name" autocomplete="off"/>
              <span style="color:red; font-size:15px;">@error('lname'){{$message}}@enderror</span>
            </div>
          </div>

          <div class="field-wrap">
            <input type="email" name="email" value="{{old('email')}}" placeholder="Email Address" required autocomplete="off"/>
            <span style="color:red; font-size:15px;">@error('email'){{$message}}@enderror</span>
          </div>

          <div class="field-wrap">
            <input type="text" name="phone" value="{{old('phone')}}" placeholder="Phone" required autocomplete="off"/>
            <span style="color:red; font-size:15px;">@error('phone'){{$message}}@enderror</span>
          </div>
          
          <div class="field-wrap">
            <input type="password" name="password" placeholder="password" required autocomplete="off"/>
            <span style="color:red; font-size:15px;">@error('password'){{$message}}@enderror</span>
          </div>

          <div class="field-wrap">
            <input type="password" name="confirm_password" placeholder="Confirm Password" required autocomplete="off"/>
            <span style="color:red; font-size:15px;">@error('confirm_password'){{$message}}@enderror</span>
          </div>

          <div class="field-wrap">
            <input type="text" name="city" value="{{old('city')}}" placeholder="City" required autocomplete="off"/>
            <span style="color:red; font-size:15px;">@error('city'){{$message}}@enderror</span>
          </div>

          <div class="field-wrap">
            <input type="text" name="address" value="{{old('address')}}" placeholder="Full Address" required autocomplete="off"/>
            <span style="color:red; font-size:15px;">@error('address'){{$message}}@enderror</span>
          </div>

         <div class="field-wrap">
            <input type="file" name="user_photo"  autocomplete="off"/ style="display: none;">
            <span style="color:red; font-size:15px;">@error('user_photo'){{$message}}@enderror</span>
          </div>
          
          <button type="submit" class="button button-block"/>Get Started</button>
          <br>
          <center><span style="color: gray;">Already Registed? <a style="text-decoration: none;" href="{{url('login')}}"> Sign in</a></span></center>
          
          </form>

        </div>        
      </div><!-- tab-content -->
      
</div> <!-- /form -->


</body>
</html>