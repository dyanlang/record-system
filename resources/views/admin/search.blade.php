@extends('layouts.DashB')

@section('content')
<div class="container-fluid py-4">
  <div class="row mt-4 ">
    <div class="col-lg-12 mx-auto ">
        <div class="card ">
            <div class="card-body vh-100 my-10">
                <div>
                    <h2 class="m-0 font-weight-bold text-danger text-center mb-3">Oops! There is something Wrong.</h2>
                </div>
                <div class="text-center mx-auto">
                  <img src="{{ asset('logo/lost.gif') }}" alt="A Guy that is LOST" height="250">

                </div>
                <div class="text-center mt-5">
                      <h4 class="text mb-0"> There is no such thing "{{ $search }}" as a keyword </h4>
                </div>
                <div class="text-center">
                      <h5 class="text mb-0"> Please input the correct keyword or  <a href="/home" class="text-success">Return to the homepage</a>.</p></h5>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection