@extends('layouts.app')

@section('content')

    @if(!$show)
        <div class="container cause-details shadow ">
            <div class="row align-items-center py-4">
                <div class="col text-center"><img src="{{ url('/images/causes/'.$cause->id.'.'.$cause->file_ext) }}" class="img-fluid" alt="logo"></div>
                <div class="col-lg-6 cause-details-text pl-lg-5">
                    <h3>{{ $cause->title }}</h3>
                    <ul class="p-0">
                        <li class="col-lg-5 col-sm-12 pl-0">Past 7 Days <br><span>${{ number_format($cause->reports()->lead()->whereBetween('created_at', [\Carbon\Carbon::now()->subDays(7)->toDateTimeString(), \Carbon\Carbon::now()->toDateTimeString()])->sum('rate'), 2) }}</span></li>
                        <li class="col-lg-5 col-sm-12 pl-0">Total Raised <br><span>${{ number_format(500 + $cause->reports()->lead()->sum('rate'), 2) }}</span></li>
                    </ul>
                    <p>{{ $cause->description }} </p>

                    <div class="social-icons">
                        <a class="btn btn-default" href="https://www.facebook.com/sharer/sharer.php?u={{request()->url()}}">Facebook</a>
                        <a class="btn btn-default twitter-share-button"
                           href="https://twitter.com/intent/tweet?text={{urlencode("Donate to " . $cause->title . " here: " . request()->url())}}">
                            Tweet</a>
                    </div>

                </div>
                <div class="col text-center gr-img">
                    @unless($agent->isMobile())
                        <div id="qrcodedonate"></div>
                        {{--<img src="/img/qr.png" alt="logo"> --}}
                    @endunless
                    <br>
                    <a id="donate" href="{{url('/causes/'.$cause->slug. '/?offers=1#offers')}}" class="btn btn-danger btn-red">Donate</a>
                </div>
            </div>
        </div>
    @else
        @if($agent->isMobile())
            <div class="container mob-pg shadow mx-sm-auto mt-5 mb-5">
                <div class="row align-items-center py-4">
                    <div class="col-12 text-center"><img src="{{ url('/images/causes/'.$cause->id.'.'.$cause->file_ext) }}" class="img-fluid mob-pg-logo" alt="logo"></div>
                    <div class="col cause-details-text pl-lg-5">
                        <h3>{{ $cause->title }}</h3>
                        <ul class="p-0 ">
                            <li class="col-12 px-0">Past 7 Days <br><span>${{ number_format($cause->reports()->lead()->whereBetween('created_at', [\Carbon\Carbon::now()->subDays(7)->toDateTimeString(), \Carbon\Carbon::now()->toDateTimeString()])->sum('rate'), 2) }}</span></li>
                            {{--<li class="col-12 px-0 spon-li">Amount of Donation <br class="li-br-display"> Received <span>$80.00</span></li>--}}
                            <li class="col-12 px-0">Total Raised <br><span>${{ number_format(500 + $cause->reports()->lead()->sum('rate'), 2) }}</span></li>
                        </ul>
                        <p>
                            {{ $cause->description }}
                        </p>

                        <div class="social-icons">
                            <a class="btn btn-default" href="https://www.facebook.com/sharer/sharer.php?u={{request()->url()}}">Facebook</a>
                            <a class="btn btn-default twitter-share-button"
                               href="https://twitter.com/intent/tweet?text={{urlencode("Donate to " . $cause->title . " here: " . request()->url())}}">
                                Tweet</a>
                        </div>
                        <h3>Download an app on mobile</h3>
                        {{--<center><img src="/img/qr2.png" class="img-fluid mob-qr"></center>--}}
                        {{--<h3>Lorem Ipsum Dolor Sit Amet</h3>--}}
                        {{--<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut</p>--}}
                        {{--<a href="#" class="btn btn-danger btn-red">Download</a>--}}

                        <hr style="height: 0;border:1px solid #ebebeb;margin-top: 0.6in; margin-bottom: 0.6in;">


                        <div class="offers">
                            <div class="alert alert-info">Loading offers....</div>
                        </div>
                    </div>
                </div>
            </div>

        @else
            <div class="container cause-details shadow mx-sm-auto">
                <div class="row align-items-center py-4">
                    <div class="col-lg-3 text-center"><img src="{{ url('/images/causes/'.$cause->id.'.'.$cause->file_ext) }}" class="img-fluid" alt="logo"></div>
                    <div class="col cause-details-text pl-lg-5">
                        <h3>{{ $cause->title }}</h3>
                        <ul class="p-0 ">
                            <li class="col-lg-3 col-sm-12 pl-0">Past 7 Days <br><span>${{ number_format($cause->reports()->lead()->whereBetween('created_at', [\Carbon\Carbon::now()->subDays(7)->toDateTimeString(), \Carbon\Carbon::now()->toDateTimeString()])->sum('rate'), 2) }}</span></li>
                            <li class="col-lg-5 col-sm-12 pl-0">Total Raised <br><span>${{ number_format($cause->reports()->lead()->sum('rate'), 2) }}</span></li>
                        </ul>
                        <p>{{ $cause->description }} </p>

                        <div class="social-icons">
                            <a class="btn btn-default" href="https://www.facebook.com/sharer/sharer.php?u={{request()->url()}}">Facebook</a>
                            <a class="btn btn-default twitter-share-button"
                               href="https://twitter.com/intent/tweet?text={{urlencode("Donate to " . $cause->title . " here: " . request()->url())}}">
                                Tweet</a>
                        </div>

                        <div class="offers">
                            <div class="alert alert-info">Loading offers....</div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif

    @if(auth()->check())
        @if(auth()->user()->email == "tevarjohnson@gmail.com" || auth()->user()->email == "abdullahnaseer999@gmail.com")

            <div id="adminqrcode"></div>

        @endif
    @endif
    {{--<div id="cause-details">--}}
        {{--<div class="container">--}}
            {{--<div class="" id="offers" style="{{ $show ? '':'display: none;' }}">--}}
                {{--<h2>Offers</h2>--}}
                {{--<hr>--}}
                {{--<div class="row">--}}
                    {{--<div class="col-md-4">--}}
                        {{--<ul class="nav nav-pills nav-stacked">--}}
                            {{--<li role="presentation" class="{{ (is_null($category_id) || (int) $category_id == 0) ? 'active' : '' }}"><a href="{{url('/causes/red-cross/?offers=1&category_id=0')}}">ALL</a></li>--}}
                            {{--@foreach($categories as $category)--}}
                                {{--<li role="presentation" class="{{ (!is_null($category_id) && (int) $category_id === (int) $category['id']) ? 'active' : '' }}"><a href="{{url('/causes/'.$cause->slug.'/?offers=1&category_id='.$category['id'])}}">{{ $category['name'] }}</a></li>--}}
                            {{--@endforeach--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-8 row offers">--}}

                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="clearfix"></div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

@endsection


@section('scripts')
    <script type="text/javascript" src="{!! asset('/js/qrcode.min.js') !!}"></script>
    <script type="text/javascript">
        var offers;
        var offer;
        var category_id = {!! is_null($category_id) ? 0 : $category_id !!};
        var cause_id = {{$cause->id}};
        var qrcodeurl;
        var qrcode;
        var adminqrcode;
        var mobileqrcode;

        $.getJSON( "{!! env('API_URL').'api/wall/'.env('API_KEY').'/json?incent=1&snapaid=1' !!}", function( data ) {
            var items = [];
            var itemss = [];
            var cond = true;
            console.log(data);
            offers = data.campaigns;
            $.each( data.campaigns, function( key, val ) {
                var min = Math.ceil(4);
                var max = Math.floor(5);

                var num = Math.floor(Math.random() * (max - min)) + min;
                var ratings = Math.floor(Math.random() * (150 - 20) + 20);
                if(num == 4) {
                    itemss.push("<a href=\"{{url('/track/'.$cause->id)}}/"+val.id+"\" class=\"spon-app py-3\" style=\"border:none;\">"
                        + "<div class=\"row align-items-center\">"
                        + "<div class=\"col-lg-2 col-5 text-center\"><img src=\"{{ env('API_URL') . 'campaign/image/' }}" + val.id + "\" class=\"rounded-circle my-auto mx-1\" alt=\"logo\" style=\"width: 100px;\"></div>"
                        + "<div class=\"col spon-app-text\">"
                        + "<h4>" + val.name + "</h4>"
                        + "<i class=\"fa fa-star\" aria-hidden=\"true\"></i><i class=\"fa fa-star\" aria-hidden=\"true\"></i><i class=\"fa fa-star\" aria-hidden=\"true\"></i><i class=\"fa fa-star\" aria-hidden=\"true\"></i><i class=\"fa fa-star\" aria-hidden=\"true\" style=\"color: #ccc;\"></i><span>("+ratings+" Ratings)</span>"
                        + "</div>"
                        + "</div>"
                        + "</a><hr/>");
                } else {
                    itemss.push("<a href=\"{{url('/track/'.$cause->id)}}/"+val.id+"\" class=\"spon-app py-3\" style=\"border:none;\">"
                        + "<div class=\"row align-items-center\">"
                        + "<div class=\"col-lg-2 col-5 text-center\"><img src=\"{{ env('API_URL') . 'campaign/image/' }}" + val.id + "\" class=\"rounded-circle my-auto mx-1\" alt=\"logo\" style=\"width: 100px;\"></div>"
                        + "<div class=\"col spon-app-text\">"
                        + "<h4>" + val.name + "</h4>"
                        + "<i class=\"fa fa-star\" aria-hidden=\"true\"></i><i class=\"fa fa-star\" aria-hidden=\"true\"></i><i class=\"fa fa-star\" aria-hidden=\"true\"></i><i class=\"fa fa-star\" aria-hidden=\"true\"></i><i class=\"fa fa-star\" aria-hidden=\"true\"></i><span>("+ratings+" Ratings)</span>"
                        + "</div>"
                        + "</div>"
                        + "</a><hr/>");
                }

                if(category_id == 0)
                    items.push("<div class=\"col-sm-6 col-md-4 offer\"><div class=\"thumbnail\"> <img src=\"{{ env('API_URL') . 'campaign/image/' }}"+val.id+"\" alt=\"Image of cause: "+val.name+"\"> <div class=\"caption\"> <h3>"+val.name+"</h3> <p>"+val.description+"</p> <p><button class=\"btn btn-primary\" role=\"button\" data-toggle=\"modal\" data-target=\"#myModal\" data-offer-index=\""+key+"\">Download Now</button></p> </div> </div> </div>" );
                else{
                    if(val.category_id == category_id)
                    {
                        items.push("<div class=\"col-sm-6 col-md-4 offer\"><div class=\"thumbnail\"> <img src=\"{{ env('API_URL') . 'campaign/image/' }}"+val.id+"\" alt=\"Image of cause: "+val.name+"\"> <div class=\"caption\"> <h3>"+val.name+"</h3> <p>"+val.description+"</p> <p><button class=\"btn btn-primary\" role=\"button\" data-toggle=\"modal\" data-target=\"#myModal\" data-offer-index=\""+key+"\">Download Now</button></p> </div> </div> </div>" );
                    }
                }
                cond = false;
            });

            if(!cond)
                $( ".offers").html( itemss.join() );
            else
                $( ".offers").html( "<div class=\"alert alert-danger\">No offers to load!</div>");
            //            $( ".offers").html( items.join() );
        });

        $('#donate').on('click', function(){
            $('#donate').hide();
            $('#offers').show();
        });


        @if($show)
            $('html, body').animate({
                scrollTop: $(".offers").offset().top - 200
            }, 2000);
        @endif

        $('#myModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var id = parseInt(button.data('offer-index')); // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            offer = offers[id];
            var modal = $(this);
            modal.find('.modal-title').text(offer.name);
            modal.find('.modal-body .offer-description').text(offer.description);
            modal.find('.modal-body .offer-url').attr('href', "{!! env('APP_URL') !!}/track/"+cause_id+"/"+ offer.id+"/");

            modal.find('.modal-body #qrcode').text("");
            qrcode = new QRCode(document.getElementById("qrcode"), {
                text: "{!! env('APP_URL') !!}/track/"+cause_id+"/"+ offer.id+"/",
                width: 128,
                height: 128,
                colorDark : "#000000",
                colorLight : "#ffffff",
                correctLevel : QRCode.CorrectLevel.H
            });
        });


        qrcodeurl = new QRCode(document.getElementById("qrcodedonate"), {
            text: "{!! url('/causes/' . $cause->slug . '/?offers=1#offers') !!}",
            width: 128,
            height: 128,
            colorDark : "#000000",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.H
        });
        {{--qrcode = new QRCode(document.getElementById("mobileqrcode"), {--}}
            {{--text: "{!! url('/causes/' . $cause->slug) !!}",--}}
            {{--width: 128,--}}
            {{--height: 128,--}}
            {{--colorDark : "#000000",--}}
            {{--colorLight : "#ffffff",--}}
            {{--correctLevel : QRCode.CorrectLevel.H--}}
        {{--});--}}


        @if(auth()->check())
            @if(auth()->user()->email == "tevarjohnson@gmail.com" || auth()->user()->email == "abdullahnaseer999@gmail.com")

        qrcodeurl.clear();
        adminqrcode = new QRCode(document.getElementById("adminqrcode"), {
            text: "{!! url('/causes/' . $cause->slug . '/?offers=1#offers') !!}",
            width: 512,
            height: 512,
            colorDark : "#000000",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.H
        });

            @endif
        @endif


    </script>
@endsection
