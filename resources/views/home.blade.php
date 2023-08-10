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
                <div id="welcomeBox">
        <h3>Free Music Downloads</h3>
        <p>Want to refresh your playlist without spending a dime? Well, you're in luck because<span>MTV.com</span> has lots of free music downloads just for you. Yes, you heard us right, you can get free music downloads right here! They'll cost you nothing, nada, zip, zero! And...Want to refresh your playlist without spending a dime? Well, you're in luck because MTV.com has lots of free music downloads just for you. Yes, you heard us right, you can get free music downloads right here! </p>
        <h5>Read Full Description</h5>
        <p>MTV podcasts are here! Score audio and video podcasts for your PC or portable media device.Get unlimited downloads from all your favorite bands and shows. Check out <span>MTV</span> on <span>Rhapsody.com.</span></p>
      </div>
            </div>
        </div>
    </div>
</div>
@endsection
