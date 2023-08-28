@extends('layouts.app')
@section('content')
<div class="split-screen">
    <div class="left pr-3">
        <section class="copy">
            
        </section>
    </div>
    <div class="right2 m-5" style="justify-content: center">
        <div class="row m-5 ">
            <div class="col-md-12 m-4 ">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <section class="copy">
                        <div class="login-container">
                            <img src="/logo/seventh-day-adventist-logo.png" alt="seventhday logo">
                            <h2>{{ __('Seventh-Day Adventist Church') }}</h2>
                            <h4>ADMIN REGISTRATION</h4>
                        </div>
                    </section>

                    <input type="hidden" name="user_type" id="user_type" value="2">

                    <div class="row mt-4">
                        <div class="col-md-6">

                            <div class="input-container name">
                                <label for="firstname">{{ __('First Name') }}</label>
                                <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autofocus>

                                @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="input-container name">
                                <label for="middlename">{{ __('Middle Name') }}</label>
                                <input id="middlename" type="text" class="form-control @error('middlename') is-invalid @enderror" name="middlename" value="{{ old('middlename') }}" required autofocus>

                                @error('middlename')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="input-container name">
                                <label for="lastname">{{ __('Last Name') }}</label>
                                <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autofocus>

                                @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="input-container name">
                                <label for="username">{{ __('Username') }}</label>
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="input-container name">
                                <label for="email">{{ __('Email Address') }}</label>
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="input-container password">
                                <label for="password">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autofocus>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="input-container password">
                                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autofocus>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mt-5">
                                <div class="input-container mt-3">
                                    <button type="submit" class="signup-btn ">
                                        Register
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>

                    

                    
                </form>

            </div>
        </div>
        
    </div>
</div>
@endsection

