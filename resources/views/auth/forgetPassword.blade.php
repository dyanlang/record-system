

@extends('layouts.app')
@section('content')


<div class="split-screen">
    <div class="left">
    </div>
    <div class="right">


        <form action="{{ route('forget.password.post') }}" method="POST" autocomplete="off">
        @csrf
            <section class="copy">
                    <div class="login-container">
                        <img src="/logo/seventh-day-adventist-logo.png" alt="seventhday logo">
                        <h2>{{ __('Obando Seventh-Day Adventist Church') }}</h2>
                    </div>
            </section>

            <section class="copy">
                <p><span class="small">Enter your email address and we will sent you a link to reset your password.</span></p>
               
            </section>

            <section class="copy">
                    <div class="login-container">

                        @if (Session::has('message'))
                                <div class="text-success" role="alert">
                                {{ Session::get('message') }}
                            </div>
                        @endif

                        @if (Session::has('error'))
                                <div class="text-danger" role="alert">
                                {{ Session::get('error') }}
                            </div>
                        @endif

                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
            </section>

            

            <div class="input-container name">
                <label for="email_address">{{ __('Email Address') }}</label>
                <input type="text" id="email_address" name="email" required autofocus>
            </div>

            <button type="submit" class="signup-btn">
                    Send Password Reset Link
            </button>

            <div class="input-container cta">
                <section class="copy1 legal">
                    @if (Route::has('login'))
                        <p><span class="small"><a href="{{ route('login') }}">Back to Login</a></span></p>
                    @endif
                </section>
            </div>

                
        </form>
               
    </div>
</div>

@endsection