@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <h1>Create Cause</h1>
        <hr>
        {{-- Was there an error? --}}
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {!! Form::model($cause, array('url' => '/admin/causes/'.$cause->id, 'method' => 'post', 'enctype' => 'multipart/form-data')) !!}
        {{ method_field('PUT') }}
        <table class="table table-striped table-bordered">
            <tr>
                <td><b>Title:</b></td>
                <td>{!! Form::text('title', null, array('required', 'class' => 'form-control')) !!}</td>
            </tr>
            <tr>
                <td><b>Category:</b></td>
                <td>{!! Form::select('category', $categories, null, array('required', 'class' => 'form-control')) !!}</td>
            </tr>
            <tr>
                <td><b>Description:</b></td>
                <td>{!! Form::textarea('description', null, array('class' => 'form-control')) !!}</td>
            </tr>
            <tr>
                <td>Image:</td>
                <td>
                    {!! Form::file('image') !!}
                </td>
            </tr>
            <tr>
                <td></td>
                <td>{!! Form::submit('Update', array('class' => 'btn btn-primary')) !!}</td>
            </tr>
        </table>
        {!! Form::close() !!}
    </div>
@endsection