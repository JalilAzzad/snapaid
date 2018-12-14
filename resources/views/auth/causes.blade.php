@extends('layouts.app')

@section('content')
    <div class="container join-pg">
        <div class="row">
            <div class="col text-center">
                <h2>Select Causes to Support</h2>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-12">
                <form class="text-center" role="form" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}
                    <div class="input-group py-2 pl-2 col-lg-6 mx-auto mb-3">
                        <span class="input-group-addon"><i class="fa fa-search fa-fw"></i></span>
                        <select class="form-control"  id="causes" name="causes[]" multiple="multiple">
                            @foreach($categories as $category)
                                <optgroup label="{{ $category->title }}">
                                    @foreach($category->causes as $cause)
                                        <option value="{{ $cause->id }}">{{ $cause->title }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>


                    <div class="checkable-pics2 col-lg-9 mx-auto text-center pt-5">
                        @foreach($featured_causes as $cause)
                            <img class="checkable2" src="{{ url('/images/causes/'.$cause->id.'.'.$cause->file_ext) }}" alt="logo">
                        @endforeach
                    </div>

                    @if ($errors->has('cause'))
                        <div class="alert alert-danger">
                            {{ $errors->first('cause') }}
                        </div>
                    @endif

                    <input type="submit" name="submit" value="Continue" class="btn btn-danger btn-red px-4 mt-4 mb-5">

                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        $("#causes").select2({
            placeholder: "Select causes",
            allowClear: false
        });$("#featured_causes").select2({
            placeholder: "Select featured causes",
            allowClear: false
        });
    </script>
@endsection