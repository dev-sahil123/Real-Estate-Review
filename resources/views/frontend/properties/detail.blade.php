@extends('frontend.layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"/>
<style>
	a{
		text-decoration: none;
	}
	.renter-review span{
		color: #595959;
		font-size: 18px;
		font-style: normal;
		font-weight: 500;
	}
	.renter-review h6{
		margin-bottom: 1rem;
	}
	.renter-review >div{
		margin-bottom: 4rem;
	}
	.wrapper {
		background-color: #ffffff;
		padding: 10px 20px;
		margin-bottom: 20px;
		border-radius: 5px;
		-webkit-box-shadow: 0 2px 5px rgba(0, 0, 50, 0.2);
		box-shadow: 0 2px 5px rgba(0, 0, 50, 0.2);
	}

	.toggle,
	.content {
		font-family: "Poppins", sans-serif;
	}
	.toggle {
		width: 100%;
		background-color: transparent;
		display: -webkit-box;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-align: center;
		-ms-flex-align: center;
		align-items: center;
		-webkit-box-pack: justify;
		-ms-flex-pack: justify;
		justify-content: space-between;
		font-size: 16px;
		color: #111130;
		font-weight: 600;
		border: none;
		outline: none;
		cursor: pointer;
		padding: 10px 0;
	}
	.content {
		position: relative;
		font-size: 14px;
		text-align: justify;
		line-height: 30px;
		height: 0;
		overflow: hidden;
		-webkit-transition: all 1s;
		-o-transition: all 1s;
		transition: all 1s;
	}
	.property-images{
		overflow: hidden;
		height: 450px;
	}
	.property-images img {
		max-height: 100%;
		width: 100%;
		object-fit: cover;
	}
</style>

<div class="container" style="padding-top: 115px">
	<div class="d-flex justify-content-between mb-4">
		<h3>{{ ucfirst( $property->name) }}</h3>
		<div>
			<button class="btn btn-light me-2" onclick="copyUrl('{{ url('property/detail/'.$property->slug) }}')"><i class="fa-solid fa-share-from-square"></i> Share</button>
		</div>
	</div>
    <div class="position-relative">
        @if($property->photos->count() > 2)
            <div class="position-absolute bottom-0 end-0">
                <button type="button" id="triger_images" class="btn btn-light mb-2">View all images</button>
            </div>
        @endif
        @if($property->photos->count() == 1)
			<div class="text-center bg-secondary property-images rounded-4">
				<a data-fancybox="gallery" href="{{ asset($property->firstPhoto->path) }}">
					<img src="{{ asset($property->firstPhoto->path) }}">
				</a>
			</div>
        @elseif($property->photos->count() >= 2)
            <div class="row">
                @foreach ($property->photos->take(2) as $photo)
                    <div class="col-md-6 pe-md-0 property-images">
                        <a data-fancybox="gallery" href="{{ asset($photo->path) }}">
                            <img src="{{ asset($photo->path) }}" class="{{ $loop->index == 0 ? 'rounded-start' : 'rounded-end d-none d-md-inline' }}" height="100%">
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    <div style="display:none">
        @foreach ($property->photos->slice(2) as $photo)
            <a data-fancybox="gallery" href="{{ asset($photo->path) }}">
                <img src="{{ asset($photo->path) }}" class="img-fluid" alt="Image">
            </a>
        @endforeach
    </div>
	<div class="mt-4 mb-5 d-flex flex-wrap justify-content-between">
		<div>
			<h4 class="fw-light">{{ $property->address }}</h4>
			<div class="me-3">
				<a href="#" class="text-dark">
					@for($i = 1; $i <= $property->rating; $i++)
						<i class="fa fa-star rating-color me-1"></i>
					@endfor
					{{ $property->rating }} Ratings
				</a>
			</div>
		</div>
		<div>
			<h4>${{ $property->rent_move_in }} <small class="fw-lighter fst-italic">per week</small></h4>
		</div>
	</div>
	<div class="mb-5 justified-text">
		<i class="fa-solid fa-quote-left fs-5 me-2"></i>{{$property->review}}<i class="fa-solid fa-quote-right fs-5 ms-2"></i>
	</div>
	<div class="my-5 renter-review">
		<h2 class="fs-1">Frequently Asked Question</h2>
		<span>Below are all the questions and answers, to the renter's experience who lived in this property.</span>
		<br>
		<br>
		<br>
		<div class="box-accordion">
			<div class="wrapper">
				<button class="toggle">How much was the rent when renter moved in (per week)?<i class="fas fa-plus icon"></i></button>
				<div class="content">
					<p>Total rent par week : ${{ $property->rent_move_in }}.</p>
				</div>
			</div>
			<div class="wrapper">
				<button class="toggle">Did renter property’s rent increase?<i class="fas fa-plus icon"></i></button>
				<div class="content">
					<p>{{ $property->rent_increase ? 'Yes' : 'No' }}{{ $property->rent_increase_opinion ? ', '.$property->rent_increase_opinion : '' }}</p>
				</div>
			</div>
			<div class="wrapper">
				<button class="toggle">How was the property’s condition (when moving in and throughout the lease)?<i class="fas fa-plus icon"></i></button>
				<div class="content">
					<p>{{ $property->property_condition_label }}{{ $property->property_condition_opinion ? ', '.$property->property_condition_opinion : '' }}</p>
				</div>
			</div>
			<div class="wrapper">
				<button class="toggle">How was the relationship with the landlord / real estate agent / real estate agencies?<i class="fas fa-plus icon"></i></button>
				<div class="content">
					<p>{{ $property->relation_landlord_label}}{{ $property->relation_landlord_opinion ? ', '.$property->relation_landlord_opinion : '' }}</p>
				</div>
			</div>
			<div class="wrapper">
				<button class="toggle">How were the conditions of living in the property?<i class="fas fa-plus icon"></i></button>
				<div class="content">
					<p>{{ $property->property_living_condition_label}}{{ $property->property_living_condition_opinion ? ', '.$property->property_living_condition_opinion : '' }}</p>
				</div>
			</div>
			<div class="wrapper">
				<button class="toggle">Were there any legal issues around the property (in renter tenancy or concerning the property directly)?<i class="fas fa-plus icon"></i></button>
				<div class="content">
					<p>{{ $property->legal_issue_property ? 'Yes' : 'No' }}{{ $property->legal_issue_property_opinion ? ', '.$property->legal_issue_property_opinion : '' }}</p>
				</div>
			</div>
			<div class="wrapper">
				<button class="toggle">If yes, were those legal issues managed appropriately by the landlord/real estate agency:<i class="fas fa-plus icon"></i></button>
				<div class="content">
					<p>{{ $property->legal_issue_landlord == '1' ? 'Yes' : 'No' }}{{ $property->legal_issue_landlord_opinion ? ', '.$property->legal_issue_landlord_opinion : '' }}</p>
				</div>
			</div>
		</div>	
	</div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script>  
	let toggles = document.getElementsByClassName("toggle");
	let contentDiv = document.getElementsByClassName("content");
	let icons = document.getElementsByClassName("icon");

	if (toggles.length > 0) {
		contentDiv[0].style.height = contentDiv[0].scrollHeight + "px";
		toggles[0].style.color = "#0084e9";
		icons[0].classList.remove("fa-plus");
		icons[0].classList.add("fa-minus");
	}

	for (let i = 0; i < toggles.length; i++) {
		toggles[i].addEventListener("click", () => {
			if (parseInt(contentDiv[i].style.height) != contentDiv[i].scrollHeight) {
				contentDiv[i].style.height = contentDiv[i].scrollHeight + "px";
				toggles[i].style.color = "#0084e9";
				icons[i].classList.remove("fa-plus");
				icons[i].classList.add("fa-minus");
			} else {
				contentDiv[i].style.height = "0px";
				toggles[i].style.color = "#111130";
				icons[i].classList.remove("fa-minus");
				icons[i].classList.add("fa-plus");
			}
		});
	}

	Fancybox.bind("[data-fancybox]", {
		Thumbs: {
			type: "classic",
		},
	});

	$("#triger_images").on('click', function() {
		const fancyboxInstances = document.querySelectorAll('[data-fancybox="gallery"]');
		if (fancyboxInstances.length > 0) {
			fancyboxInstances[0].click();
		}
	});

	function copyUrl(url) {
		const tempInput = document.createElement("input");
		tempInput.value = url;
		console.log(tempInput);
		document.body.appendChild(tempInput);
		tempInput.select();
		document.execCommand("copy");
		document.body.removeChild(tempInput);

		Swal.fire("URL Copied!", "", "success");
		document.body.style.removeProperty("padding-right");
	}

</script>
@endsection