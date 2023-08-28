@extends('layouts.app')
@section('content')
<div class="split-screen">
    <div class="left">
        <section class="copy">
           
        </section>
    </div>
    <div class="right">
         <form method="POST" action="{{ route('login') }}" autocomplete="off">
        @csrf
            <section class="copy">
                    <div class="login-container">
                        <img src="/logo/seventh-day-adventist-logo.png" alt="seventhday logo">
                        <h2>{{ __('Obando Seventh-Day Adventist Church') }}</h2>
                    </div>
            </section>
            <section class="copy">
                <div class="login-container">
                    <!-- === SUCCESS MESSAGE FOR CHANGE PASSWORD === -->
                    @if (Session::has('info'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('info')}}
                        </div>
                    @endif


                    <!-- === ERROR MESSAGE FOR USERNAME === -->
                    @error('login')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror

                    <!-- === ERROR MESSAGE FOR PASSWORD === -->
                    @error('password')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                

                    <!-- === ERROR MESSAGE FOR DEACTIVATED ACC === -->
                    @error('deact')
                        <div class="alert alert-danger text-xs" role="alert">
                            {{ $message }}
                        </div>
                    @enderror

  

                </div>
            </section>
            <div class="input-container name">
                
                <label for="login">{{ __('Username / Email Address') }}</label>
                <input id="" type="text"
                class="{{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}"
                name="login" value="{{ old('username') ?: old('email') }}" required autofocus>
            </div>
            <div class="input-container password">
                  
                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

            </div>
                <section class="copy1 legal">
                    @if (Route::has('password.request'))
                        <p><span class="small"><a href="{{ route('forget.password.get') }}">{{ __('Forgot Your Password?') }}</a></span></p>
                    @endif
                </section>
            <div class="input-container cta">
                <label class="checkbox-container" for="remember_me">
                    <input type="checkbox" name="remember_me" id="remember_me" {{ old('remember_me') ? 'checked' : '' }}>
                    <span class="checkmark"></span>
                    {{ __('Remember Me') }}
                </label>
            </div> 
            <button type="submit" class="signup-btn">{{ __('Login') }}</button>
        </form>
    </div>
</div>
@endsection
