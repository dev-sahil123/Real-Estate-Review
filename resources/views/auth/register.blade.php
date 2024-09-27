@extends('frontend.layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center w-100 h-100">
    <div class="container">
        <div class="row row justify-content-center ">
            <div class="col-md-7 col-lg-5 border bg-white rounded-3 mt-8">
                <div class="p-md-5">
                    <h3>Sign Up</h3>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="my-3">
                            <label for="name">Name</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Enter name" required autocomplete="name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="my-3">
                            <label class="mb-2">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter email" required autocomplete="email">
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
                        <div class="my-3">
                            <label for="password-confirm">Confirm Password</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm password" required autocomplete="new-password">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Signup</button>
                    </form>
                    <div class="text-center mt-3">
                        <span>Already a member? <a href="{{ url('login') }}">Sign in</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
