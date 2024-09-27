@extends('frontend.layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center h-100 ">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5 bg-gray border rounded  mt-8">
                <div class="p-md-5">
                    <h3>Login</h3>
                    <form action="{{ route('login') }}" method="post">
                        <input type="hidden" name="source" value="{{ $request->source }}">
                        @csrf
                        <div class="my-3">
                            <label class="mb-2">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="my-3">
                            <label class="mb-2">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                    <div class="row my-3">
                        <div class="col-md-6">
                            <input type="checkbox" class="form-check-input" name="" id="remember">
                            <label for="remember">Remember me</label>
                        </div>
                        <div class="col-md-6 ">
                            <a href="{{ url('register') }}" class="float-end">Sign Up</a>
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="{{ url('password/reset') }}">Forgot password</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection