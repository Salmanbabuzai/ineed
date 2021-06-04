<!DOCTYPE html>
<html>
<head>
    <title></title>

    <link rel="stylesheet" type="text/css" href="{{ url('/css/form.css') }}">

</head>
<body>

@include('header')

<div class="form" style="width: 300px;">

        <div style="margin: 0px 0px 10px 0px;">
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
        </div>

        <!-- Session Status -->
        <font color="green" style="font-size: 15px"><x-auth-session-status class="mb-4" :status="session('status')" /></font>

        <!-- Validation Errors -->
        <font color="red" style="font-size: 15px"><x-auth-validation-errors class="mb-4" :errors="$errors" /></font>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address --> 
                <label>Email</label>
                <input id="email" style="padding: 5px;" type="email" name="email" :value="old('email')" required autofocus />
                <input type="submit" value="Send Reset Link" name="" style="display: block; margin: 20px 0px 0px 0px; padding: 5px; font-weight: bold; background: linear-gradient(to top left, #ff00ff 0%, #6600cc 100%); border-radius: 3px;color: white; border: none;">
            
        </form>

</div>

</body>
</html>