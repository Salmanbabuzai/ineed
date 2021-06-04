
<!DOCTYPE html>
<html>
<head>
    <title></title>

    <link rel="stylesheet" type="text/css" href="{{ url('/css/form.css') }}">

    <style type="text/css">
        p{
           margin-top: 10px;
    </style>

</head>
<body>

@include('header')

<div class="form" style="width: 300px;">
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <p>Email</p>
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />

            <!-- Password -->
                <p>New Password</p>
                <input id="password" type="password" name="password" required />
            <!-- Confirm Password -->
                <p>Confirm New Password</p>
                <input id="password_confirmation" type="password" name="password_confirmation" required />

                 <input type="submit" value="Send Reset Link" name="" style="display: block; margin: 20px 0px 0px 0px; padding: 5px; font-weight: bold; background: linear-gradient(to top left, #ff00ff 0%, #6600cc 100%); border-radius: 3px;color: white; border: none;">
 
        </form>

</div>
</body>