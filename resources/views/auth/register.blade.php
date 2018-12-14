@extends('layouts.app')

@section('content')
    <div class="container shadow col-lg-7 mx-auto signup-pg px-lg-5">
        <div class="row pt-5">
            <div class="col-lg-6"><h4>Account Details</h4></div>
            <div class="col-lg-6"><p>Have Account? <a href="{{ route('login') }}">Login</a> </p></div>
        </div>
        <hr class="mb-5">
        <div class="row">
            <div class="col-lg-10 mx-auto">

                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $message)
                                <li>{{$message}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register.account') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input type="text" name="firstname" placeholder="Your First Name" value="{{ old('firstname') }}" class="form-control" id="firstname">
                    </div>
                    <div class="form-group">
                        <label for="lastname">Last Name</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Your Last Name" value="{{ old('lastname') }}">
                    </div>

                    <div class="form-group">
                        <label class="col-12 px-0">Gender</label>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="gender" value="Male" @if(old('gender') == "Male") checked @endif> Male
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="gender" value="Female" @if(old('gender') == "Female") checked @endif> Female
                            </label>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" value="{{ old('email') }}">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Your Phone Number" value="{{ old('phone') }}">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Your Password">
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmPassword" name="password_confirmation" placeholder="Confirm Password">
                    </div>
                    <div class="form-group">
                        <label for="dob">Birthday</label>
                        <input type="date" class="form-control" id="dob" name="birthdate" placeholder="mm/dd/yyyy" value="{{ old('birthdate') }}">
                    </div>
                    <button type="submit" class="btn btn-danger btn-red px-lg-5 py-lg-3 my-5">Register </button>
                </form>
            </div>
        </div>
    </div>

@endsection
