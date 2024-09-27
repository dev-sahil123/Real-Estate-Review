    @extends('frontend.layouts.app')

@section('content')
<style>
    a{
        text-decoration: none;
    }
    #autocomplete-city:focus-visible{
		outline: none !important;
	}
</style>
<br>
<br>
<br>
<br>
<br>
<div class="container" style="min-height: 500px">
    <h3 class="second-p text-center">Search Property for Review</h3>
    <form method="get" action="{{ url('property/index') }}">
        <div class="row my-5">
            <div class="col-lg-6 mx-auto">
                <div class="input-group">
                    <input type="text" class="form-control" id="autocomplete-city" placeholder="Search by location name" autocomplete="off" required>
                    <input type="hidden" name="city">
                    <button class="btn btn-purple rounded-end px-5 d-none d-md-block">SEARCH</button>
                    <button class="btn btn-purple d-md-none d-block">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </div>
        </div>
    </form>
    <div class="row mb-4 mx-3">
        @forelse ($properties as $property)
            <div class="col-md-4 mb-4">
                <div class="pointer rounded-2 material-shadow mb-2 h-100" onclick="window.location.href = '{{ url('property/detail/'.$property->slug) }}'">
                    <div class="card-body p-4">
                        <h5>Renter’s Id&nbsp;&nbsp;:&nbsp;&nbsp;<span class="text-primary">{{ strtoupper($property->user->renter_id) }}</span></h5>
						<div class="mt-2 mb-3">
							@for($i = 1; $i <= 5; $i++)
								@if($i <= $property->rating)
									<i class="fa fa-star text-warning me-1"></i>
								@else
									<i class="fa fa-star text-black me-1"></i>
								@endif
							@endfor
							<span class="review-count ms-3">{{ $property_review->rating ?? '0' }} Star</span>
						</div>
                        <p class="card-text justified-text">“<small class="renter-review">{{ Str::limit($property->review, 250, '...') }}</small>”</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center">
                <h6>There is no property review available for this location.</h6>
            </div>
        @endforelse
    </div>
</div>
@endsection

@section('scripts')
<script>
    var options = {
		types: ['(cities)'],
		componentRestrictions: {country: "AU"}
	};
	var autocomplete = new google.maps.places.Autocomplete(
		document.getElementById('autocomplete-city'),
		options
  	);
	autocomplete.addListener('place_changed', function() {
		var city = '';
		var place = autocomplete.getPlace();
		place.address_components.forEach(function(component) {
			if (component.types.includes('locality')) {
				city = component.long_name;
			}
		});
		$('input[name=city]').val(city);
  	});
</script>
@endsection