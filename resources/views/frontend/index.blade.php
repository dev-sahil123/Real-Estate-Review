@extends('frontend.layouts.app')

@section('content')
<style>
	#autocomplete-city:focus-visible{
		outline: none !important;
	}
</style>
<div class="intro">
	<div class="overlay rental-review">
		{!! $site_settings->get('header_text') !!}
		<div class="container">
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
		</div>
	</div>
</div>

<div class="review_section">
	<div class="container">
		<h2 class="text-center my-5">Our latest reviews</h2>
		<div class="owl-carousel owl-theme">
			@foreach ($property_reviews as $property_review)
				<div class="item px-1 px-md-3">
					<div class="bg-body rounded-2 material-shadow pointer" style="height:300px" onclick="window.location.href= '{{ url('property/detail/'.$property_review->slug) }}'">
						<h5 class="card-title">Renter’s Id&nbsp;&nbsp;:&nbsp;&nbsp;<span class="text-color">{{ strtoupper($property_review->user->renter_id) }}</span></h5>
						<div class="ratings mt-2 mb-3">
							@for($i = 1; $i <= 5; $i++)
								@if($i <= $property_review->rating)
									<i class="fa fa-star rating-color me-1"></i>
								@else
									<i class="fa fa-star text-black me-1"></i>
								@endif
							@endfor
							<span class="review-count ms-3">{{ $property_review->rating ?? '0' }} Star</span>
						</div>
						<p class="card-text justified-text">“<small>{{ Str::limit($property_review->review, 250, '...') }}</small>”</p>
					</div>
				</div>
			@endforeach
		</div>
		<div class="text-center pt-3 pb-5">
			<span class="me-5 pointer prev-button">
				<i class="bi bi-arrow-left-circle"></i>
			</span>
			<span class="pointer next-button">
				<i class="bi bi-arrow-right-circle"></i>
			</span>
		</div>
	</div>
</div>

<div class="work_section">
	<div class="overlay container">
		<div class="row"> 
			<div class="col-lg-7 offset-lg-4 fw-medium spanfont">
				<h2 class="my-5">How it Works?</h2>
				@if($site_settings->get('steps'))
					@foreach(json_decode($site_settings->get('steps')) as $step)
						<div class="row mb-4">
							<p class="col-md-10">{{ $step }}</p>
						</div>
					@endforeach
				@endif
				<div class="row my-5 pb-3">
					<div class="col-md col-sm d-flex flex-column flex-sm-row align-items-center">
						<a class="btn btn-outline-primary px-5 py-2 fw-medium rounded-2 mb-3 ml-sm-3 mb-sm-0" href="{{ url('write_a_review/step1') }}">WRITE A REVIEW</a>
						<button class="add_property btn btn-blue px-4 py-2 mx-md-4 border-2 fw-medium rounded-5">ADD YOUR PROPERTY</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="where-section p-3" id="where_section">
	<div class="container justify-content-center">
			<form method="get" action="{{ url('/') }}">
				<div class="row align-items-center">
					<div class="col-md-4">
						<h3 class="text-center text-white py-3">Where you'll be</h3>
					</div>
					<div class="col-md-3">
						<input type="text" class="form-control rounded-5 border-0 fw-bolder ps-3 mb-2 mb-md-0" id="autocomplete-suburb" placeholder="ENTER SUBURB" required>
						<input type="hidden" name="suburb">
					</div>
					<div class="col-md-3">
						<input type="number" class="form-control rounded-5 border-0 fw-bolder ps-5 mb-2 mb-md-0" min="1" max="5" name="rating" placeholder="REVIEW RATING" list="ratings" autocomplete="off">
						<datalist id="ratings">
							<option value="1"></option>
							<option value="2"></option>
							<option value="3"></option>
							<option value="4"></option>
							<option value="5"></option>
					    </datalist>
					</div>
					<div class="col-md-2">
						<button class="btn btn-primary form-control text-center rounded-5 border-0 fw-bolder bg-dark text-white">SEARCH</button>
					</div>
			   </div>
		</form>
	</div>
</div>

<div class="graph_section" id="graph_section">
	<div id="map" style="height: 82vh;" data-scrollwheel="true"></div>
</div>

<div class="footer-section mt-5 mt-md-0">
	<div class="container">
		<div class="row ms-2 ms-md-5">
			@forelse ($footer_menus->groupBy('category_name') as $key => $group)
				<div class="col-md my-3">
					<ul class="list-unstyled">
						<li class="my-3 fs-5 fw-medium">
							{{ ucfirst($key) }}
						</li>
						@foreach ($group as $menu)
							<li class="py-1 {{ $loop->odd ? 'py-1' : '' }}">
								<a href="{{ $menu->link }}" class="text-black">{{ ucfirst($menu->name) }}</a>
							</li>
						@endforeach
					</ul>
				</div>
			@empty
			@endforelse
			<div class="col-md my-3">
				<ul class="list-unstyled">
					<li class="my-3 fs-5 fw-medium">Social Platform</li> 
					<li class="py-1"><i class="bi bi-facebook me-3"></i>
						<a href="https://www.facebook.com/" class="text-black">Facebook</a>
					</li>
					<li><i class="bi bi-twitter me-3"></i>
						<a href="https://twitter.com/login?lang=en" class="text-black">Twitter</a>
					</li>
					<li class="py-1"><i class="bi bi-linkedin me-3"></i>
						<a href="https://in.linkedin.com/?original_referer=https%3A%2F%2Fwww.google.com%2F" class="text-black">Linkedin</a>
					</li>
					<li><i class="bi bi-instagram me-3"></i>
						<a href="https://www.instagram.com/" class="text-black">Instagram</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
$(document).ready(function() {
	@if ($request->suburb)
		const section = document.getElementById("graph_section");
		if (section) {
			section.scrollIntoView({ behavior: "smooth" });
		}	
	@endif
	var $carousel = $('.owl-carousel');
	var itemCount = $carousel.find('.item').length;

	$carousel.owlCarousel({
		items: 3,
		autoplayHoverPause: true,
		loop: itemCount > 3,
		responsive: {
			0: {
				items: 1
			},
			768: {
				items: 2
			},
			992: {
				items: 3
			}
		}
	});
	$('.prev-button').click(function(){
		$carousel.trigger('prev.owl.carousel');
	});
	$('.next-button').click(function(){
		$carousel.trigger('next.owl.carousel');
	});
     
	function initMap() {
		let marker_icon = '{{ asset('assets/images/marker.png') }}';

		map = new google.maps.Map(document.getElementById('map'), {
			center: {lat: parseFloat('{{ $properties->first() ? $properties->first()->latitude : -33.877169 }}'), lng: parseFloat('{{ $properties->first() ? $properties->first()->longitude : 151.208750 }}')},
			zoom: 12,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			streetViewControl : false,
			zoomControl : true,
			fullscreenControl : false,
			mapTypeControlOptions: {
				mapTypeIds: ['roadmap', 'satellite'],
				position: google.maps.ControlPosition.RIGHT_TOP,
				style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR
			},
			styles: [
				{
					"featureType": "all",
					"elementType": "all",
					"stylers": [
						{"saturation": -100},
						{"gamma": 0.5}
					]
				}
			],
		});

		var markers = [];
		@foreach($properties as $property)
			var marker = {
				lat: parseFloat('{{ $property->latitude }}'),
				lng: parseFloat('{{ $property->longitude }}'),
				title: '{{ $property->name }}',
				icon: marker_icon,
				slug: '{{ $property->slug }}'
			};
			markers.push(marker);
		@endforeach
		markers.forEach(function(marker) {
			var googleMarker = new google.maps.Marker({
				position: { lat: marker.lat, lng: marker.lng },
				title: marker.title,
				icon: marker.icon,
				map: map
			});

			googleMarker.addListener('click', function() {
				window.location.href = "{{ url('property/detail/') }}"+'/'+marker.slug;
			});
		});
	}
	initMap();
	function initializeAutocomplete(inputElement, targetInputElement) {
		var options = {
			types: ['(cities)'],
			componentRestrictions: { country: 'AU' },
		};
		var autocomplete = new google.maps.places.Autocomplete(inputElement, options);

		autocomplete.addListener('place_changed', function () {
			let city = '';
			let place = autocomplete.getPlace();
			place.address_components.forEach(function (component) {
				if (component.types.includes('locality')) {
					city = component.long_name;
				}
			});
			$(targetInputElement).val(city);
		});
	}
	initializeAutocomplete(document.getElementById('autocomplete-city'), 'input[name=city]');
	initializeAutocomplete(document.getElementById('autocomplete-suburb'), 'input[name=suburb]');
});
</script>
@endsection