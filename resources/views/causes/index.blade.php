@extends('layouts.app')

@section('content')

    <div class="container-fluid causes-top">
        <div class="container">
            <div class="row text-center ">
                <div class="col"><h2>Find a Charity You Want To Give To</h2></div>
            </div>
            <div class="row justify-content-center ">
                <div class="col-lg-6 causes-search-form py-2 pr-2">
                    <form method="GET">
                        <label class="sr-only" for="inlineFormInput">Search Cause</label>
                        <input type="text" name="q" class="form-control col-8" id="inlineFormInput" placeholder="Search Cause" value="{{ request()->input('q') }}">
                        <button type="submit" class="btn btn-danger col-sm-3 col-4 float-right" style="cursor: pointer;">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <div class="fluid-container">
        <div class="container">
            @if(count($featured_causes) > 0)
                <div class="row">
                    <div class="col-12">
                        <h4 class="heading">Featured</h4>
                        <hr>
                    </div>
                    <div class="col-12">
                        @foreach($featured_causes as $cause)
                            <div class="cause-card text-center" >
                                <img src="{{ url('/images/causes/'.$cause->id.'.'.$cause->file_ext) }}" class="img-fluid" alt="logo">
                                <hr>
                                <h5>{{ $cause->title }}</h5>
                                <ul class="col-12 text-center">
                                    <li class="col-4 p-0">${{ number_format($cause->reports()->lead()->whereBetween('created_at', [\Carbon\Carbon::now()->subDays(7)->toDateTimeString(), \Carbon\Carbon::now()->toDateTimeString()])->sum('rate'), 2) }}<br><span>Past 7 Days</span></li>
                                    <li class="col-3 p-0" style="font-weight: bold; font-size: 14px;">{{ 715 + $cause->reports()->lead()->count() }} <br><span class="mr-1">Donations</span></li>
                                    <li class="col-4 p-0">${{ number_format(500 + $cause->reports()->lead()->sum('rate'), 2) }} <br><span>Total Raised</span></li>
                                </ul>
                                <a href="/causes/{{ $cause->slug }}" class="btn btn-danger btn-red px-5 mb-4">Donate</a>
                            </div>
                        @endforeach
                    </div>

                </div>
            @endif

            <?php $cond = true; ?>
            @foreach($categories as $category)
                <div class="row">
                    @if(count($category->causes) > 0)
                        <?php $cond = false; ?>
                        <div class="col-12">
                            <h4 class="heading">{{ $category->title }}</h4>
                            <hr>
                        </div>
                        <div class="col-12">

                            @foreach($category->causes as $cause)
                                <div class="cause-card text-center" >
                                    <img src="{{ url('/images/causes/'.$cause->id.'.'.$cause->file_ext) }}" class="img-fluid" alt="logo">
                                    <hr>
                                    <h5>{{ $cause->title }}</h5>
                                    <ul class="col-12 text-center">
                                        <li class="col-4 p-0">${{ number_format($cause->reports()->lead()->whereBetween('created_at', [\Carbon\Carbon::now()->subDays(7)->toDateTimeString(), \Carbon\Carbon::now()->toDateTimeString()])->sum('rate'), 2) }}<br><span>Past 7 Days</span></li>
                                        <li class="col-3 p-0" style="font-weight: bold; font-size: 14px;">{{ 715 + $cause->reports()->lead()->count() }} <br><span class="mr-1">Donations</span></li>
                                        <li class="col-4 p-0">${{ number_format( 500 + $cause->reports()->lead()->sum('rate'), 2) }} <br><span>Total Raised</span></li>
                                    </ul>
                                    <a href="/causes/{{ $cause->slug }}" class="btn btn-danger btn-red px-5 mb-4">Donate</a>
                                </div>
                            @endforeach

                            <div class="clearfix"></div>
                        </div>
                    @endif
                </div>

            @endforeach
            @if($cond)
                <div class="clearfix"></div>
                    <br>
                <div class="container">
                    <div class="alert alert-danger">No Causes Found!</div>
                </div>
            @endif
        </div>
    </div>









    <div class="fluid-container cause-map py-lg-4 pt-4 pb-0">
        <div class="row d-md-flex flex-lg-row flex-column-reverse">
            <div class="col-lg-7 map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d217758.28861853937!2d74.18611997503385!3d31.48367297842423!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39190483e58107d9%3A0xc23abe6ccc7e2462!2sLahore%2C+Pakistan!5e0!3m2!1sen!2s!4v1495852037792" class="col-12 px-0"></iframe>
            </div>

            <div class="col-lg-4 mx-auto pl-lg-0 pl-4 pb-5 pb-lg-0 pr-5 my-auto">
                <h3>Find Your Nearest</h3>
                <hr>
                <p>Lorem ipsum dolor sit amet, consectetur adipis cing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
                <div class="form-group">
                    <input type="text" class="form-control py-3 pl-3" id="address" placeholder="St. Lake Red 20, New York City">
                </div>
                <div class="form-group col-12 px-0">
                    <select class="py-3 col-12" id="country">
                        <option selected>Choose...</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
@endsection
