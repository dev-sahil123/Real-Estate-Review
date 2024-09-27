@extends('admin.layouts.app')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3 class="ps-2">Basic</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end pe-3">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Site Settings</li>
                        <li class="breadcrumb-item active" aria-current="page">Basic</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ url('admin/site_setting/basic_information_store') }}">
                        @csrf
                        <div class="form-group col-md-8">
                            <label>Support Mail Id :</label>
                            <input type="email" class="form-control" name="support_email" value="{{ isset($support_email) ? $support_email : ' '}}" required>
                        </div>
                        <div class="form-group col-md-8">
                            <label>Privacy & Security link :</label>
                            <input type="url" class="form-control" name="privacy_security_link" value="{{ isset($privacy_security_link) ? $privacy_security_link : ' '}}" required>
                            <button type="submit" class="btn btn-primary float-end mt-4">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
