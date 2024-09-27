@extends('account.layouts.app')

@section('content')
<div class="row g-0">
    <div class="col-md-6">
        <h3 class="mb-3">Dashboard</h3>
    </div>
</div>
<!-- Add the tab navigation -->
<ul class="nav nav-tabs border-bottom-0" id="myTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ request()->tab =='profile' ? 'active' : '' }}" id="tab1" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true" onclick="changeUrl('profile')">Profile</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ request()->tab =='properties' ? 'active' : '' }}" id="tab2" data-bs-toggle="tab" href="#property" role="tab" aria-controls="property" aria-selected="false" onclick="changeUrl('properties')">Properties</a>
    </li>
</ul>
<div class="card border-0 material-shadow">
    <div class="card-body">
        <div class="tab-content">
            <div class="tab-pane fade show {{ request()->tab =='profile' ? 'show active' : '' }}" id="profile" role="tabpanel" aria-labelledby="tab1">
                <div class="row my-5">
                    <div class="col-md-7 mx-auto">
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <label class="form-label col-sm-3">Name:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name" value="{{ auth()->user()->name }}" required>
                                </div>  
                            </div>
                            <div class="row mb-3">
                                <label class="form-label col-sm-3">Email:</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}" autocomplete="off" required>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{'*'.$errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="form-label col-sm-3">Password:</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" name="password" autocomplete="off">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="form-label col-sm-3">Contact:</label>
                                <div class="col-sm-9">
                                    <input type="tel" class="form-control" name="contact_no" value="{{ auth()->user()->contact_no }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="form-label col-sm-3">City:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="city" value="{{ auth()->user()->city }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="form-label col-sm-3">Country:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="country" value="{{ auth()->user()->country }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-purple float-end">Submit</button>
                                </div>
                            </div>        
                        </form>
                    </div>
                </div>
            </div>   
            <div class="tab-pane fade {{ request()->tab =='properties' ? 'show active' : '' }}" id="property" role="tabpanel" aria-labelledby="tab2">
                <div class="row">
                    @forelse ($properties as $property)
                        <div class="col-md-4 mb-4">
                            <div class="d-flex flex-column p-4 rounded-2 material-shadow pointer h-100" onclick="window.location.href = '{{ url('property/detail/'.$property->slug) }}'">
                                <div>
                                    <h5>Renter’s Id&nbsp;&nbsp;:&nbsp;&nbsp;<span class="text-primary">{{ strtoupper(auth()->user()->renter_id) }}</span></h5>
                                    <div class="mt-2 mb-3">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $property->rating)
                                                <i class="fa fa-star text-warning me-1"></i>
                                            @else
                                                <i class="fa fa-star text-black me-1"></i>
                                            @endif
                                        @endfor
                                        <span class="review-count ms-3">{{ $property->rating ?? '0' }} Star</span>
                                    </div>
                                    <p class="justified-text">“<small class="renter-review">{{ Str::limit($property->review, 250, '...') }}</small>”</p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    @if($property->step == 3)
                                        <a href="{{ url('property/detail/'.$property->slug) }}" class="btn btn-purple more-detail">More Details</a>
                                    @else
                                        <a href="{{ url('write_a_review/step2?slug='.$property->slug) }}" class="btn btn-danger">Pending</a>
                                    @endif
                                    <a href="{{ url('write_a_review/step2?slug='.$property->slug) }}" class="btn btn-secondary" data-toggle="modal" data-target="#editProperty{{ $property->id }}">Edit</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <h6>There is no property review available.</h6>
                    @endforelse
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function changeUrl(tab) {
        var queryParams = new URLSearchParams(window.location.search);
        queryParams.set("tab", tab);
        history.replaceState(null, null, "?" + queryParams.toString());
    }
</script>
@endsection