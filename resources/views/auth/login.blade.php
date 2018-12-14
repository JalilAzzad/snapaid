@extends('layouts.app')

@section('content')
    <div class="fluid-container loggin-top">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <h1 class="mb-5">Login Your Account</h1>
                    <p>Sign in so you can begin donating</p>
                </div>
            </div>
        </div>
    </div>


    <div class="container col-lg-6 login-form shadow px-lg-5 mx-auto col-11">
        <div class="row px-lg-5">
            <div class="col px-lg-4">

                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $message)
                                <li>{{$message}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" value="{{ old('email') }}">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Your Password">
                    </div>

                    <div class="form-group col-12 px-0">
                        <div class="form-check col-5 px-0">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="remember" value="1" id="rememberme">
                                Remember Me
                            </label>
                        </div>
                        <a href="{{ url('/password/reset') }}" class="text-right px-0 float-right">Forgot Passsword ?</a>
                    </div>
                    <button type="submit" class="btn btn-danger btn-red px-5 mb-5 mt-4">Login</button>

                </form>
            </div>
        </div>
    </div>
@endsection