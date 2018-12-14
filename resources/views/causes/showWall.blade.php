<html>
    <head>
        <title>Donate to {{$cause->title}}</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body class="page">
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <a href="#" class="thumbnail">
                        <img src="{{ url('/images/causes/'.$cause->id.'.'.$cause->file_ext) }}" alt="Cause Logo">
                    </a>
                </div>
                <div class="col-md-8">
                    <h1>{{ $cause->title }}</h1>
                    <hr>
                    <p>Amount Raised: ${{ number_format($cause->reports()->lead()->sum('rate'), 2) }}</p>
                    <p>{{ $cause->description }}</p>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="" id="offers">
                <h2>Offers</h2>
                <hr>
                <div class="row offers">
                    {{--@foreach($offers as $key => $offer)--}}
                    {{--<div class="col-sm-6 col-md-4 offer">--}}
                    {{--<div class="thumbnail">--}}
                    {{--<img src="{{ env('API_URL') . 'campaign/image/' . $offer['id'] }}" alt="{{ $offer['name'] . " Image" }}">--}}
                    {{--<div class="caption">--}}
                    {{--<h3>{{$offer['name']}}</h3>--}}
                    {{--<p>{{$offer['description']}}</p>--}}
                    {{--<p><button class="btn btn-primary" role="button" data-toggle="modal" data-target="#myModal" data-offer-index="{{$key}}">Download Now</button></p>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--@endforeach--}}
                </div>

                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                            </div>
                            <div class="modal-body">
                                <div class="offer-description"></div>
                                <a class="offer-url" href="">Download directly</a>
                                <div id="qrcode"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/qrcode.min.js') }}"></script>
    <script type="text/javascript">
        var offers;
        var offer;
        var cause_id = {{$cause->id}};
        var qrcode;

        $.getJSON( "{!! env('API_URL').'api/wall/'.env('API_KEY').'/json?incent=1&mobile=1&snapaid=1' !!}", function( data ) {
            var items = [];
            console.log(data);
            offers = data.campaigns;
            $.each( data.campaigns, function( key, val ) {
                items.push("<div class=\"col-sm-6 col-md-4 offer\"><div class=\"thumbnail\"> <img src=\"{{ env('API_URL') . 'campaign/image/' }}"+val.id+"\" alt=\"Image of cause: "+val.name+"\"> <div class=\"caption\"> <h3>"+val.name+"</h3> <p>"+val.description+"</p> <p><button class=\"btn btn-primary\" role=\"button\" data-toggle=\"modal\" data-target=\"#myModal\" data-offer-index=\""+key+"\">Download Now</button></p> </div> </div> </div>" );
            });

            $( ".offers").html( items.join() );
        });

        $('#donate').on('click', function(){
            $('#donate').hide();
            $('#offers').show();
        });
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


    </script>
    </body>
</html>
