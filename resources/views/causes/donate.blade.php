@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <a href="#" class="thumbnail">
                    <img src="{{ url('/images/square.jpg') }}" alt="Cause Logo">
                </a>
            </div>
            <div class="col-md-8">
                <h1>{{ $cause->title }}</h1>
                <hr>
                <button class="btn btn-default" role="button">Donate Now</button>

                <p>Amount Raised: {{ '0' }}</p>
                <p>Description: {{ $cause->description }}</p>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="" id="offers">
            <h2>Offers</h2>
            <hr>
            <ul>
                @foreach($offers as $offer)
                    <li>Offer: {{ $offer['name'] }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('html, body').animate({
                scrollTop: $("#offers").offset().top
            }, 2000);
        });
    </script>
@endsection
