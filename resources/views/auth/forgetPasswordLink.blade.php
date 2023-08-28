

@extends('layouts.app')
@section('content')

<div class="split-screen">
    <div class="left">
    </div>
    <div class="right">


        <form action="{{ route('reset.password.post') }}" method="POST">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">
            <section class="copy">
                    <div class="login-container">
                        <img src="/logo/seventh-day-adventist-logo.png" alt="seventhday logo">
                        <h2>{{ __('Obando Seventh-Day Adventist Church') }}</h2>
                    </div>
            </section>

            <section class="copy">
                    <div class="login-container">
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>

                    <div class="login-container">
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>

                    <div class="login-container">
                        @if ($errors->has('password_confirmation'))
                            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                        @endif
                    </div>
            </section>

            

            <div class="input-container name">
                <label for="email_address">{{ __('Email Address') }}</label>
                <input type="text" id="email_address" name="email" required autofocus>
            </div>

            <div class="input-container password">
                <label for="password">{{ __('Password') }}</label>
                <input type="password" id="password" name="password" required autofocus>
            </div>

            <div class="input-container password-confirm">
                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                <input type="password" id="password-confirm" name="password_confirmation" required autofocus>
            </div>

            <button type="submit" class="signup-btn">
                    Reset Password
            </button>
        </form>
    </div>
</div>


@endsection


