<!DOCTYPE html>
<html>
<head>
  <title></title>

</head>

<body>


@include('header')


<div class="form-field">
<div class="form">
      
      <a class="heading">Log In</a>
     
          <h1>Welcome Back!</h1>
          
          <form action="{{url('login')}}" method="post" enctype="multipart/form-data">
            @csrf
          
            <div class="field-wrap">
            <input id="email" type="email" name="email" placeholder="Email Address"  autocomplete="off"/ style="width: 500px;">
            <span style="color:red; font-size:15px;">@error('email'){{$message}}@enderror</span>
          </div>
          
          <div class="field-wrap">
            <input id="password" type="password" name="password" placeholder="Password"  autocomplete="off"/>
            <span style="color:red; font-size:15px;">@error('password'){{$message}}@enderror</span>
          </div>
          
          <p class="forgot"><a href="{{ url('forgot-password') }}">Forgot Password?</a></p>
          
          <button type="submit" class="button button-block"/>Log In</button>
          <br>
          <center><span style="color: gray;">Not Registed? <a style="text-decoration: none;" href="{{url('register')}}"> Sign up</a></span></center>
          
          </form>

        </div>
        
      </div><!-- tab-content -->
      


</body>
</html>
