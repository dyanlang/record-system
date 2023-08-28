@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
                <div class="col-md-15 col-md-offset-1">
                    <img src="/users/{{Auth::user()->uImg}}" class="img logo rounded-circle mb-5" style="max-width: 150px; border-radius:50%;">

                    
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
