@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        Below are all causes that were created. To create a new one, <a href="{!! url('/admin/causes/create') !!}">click here</a>.<br /><br />
        <table class="table reports">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Total Donations</th>
                <th>Last 7 days Donations</th>
                <th>Actions</th>
            </tr>
            @if($causes->isEmpty())
                <tr>
                    <td colspan="6" style="text-align: center;">There are no causes created.</td>
                </tr>
            @else
                @foreach($causes as $cause)
                    <tr>
                        <td>{!! $cause->id !!}</td>
                        <td>{!! $cause->title !!}</td>
                        <td>{!! $cause->category->title !!}</td>
                        <td>${{ number_format($cause->reports()->lead()->sum('rate'), 2) }}</td>
                        <td>${{ number_format($cause->reports()->lead()->whereBetween('created_at', [\Carbon\Carbon::now()->subDays(7)->toDateTimeString(), \Carbon\Carbon::now()->toDateTimeString()])->sum('rate'), 2) }}</td>
                        <td>
                            <a href="{!! url('/admin/causes/'.$cause->id.'/edit') !!}" class="btn btn-default">Edit</a>
                            {{--<a href="{!! url('/admin/causes/'.$p->id.'/delete') !!}" class="btn btn-danger">Delete</a>--}}
                        </td>
                    </tr>
                @endforeach
            @endif
        </table>
    </div>
@endsection