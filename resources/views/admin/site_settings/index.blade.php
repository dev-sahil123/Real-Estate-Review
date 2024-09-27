@extends('admin.layouts.app')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3 class="ps-2">Site Settings</h3>
                <p class="text-subtitle text-muted ps-2">Show all the steps</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end pe-3">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Site Settings</li>
                        <li class="breadcrumb-item active" aria-current="page">Steps</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ url('admin/site_setting') }}">
                        @csrf
                        @foreach(range(1, 4) as $stepNumber)
                        <div class="form-group col-md-8 align-items-center">
                            <label for="step{{ $stepNumber }}">Step {{ $stepNumber }}</label>
                            <textarea class="form-control" name="step[step{{ $stepNumber }}]">{{ old("step.step{$stepNumber}", $savedData['step_' . $stepNumber] ?? '') }}</textarea>
                        </div>
                        @endforeach
                        <div class="text-start">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
