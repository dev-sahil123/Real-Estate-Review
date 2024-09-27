@extends('frontend.layouts.app')

@section('content')
<div id="main">
	<div class="container pt-5">
		<div class="row">
			<h3 class="text-center display-6">Write a Review</h3>
			<div class="col-md-9 mx-auto mt-5">
				<span class="col"><span class="text-danger">*</span> Please fill all required field.</span>
			</div>
			<form action="{{ url('write_a_review/store_step2') }}" method="POST" id="property_form">
				@csrf
				<input type="hidden" name="slug" value="{{ $property->slug }}">
				<div class="col-md-9 mx-auto material-shadow rounded-3 mt-3 mb-5 py-4 bg-white">
					<div class="px-4">
						<div class="mb-3">
							<label for="name" class="form-label">Property Name<span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="name" value="{{ $property->name }}" required>
						</div>
						<div class="mb-3">
							<div class="row">
								<div class="col-md-8">
									<label for="address" class="form-label">Property Address<span class="text-danger">*</span></label>
									<input type="text" class="form-control" id="address1" name="address" value="{{ $property->address }}" required>
									<input type="hidden" name="latitude" value="{{ $property->latitude }}">
									<input type="hidden" name="longitude" value="{{ $property->longitude }}">
									<input type="hidden" name="rating">
									<span class="invalid-feedback" role="alert">
										<strong>please fill out this field.</strong>
									</span>
									<span class="invalid-feedback address" role="alert">
										<strong>please select address from dropdown.</strong>
									</span>
								</div>
								<div class="col-md-4">
									<label class="form-label">Enter suburb<span class="text-danger">*</span></label>
									<input type="text" class="form-control" name="suburb" value="{{ $property->suburb }}" id="autocomplete-city" placeholder="select city" autocomplete="off" required>
								</div>
							</div>
						</div>
						<div class="mb-3">
							<div class="row">
								<div class="col-md-8">
									<label class="form-label">Review<span class="text-danger">*</span></label>
									<textarea class="form-control" name="review" rows="3" required>{{ $property->review }}</textarea>
								</div>
								<div class="col-md-4">
									<div class="row">
										<label class="form-label">Rating<span class="text-danger">*</span></label>
										<ul class="list-unstyled mb-3 d-flex rating fs-4" data-mdb-toggle="rating">
											<li>
												<i class="fa fa-star rating-color" title="Bad"></i>
											</li>
											<li>
												<i class="fa fa-star" title="Poor"></i>
											</li>
											<li>
												<i class="fa fa-star" title="OK"></i>
											</li>
											<li>
												<i class="fa fa-star" title="Good"></i>
											</li>
											<li>
												<i class="fa fa-star" title="Excellent"></i>
											</li>
										</ul>
									</div> 
								</div>
							</div>
						</div>
						<div class="mb-3">
							<label class="form-label">Upload Property Image:<span class="text-danger">*</span></label>
							<input type="file" class="form-control filepond-property-image" name="filepond_image">
							<input type="hidden" name="property_image_ids">
							<div class="d-flex flex-wrap property-file">
								@foreach ($property->photos as $photo)
									<div class="position-relative p-1">
										<img src="{{ asset($photo->path) }}" alt="Preview Image" class="rounded-3" width="100" height="100">
										<i class="fa-solid fa-circle-xmark remove-file"
											onclick="removefile(this, {{ $photo->id }}, 'image')">
										</i>
									</div>
								@endforeach
							</div>
						</div>
					</div>
					<hr class="my-5">
					<div class="px-4">
						<label>Please upload a lease and/ or payment receipts to prove you have lived in the property.<span class="text-danger">*</span></label>
						<input type="file" name="filepond_document" class="property-live-proof-doc">
						<div class="property-live-proof-div">
							@foreach ($property->propertyLiveProofDocs as $property_live_proof_doc)
								<div class="mb-1 option-bg p-3 rounded-3">
									<div class="row">
										<div class="col-sm-1">
											<i class="fa-solid fa-file fs-4"></i>
										</div>
										<div class="col d-flex justify-content-between">
											<a href="{{ url($property_live_proof_doc->path) }}" target="_blank">{{ $property_live_proof_doc->name }}</a>
											<i class="fa-solid fa-trash-can fs-4 pointer" onclick="removefile(this, {{ $property_live_proof_doc->id }}, 'document')"></i>
										</div>
									</div>
								</div>
							@endforeach
						</div>
					</div>
					<hr class="my-5">
					<div class="px-4">
						<label for="rent_move_in" class="form-label">How much was the rent when you moved in (per week)?<span class="text-danger">*</span></label>
						<input type="number" class="form-control w-50" id="rent_move_in" name="rent_move_in" value="{{ $property->rent_move_in }}" required>
					</div>
					<hr class="my-5">
					<div class="px-4">
						<div class="mb-3">
							<label class="form-label" for="rentIncrease">Did your property’s rent increase?<span class="text-danger">*</span></label>
							<div class="form-check form-check-inline ps-5">
								<input type="radio" class="form-check-input" name="rent_increase" id="rentIncreaseYes" value="1" {{ $property->rent_increase == '1' ? 'checked' : '' }} required>
								<label class="form-check-label mb-0" for="rentIncreaseYes">Yes</label>
							</div>
							<div class="form-check form-check-inline ps-5">
								<input type="radio" class="form-check-input" name="rent_increase" id="rentIncreaseNo" value="0" {{ $property->rent_increase == '0' ? 'checked' : '' }} required>
								<label class="form-check-label mb-0" for="rentIncreaseNo">No</label>
							</div>
						</div>
						<div id="rentIncreaseDetails">
							<div class="mb-3">
								<label for="rentIncreaseOpinion" class="form-label">Opinions or details about the rent increase (optional):</label>
								<textarea class="form-control" id="rentIncreaseOpinion" name="rent_increase_opinion" rows="3"></textarea>
							</div>
							<div>
								<label class="form-label">Upload files related to rent increase:</label>
								<input type="file" class="form-control rent-increase-doc" name="filepond_document">
							</div>
							@foreach ($property->rentIncreaseDocs as $rent_increase_doc)
								<div class="mb-1 option-bg p-3 rounded-3">
									<div class="row">
										<div class="col-sm-1">
											<i class="fa-solid fa-file fs-4"></i>
										</div>
										<div class="col d-flex justify-content-between">
											<a href="{{ url($rent_increase_doc->path) }}" target="_blank">{{ $rent_increase_doc->name }}</a>
											<i class="fa-solid fa-trash-can fs-4 pointer" onclick="removefile(this, {{ $rent_increase_doc->id }}, 'document')"></i>
										</div>
									</div>
								</div>
							@endforeach
						</div>
					</div>
					<hr class="my-5">
					<div class="px-4">
						<label class="form-label">How was the property’s condition (when moving in and throughout the lease)?<span class="text-danger">*</span></label>
						<div>
							<div class="option-bg px-3 py-2 mb-2 rounded-3">
								<div class="form-check">
									<input type="radio" class="form-check-input" name="property_condition" id="dangerous" value="0"  {{ $property->property_condition == '0' ? 'checked' : '' }} required>
									<label class="form-check-label mb-0" for="dangerous">Dangerous/ hazardous</label>
								</div>
							</div>
							<div class="option-bg px-3 py-2 mb-2 rounded-3">
								<div class="form-check">
									<input type="radio" class="form-check-input" name="property_condition" id="heavyDamages" value="1" {{ $property->property_condition == '1' ? 'checked' : '' }} required>
									<label class="form-check-label mb-0" for="heavyDamages"> Heavy damages/ issues</label>
								</div>
							</div>
							<div class="option-bg px-3 py-2 mb-2 rounded-3">
								<div class="form-check">
									<input type="radio" class="form-check-input" name="property_condition" id="uncomfortableDamages" value="2" {{ $property->property_condition == '2' ? 'checked' : '' }} required>
									<label class="form-check-label mb-0" for="uncomfortableDamages"> Uncomfortable damages </label>
								</div>
							</div>
							<div class="option-bg px-3 py-2 mb-2 rounded-3">
								<div class="form-check">
									<input type="radio" class="form-check-input" name="property_condition"id="fairCondition" value="3"{{ $property->property_condition == '3' ? 'checked' : '' }} required>
									<label class="form-check-label mb-0" for="fairCondition">  Fair condition</label>
								</div>
							</div>
							<div class="option-bg px-3 py-2 mb-2 rounded-3">
								<div class="form-check">
									<input type="radio" class="form-check-input" name="property_condition" id="goodCondition" value="4" {{ $property->property_condition == '4' ? 'checked' : '' }} required>
									<label class="form-check-label mb-0" for="goodCondition"> Good condition</label>
								</div>
							</div>
							<div class="option-bg px-3 py-2 mb-2 rounded-3">
								<div class="form-check">
									<input type="radio" class="form-check-input" name="property_condition" id="perfectCondition" value="5" {{ $property->property_condition == '5' ? 'checked' : '' }} required>
									<label class="form-check-label mb-0" for="perfectCondition">Perfect condition</label>
								</div>
							</div>
						</div>
						<div class="my-3">
							<label>Opinions or details about the property’s condition</label>
							<textarea name="property_condition_opinion" cols="30" rows="3" class="form-control">{{ $property->property_condition_opinion }}</textarea>
						</div>
						<div class="my-3">
							<label class="form-label">Upload property files (photos or documents):</label>
							<input type="file" name="filepond_document" class="property-doc">
						</div>
						@forelse ($property->propertyDocs as $property_docs)
							<div class="mb-1 option-bg p-3 rounded-3">
								<div class="row">
									<div class="col-sm-1">
										<i class="fa-solid fa-file fs-4"></i>
									</div>
									<div class="col d-flex justify-content-between">
										<a href="{{ url($property_docs->path) }}" target="_blank">{{ $property_docs->name }}</a>
										<i class="fa-solid fa-trash-can fs-4 pointer" onclick="removefile(this, {{ $property_docs->id }}, 'document')"></i>
									</div>
								</div>
							</div>
						@empty
						@endforelse
					</div>
					<input type="hidden" name="step" value="2">
					<div class="d-flex justify-content-end px-4">
						<button class="btn btn-purple" id="save_property">Save & Next</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script>
	 
	FilePond.registerPlugin(FilePondPluginImagePreview);
	FilePond.registerPlugin(FilePondPluginFileValidateType);

	const allowMultiple = true;
	const acceptedImageTypes = ['image/*'];
	const acceptedFileTypes = ['image/png', 'image/jpeg', 'application/pdf',
		'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'text/plain',
		'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
	];
	const imageFilePond = initializeFilePond('.filepond-property-image', allowMultiple, acceptedImageTypes, '{{ url('image_upload') }}' + '?type=property_image'+ '&type_id=' + '{{ $property->id }}');
	const propertyProofFilePond = initializeFilePond('.property-live-proof-doc', allowMultiple, acceptedFileTypes, '{{ url('file_upload') }}' + '?type=property_live_proof_doc' + '&type_id=' + '{{ $property->id }}');
	const rentIncreaseFile = initializeFilePond('.rent-increase-doc', allowMultiple, acceptedFileTypes, '{{ url('file_upload') }}' + '?type=rent_increase_doc' + '&type_id=' + '{{ $property->id }}');
	const propertyFilePond = initializeFilePond('.property-doc', allowMultiple, acceptedFileTypes, '{{ url('file_upload') }}' + '?type=property_doc' + '&type_id=' + '{{ $property->id }}');

	$('#save_property').on('click', function(){
		if (propertyProofFilePond.filePond.getFiles().length == 0 && $('.property-live-proof-div').html().trim() === '') {
			event.preventDefault();
			showToast('error', 'Please upload lease/ Proof of payment')
		}
	});
	$('#property_form').on('submit', function(event){
		event.preventDefault();
		var fileProcessingPromises = [];
		if (imageFilePond.filePond.getFiles().length > 0) {
			fileProcessingPromises.push(imageFilePond.filePond.processFiles().then(function() {}));
		}
		if (propertyProofFilePond.filePond.getFiles().length > 0) {
			fileProcessingPromises.push(propertyProofFilePond.filePond.processFiles().then(function() {}));
		}

		Swal.fire({
			title: 'Please wait',
			text: 'Uploading files...',
			allowOutsideClick: false,
			allowEscapeKey: false,
			showConfirmButton: false,
		});

		Promise.all(fileProcessingPromises).then(function() {
			Swal.close();
			$('#property_form')[0].submit();
		});
	});

	function removefile(element, id, type) {
		var url = null;
		var confirmationMessage = "";

		if (type == 'image') {
			url = "{{ url('image_delete') }}";
			confirmationMessage = "Are you sure you want to delete this image?";
		} else {
			url = "{{ url('file_delete') }}";
			confirmationMessage = "Are you sure you want to delete this document?";
		}
			Swal.fire({
				title: confirmationMessage,
				text: "You won't be able to revert this!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
				if (result.isConfirmed) {
				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					method: "POST",
					url: url,
					data: {
						id: id,
					},
					success: function(response) {
						if (type == 'image') {
							$(element).parent().remove();
							showToast('success', 'Image removed successfully');
						} else {
							$(element).parent().parent().parent().remove();
							showToast('success', 'Document removed successfully');
						}
					}
				});
			}
		});
	}

	function setAddress(address_detail) {
		$('input[name=address]').val(address_detail.address1 + ' ' + address_detail.city + ' ' + address_detail.state +' ' + address_detail.postal_code);
		$('input[name=latitude]').val(address_detail.latitude);
		$('input[name=longitude]').val(address_detail.longitude);
		$('input[name=suburb]').val(address_detail.city);
	}
	setGoogleAddress('address1', setAddress);

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
		$('input[name=suburb]').val(city);
	});



	const stars = document.querySelectorAll('.rating i');
	@if($property->id)
	    let selectedRating = {{ $property->rating ?? 1 }};
	    highlightStars(selectedRating - 1);
	@else
	    let selectedRating = 1;
	@endif
	
	stars.forEach((star, index) => {
		star.addEventListener('mouseover', () => {
			highlightStars(index);
		});
		star.addEventListener('mouseout', () => {
			if (selectedRating === null) {
				removeHighlight();
				toggleRating(index);
			} else {
				highlightStars(selectedRating - 1);
				toggleRating(index);
			}
		});
		star.addEventListener('click', () => {
			toggleRating(index);
		});
	});

	function highlightStars(index) {
		for (let i = 0; i <= index; i++) {
			stars[i].classList.add('rating-color');
		}
		for (let i = index + 1; i < stars.length; i++) {
			stars[i].classList.remove('rating-color');
		}
	}

	function removeHighlight() {
		stars.forEach((star) => {
			star.classList.remove('rating-color');
		});
	}


	function toggleRating(index) {
		console.log(index);
		if (selectedRating === index + 1) {
			selectedRating = 1;
		} else {
			selectedRating = index + 1;
			$('input[name=rating]').val(selectedRating)
		}
	}
</script>

@endsection