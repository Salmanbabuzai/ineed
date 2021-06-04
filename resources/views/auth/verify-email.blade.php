<!DOCTYPE html>
<html>
<head>
    <title></title>



</head>
<body>

@include('header')

<div class="form" style="width: 360px;">
        <div class="mb-4 text-sm text-gray-600">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <input type="submit" value="Resend Verification Email" name="" style="margin: 20px 0px 0px 0px; padding: 5px; font-size: 20px; font-weight: bold; background: linear-gradient(to top left, #ff00ff 0%, #6600cc 100%); border-radius: 3px;color: white; border: none; cursor: pointer;">
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <input type="submit" value="Lougout" name="" style="margin: 20px 0px 0px 0px; padding: 5px; font-weight: bold; font-size: 18px; color: purple; border: 2px solid purple; border-radius: 5px; cursor: pointer;">
            </form>
        </div>


</div>
</body>