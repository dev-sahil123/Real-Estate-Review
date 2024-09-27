@extends('frontend.layouts.app')

@section('content')
<div id="main">
    <div class="container pt-5">
        <div class="row">
            <h3 class="text-center display-6">Write a Review</h3>
            <div class="col-md-9 mx-auto mt-5">
                <span class="col">Please read all terms & conditions carefully.</span>
            </div>
            <form action="{{ url('write_a_review/store_step1') }}" method="POST">
                @csrf
                <div class="col-md-9 mx-auto material-shadow rounded-3 p-4 bg-white mt-3 mb-5">
                    <div class="mb-4">
                        Your name and lease will not be published on the review or website.
                    </div>
                    <div class="mb-4">
                        Your lease or supporting documents only serves as authentification to ensure the reviews are made in truth.
                    </div>
                    <div class="mb-4">
                        Our administrators are bound by legal privacy and hold the right to accept/ deny a review. If you encounter some issues with your review, please contact our support team on our email <a href="mailto:{{ $support_email }}">{{ $support_email }}</a>.
                    </div>
                    <div class="mb-4">
                        We recommend reviewing your property at the end of after your lease to ensure <a href="{{ $privacy_security_link }}" target="_blank">privacy and safety</a>. 
                    </div>
                    <input type="hidden" name="step" value="1">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-purple">Agree and Continue</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection