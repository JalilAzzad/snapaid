@extends('layouts.app')

@section('content')
<div class="page wide regular-light">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <a href="#" class="thumbnail">
                    <img src="{{ url('/images/square.jpg') }}" alt="Profile Image">
                </a>
            </div>
            <div class="col-md-8">
                <h1>{{ $user->firstname . " " . $user->lastname }}</h1>
                <hr>
                <div class="causes">
                    <h2>Causes Working ON</h2>
                    <ul>
                        @foreach($user->causes as $cause)
                            <li><a href="/causes/{{$cause->slug}}">{{$cause->title}}</a></li>
                        @endforeach
                    </ul>
                </div>
                @if(count($user->reports) > 0)
                    <div class="causes">
                        <h2>Causes Donated To</h2>
                        <ul>
                            <?php $causes = []; ?>
                            @foreach($user->reports as $report)
                                @if(!in_array(($report->cause_id), $causes))
                                <li>
                                    <a href="/causes/{{$report->cause->slug}}">{{$report->cause->title}}</a>
                                </li>
                                <?php array_push($causes, $report->cause_id); ?>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
