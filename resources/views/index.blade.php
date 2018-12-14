@extends('layouts.app')

@section('content')

    <div class="container how">
        <div class="row text-center">
            <div class="col">
                <h3><strong>How does Snap Aid Work ?</strong></h3>
                <hr>
            </div>
        </div>

        <div class="row justify-content-center" style="padding-top: 1.403in;">
            <div class="col-lg-4 col-md-12">
                <div class="row">
                    <div class="col-lg-12 col-md-6 text-center">
                        <img class="img-fluid" src="/img/step1.png" alt="step1">
                    </div>
                    <div class="col-lg-12 col-md-6 d-flex justify-content-center">
                        <div class="step1-text ">
                            <h2>Join</h2>
                            <p>Join to SnapAid Right Now</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12 ">
                <div class="row">
                    <div class="col-lg-12 col-md-6 text-center">
                        <img class="img-fluid" src="/img/step2.png" alt="step2">
                    </div>
                    <div class="col-lg-12 col-md-6 d-flex justify-content-center">
                        <div class="step2-text">
                            <h2>Select</h2>
                            <p>Select Causes You Support</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12">
                <div class="row ">
                    <div class="col-lg-12 col-md-6 text-center">
                        <img class="img-fluid" src="/img/step3.png" alt="step3">
                    </div>
                    <div class="col-lg-12 col-md-6 d-flex justify-content-center">
                        <div class="step3-text">
                            <h2>Donate</h2>
                            <p>You Can Donate By Joining a Website, Downloading Apps And Shopping</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>








    <div class="fluid-container shot">
        <div class="container" style="z-index: 1;">
            <div class="row text-center">
                <div class="col" style="padding-bottom: 0.8in;">
                    <h3><strong>Give It A Shoot</strong></h3>
                    <hr>
                </div>
            </div>

            <div class="row d-flex">
                <div class="col-lg-3 text-center"  style="z-index: 1;"><img src="/img/mob.png" class="mob-pic" alt="mob" style="max-width: 350px;"></div>
                <div class="col-lg-8 mob-des ">

                    <div class="row align-items-center" style="padding-top: 0.5in;">
                        <div class="col-3 text-center"><img src="/img/red.png" class="img-fluid rounded-circle" alt="child"></div>
                        <div class="col-7 ">
                            <h4><strong>Donate to Redcross</strong></h4>
                            <span>
                                Total Raised: $
                                @if ((\App\Cause::where('id', 1)->first()) !== null)
                                {{ number_format(500 + \App\Cause::where('id', 1)->first()->reports()->lead()->sum('rate'), 2) }}
                                @endif
                            </span>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>

                    <p>The American Red Cross (ARC), also known as the American National Red Cross is a humanitarian organization that provides emergency assistance, disaster relief and education in the United States. Donate by scanning the code to the left with Snapchat or your favorite QR Code scanner.</p>

                </div>
            </div>
        </div>
    </div>




    <div class="fluid-container app">
        <div class="container">



            <div class="row justify-content-between d-md-flex flex-lg-row flex-column-reverse">
                <div class="col-lg-5 ">

                    <div class="app-card inactive-app-card ">
                        <div class="row align-items-center">
                            <div class="col-4 text-center col-sm-3"><img src="/img/coc.png" class="rounded-circle" alt="logo"></div>
                            <div class="col">
                                <h3>Clash Royale</h3>
                                {{--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>--}}
                            </div>
                        </div>
                    </div>


                    <div class="app-card">
                        <div class="row align-items-center">
                            <div class="col-4 text-center col-sm-3"><img src="/img/gr.png" class="rounded-circle" alt="logo"></div>
                            <div class="col">
                                <h3>Let's Get Rich</h3>
                                {{--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>--}}
                            </div>
                        </div>
                    </div>


                    <div class="app-card inactive-app-card">
                        <div class="row align-items-center">
                            <div class="col-4 text-center col-sm-3"><img src="/img/ab.png" class="rounded-circle" alt="logo"></div>
                            <div class="col">
                                <h3>Angry Bird</h3>
                                {{--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>--}}
                            </div>
                        </div>
                    </div>


                </div>


                <div class="col-lg-7 app-text align-self-center col-md-12">
                    <h3><span>$2</span> Donated Via A Free App Download Can Give <span>18 Meals</span> To Hungry Children's And Families.</h3>
                </div>
            </div>

        </div>
    </div>




    <div class="container sponsor">
        <div class="row">
            <div class="col text-center">
                <img src="/img/logo1.png" alt="logo1" class="img-fluid">
                <img src="/img/logo2.png" alt="logo2" class="img-fluid">
                <img src="/img/logo3.png" alt="logo3" class="img-fluid">
                <img src="/img/logo4.png" alt="logo4" class="img-fluid">
                <img src="/img/logo5.png" alt="logo5" class="img-fluid">
            </div>
        </div>
    </div>

@endsection
