@extends('admin.layouts.guest')

@section('content')
<div class="d-flex justify-content-center align-items-center h-100 ">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5 bg-gray border rounded">
                <div class="p-md-5">
                    <h3>Admin Login</h3>
                    <form action="{{ url('admin/login') }}" method="post">
                        @csrf
                        <div class="my-3">
                            <label class="mb-2">Email</label>
                            <input id="email" type="email" class="form-control " name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter email" autofocus>
                        </div>
                        <div class="my-3">
                            <label class="mb-2">Password</label>
                            <input id="password" type="password" class="form-control" name="password" placeholder="Password" required autocomplete="current-password">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
