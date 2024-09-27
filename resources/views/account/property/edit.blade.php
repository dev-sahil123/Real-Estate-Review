@extends('account.layouts.app')

@section('content')
    <style>
        .remove-file {
            position: absolute;
            top: 0;
            right: 0px;
            background-color: transparent;
            border: none;
            color: #fff;
            font-size: 18px;
            padding: 5px;
            cursor: pointer;
        }
        .ss-arrow{
            display: none !important;
        }
    </style>
    <div class="row">
        <div class="col-md-6">
            <h3 class="mb-3">Property {{ $request->slug ? 'Edit' : 'Add' }}</h3>
            <p>Fill the required (<span class="text-danger">*</span>) fields and click on save button to save it.</p>
        </div>
        <div class="col-md-6">
            <nav class="float-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('account/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Property {{ $request->slug ? 'edit' : 'add' }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form id="add_property_form" action="{{ url('account/property/store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3 mt-5">
                    <div class="col-sm-9 mx-auto">
                        <div class="step1">
                            <div class="mb-4">
                                <label for="name" class="form-label">Property Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" value="{{ $property->name }}" required>
                                <span class="invalid-feedback" role="alert">
                                    <strong>please fill out this field.</strong>
                                </span>
                                <input type="hidden" name="slug" value="{{ $property->slug }}">
                            </div>
                            <div class="mb-4">
                                <div class="row">
                                    <div class="col-md-8">
                                        <label for="address" class="form-label">Property Address<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="address1" name="address" value="{{ $property->address }}" required>
                                        <input type="hidden" name="latitude" value="{{ $property->latitude }}">
                                        <input type="hidden" name="longitude" value="{{ $property->longitude }}">
                                        <span class="invalid-feedback" role="alert">
                                            <strong>please fill out this field.</strong>
                                        </span>
                                        <span class="invalid-feedback address" role="alert">
                                            <strong>please select address from dropdown.</strong>
                                        </span>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Select Suburb</label>
                                        <select name="suburb" class="form-control">
                                            @foreach(getSuburbs() as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Upload Property Image:<span class="text-danger">*</span></label>
                                <input type="file" class="form-control filepond-property-image" name="filepond_image">
                                <input type="hidden" name="property_image_ids">
                                <div class="d-flex flex-wrap property-file">
                                    @forelse ($property->photos as $photo)
                                        <div class="position-relative p-1">
                                            <img src="{{ asset($photo->path) }}" alt="Preview Image" class="rounded-3" width="100" height="100">
                                            <i class="fa-solid fa-circle-xmark remove-file"
                                                onclick="removefile(this, {{ $photo->id }}, 'image')">
                                            </i>
                                        </div>
                                    @empty
                                    @endforelse
                                </div>
                                <button type="button" class="btn btn-primary float-end mt-3 next-step">Next Step</button>
                            </div>
                        </div>
                        <div class="step2 d-none">
                            <div class="mb-5">
                                <label for="rent_move_in" class="form-label">How much was the rent when you moved in (per week)?<span class="text-danger">*</span></label>
                                <input type="number" class="form-control w-50" id="rent_move_in" name="rent_move_in" value="{{ $property->rent_move_in }}" required>
                                <span class="invalid-feedback" role="alert">
                                    <strong>please fill out this field.</strong>
                                </span>
                            </div>
                            <div class="mb-5">
                                <label class="form-label" for="rentIncrease">Did your property’s rent increase?<span class="text-danger">*</span></label>
                                <div class="form-check form-check-inline ps-5">
                                    <input type="radio" class="form-check-input" name="rent_increase" id="rentIncreaseYes" value="1"
                                        {{ $property->rent_increase == '1' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="rentIncreaseYes">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check form-check-inline ps-5">
                                    <input type="radio" class="form-check-input" name="rent_increase"
                                        id="rentIncreaseNo" value="0"
                                        {{ $property->rent_increase == '0' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="rentIncreaseNo">
                                        No
                                    </label>
                                </div>
                            </div>
                            <div id="rentIncreaseDetails" {{ $property->rent_increase != '1' ? 'style="display: none;"' : '' }}  class="mb-5">
                                <div>
                                    <label for="rentIncreaseOpinion" class="form-label">Opinions or details about therent increase:<span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="rentIncreaseOpinion" name="rent_increase_opinion" rows="3"></textarea>
                                </div>
                                <div>
                                    <label class="form-label">Upload files related to rentincrease:</label>
                                    <input type="file" class="form-control rent-increase-file" name="filepond_document">
                                    <input type="hidden" name="rent_increase_file_ids">
                                </div>
                                @forelse ($property->rentIncreaseFiles as $property_file)
                                    <div class="mb-1 option-bg p-3 rounded-3">
                                        <div class="row">
                                            <div class="col-sm-1">
                                                <i class="fa-solid fa-file fs-4"></i>
                                            </div>
                                            <div class="col d-flex justify-content-between">
                                                <a href="{{ url($property_file->path) }}"
                                                    target="_blank">{{ $property_file->name }}</a>
                                                <i class="fa-solid fa-trash-can fs-4 pointer"
                                                    onclick="removefile(this, {{ $property_file->id }}, 'document')"></i>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                @endforelse
                            </div>
                            <div class="mb-5">
                                <label class="form-label">How was the property’s condition (when moving in and throughout the lease)?<span class="text-danger">*</span></label>
                                <span class="invalid-feedback" role="alert">
                                    <strong>please select property condition.</strong>
                                </span>
                                <div class="option-bg px-3 py-2 mb-2 rounded-3">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="property_condition"
                                            id="dangerous" value="0"
                                            {{ $property->property_condition == '0' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="dangerous">
                                            Dangerous/ hazardous
                                        </label>
                                    </div>
                                </div>
                                <div class="option-bg px-3 py-2 mb-2 rounded-3">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="property_condition"
                                            id="heavyDamages" value="1"
                                            {{ $property->property_condition == '1' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="heavyDamages">
                                            Heavy damages/ issues
                                        </label>
                                    </div>
                                </div>
                                <div class="option-bg px-3 py-2 mb-2 rounded-3">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="property_condition"
                                            id="uncomfortableDamages" value="2"
                                            {{ $property->property_condition == '2' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="uncomfortableDamages">
                                            Uncomfortable damages
                                        </label>
                                    </div>
                                </div>
                                <div class="option-bg px-3 py-2 mb-2 rounded-3">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="property_condition"
                                            id="fairCondition" value="3"
                                            {{ $property->property_condition == '3' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="fairCondition">
                                            Fair condition
                                        </label>
                                    </div>
                                </div>
                                <div class="option-bg px-3 py-2 mb-2 rounded-3">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="property_condition"
                                            id="goodCondition" value="4"
                                            {{ $property->property_condition == '4' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="goodCondition">
                                            Good condition
                                        </label>
                                    </div>
                                </div>
                                <div class="option-bg px-3 py-2 mb-2 rounded-3">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="property_condition"
                                            id="perfectCondition" value="5"
                                            {{ $property->property_condition == '5' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="perfectCondition">
                                            Perfect condition
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-5">
                                <label class="form-label">Upload property files (photos or documents):<span class="text-danger">*</span></label>
                                <span class="invalid-feedback" role="alert">
                                    <strong>please upload property file.</strong>
                                </span>
                                <input type="file" class="form-control filepond-property-file"
                                    name="filepond_document" required>
                                <input type="hidden" name="property_file_ids">
                            </div>
                            @forelse ($property->propertyFiles as $property_file)
                                <div class="mb-1 option-bg p-3 rounded-3">
                                    <div class="row">
                                        <div class="col-sm-1">
                                            <i class="fa-solid fa-file fs-4"></i>
                                        </div>
                                        <div class="col d-flex justify-content-between">
                                            <a href="{{ url($property_file->path) }}"
                                                target="_blank">{{ $property_file->name }}</a>
                                            <i class="fa-solid fa-trash-can fs-4 pointer"
                                                onclick="removefile(this, {{ $property_file->id }}, 'document')"></i>
                                        </div>
                                    </div>
                                </div>
                            @empty
                            @endforelse
                            <div class="mb-5">
                                <label class="form-label">How was the relationship with the landlord / real estate agent / real estate agencies?<span class="text-danger">*</span></label>
                                <span class="invalid-feedback" role="alert">
                                    <strong>please select relationship with the landlord.</strong>
                                </span>
                                <div class="option-bg px-3 py-2 mb-2 rounded-3">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="relation_landlord" id="unmanageable" value="0" {{ $property->relation_landlord == '0' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="unmanageable">Unmanageable (no repairs creating a hazard, illegal/ unethical actions etc…)</label>
                                    </div>
                                </div>
                                <div class="option-bg px-3 py-2 mb-2 rounded-3">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="relation_landlord" id="unsatisfactory" value="1" {{ $property->relation_landlord == '1' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="unsatisfactory"> Unsatisfactory (rudeness, no repair creating discomfort, unreachable)</label>
                                    </div>
                                </div>
                                <div class="option-bg px-3 py-2 mb-2 rounded-3">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="relation_landlord" id="passable" value="2" {{ $property->relation_landlord == '2' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="passable">Passable (difficulty reaching them, feeling ignored or dismissed)</label>
                                    </div>
                                </div>
                                <div class="option-bg px-3 py-2 mb-2 rounded-3">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="relation_landlord" id="moderate" value="3" {{ $property->relation_landlord == '3' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="moderate">Moderate (neither good nor bad)</label>
                                    </div>
                                </div>
                                <div class="option-bg px-3 py-2 mb-2 rounded-3">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="relation_landlord"
                                            id="good" value="4"
                                            {{ $property->relation_landlord == '4' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="good">
                                            Good (good, the reasonable tenancy rights being respected)
                                        </label>
                                    </div>
                                </div>
                                <div class="option-bg px-3 py-2 mb-2 rounded-3">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="relation_landlord"
                                            id="excellent" value="5"
                                            {{ $property->relation_landlord == '5' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="excellent">
                                            Excellent (went above and beyond, friendly, flexible etc…)
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-5">
                                <label class="form-label">Upload relation landlord files (photos or documents):<span class="text-danger">*</span></label>
                                <span class="invalid-feedback" role="alert">
                                    <strong>please upload landlord file.</strong>
                                </span>
                                <input type="file" class="form-control filepond-relation-landlord-file" name="filepond_document" required>
                                <input type="hidden" name="relation_landlord_file_ids">
                            </div>
                            @forelse ($property->relationLandlordFiles as $relation_landlord_file)
                                <div class="mb-1 option-bg p-3 rounded-3">
                                    <div class="row">
                                        <div class="col-sm-1">
                                            <i class="fa-solid fa-file fs-4"></i>
                                        </div>
                                        <div class="col d-flex justify-content-between">
                                            <a href="{{ url($relation_landlord_file->path) }}"
                                                target="_blank">{{ $relation_landlord_file->name }}</a>
                                            <i class="fa-solid fa-trash-can fs-4 pointer"
                                                onclick="removefile(this, {{ $relation_landlord_file->id }}, 'document')"></i>
                                        </div>
                                    </div>
                                </div>
                            @empty
                            @endforelse
                            <div class="mb-5">
                                <label class="form-label">Were there any legal issues around the property (in your tenancy or concerning the property directly)?<span class="text-danger">*</span></label>
                                <span class="invalid-feedback" role="alert">
                                    <strong>please choose one option.</strong>
                                </span>
                                <div class="ps-2">
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="legal_issue_property" id="legal" value="1" {{ $property->legal_issue_property == '1' ? 'checked' : '' }} required>
                                        <label class="me-5" for="legal">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="legal_issue_property" id="legal2" value="0" {{ $property->legal_issue_property == '0' ? 'checked' : '' }} required>
                                        <label for="legal2">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-5">
                                <label class="form-label">If yes, were those legal issues managed appropriately by the landlord/real estate agency:<span class="text-danger">*</span></label>
                                <span class="invalid-feedback" role="alert">
                                    <strong>please choose one option.</strong>
                                </span>
                                <div class="ps-2">
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="legal_issue_landlord"
                                            id="legalIssuesYes" value="1"
                                            {{ $property->legal_issue_landlord == '1' ? 'checked' : '' }} required>
                                        <label class="form-check-label me-5" for="legalIssuesYes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="legal_issue_landlord"
                                            id="legalIssuesNo" value="0"
                                            {{ $property->legal_issue_landlord == '0' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="legalIssuesNo">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-5">
                                <button type="button" class="btn btn-primary prev-step">Previous</button>
                                <button type="submit" class="btn btn-primary float-end" id="submit_form">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).on('keydown', 'form input', function(event) {
            if (event.which == 13) {
                event.preventDefault();
                return false;
            }
        });

        $('.next-step').on('click', function() {
            var nameInput = $("input[name='name']");
            var addressInput = $("input[name='address']");
            var latitude = $("input[name=latitude]");
            var longitude = $("input[name=longitude]");
            
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').removeClass('d-inline');

            if(!nameInput.val()) {
                nameInput.focus();
                nameInput.addClass('is-invalid');
                nameInput.next('.invalid-feedback').addClass('d-inline');
            }else if(!addressInput.val()) {
                addressInput.focus();
                addressInput.addClass('is-invalid');
                addressInput.next('.invalid-feedback').addClass('d-inline');
            
            }else if(addressInput && !latitude.val() && !longitude.val()) {
                addressInput.focus();
                addressInput.addClass('is-invalid');
                addressInput.next('.invalid-feedback .address').addClass('d-inline');
            }else {
                $('.step1').addClass('d-none');
                $('.step2').removeClass('d-none');
            }
        });

        $('.prev-step').on('click', function() {
            $('.step1').removeClass('d-none');
            $('.step2').addClass('d-none');
        })

        FilePond.registerPlugin(FilePondPluginImagePreview);
        FilePond.registerPlugin(FilePondPluginFileValidateType);

        const allowMultiple = true;
        const acceptedImageTypes = ['image/*'];
        const acceptedFileTypes = ['image/png', 'image/jpeg', 'application/pdf',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'text/plain',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ];

        const imageFilePond = initializeFilePond('.filepond-property-image', allowMultiple, acceptedImageTypes, '{{ url('image_upload') }}' + '?type=property_image');
        const rentIncreaseFile = initializeFilePond('.rent-increase-file', allowMultiple, acceptedFileTypes, '{{ url('file_upload') }}' + '?type=rent_increase_file');
        const propertyFilePond = initializeFilePond('.filepond-property-file', allowMultiple, acceptedFileTypes, '{{ url('file_upload') }}' + '?type=property_file');
        const relationLandlordFilePond = initializeFilePond('.filepond-relation-landlord-file', allowMultiple, acceptedFileTypes, '{{ url('file_upload') }}' + '?type=relation_landlord_file');

        $("#submit_form").on('click', function (event) {
            event.preventDefault();
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').removeClass('d-inline');
            if (!$("input[name='rent_move_in']").val()) {
                $("input[name='rent_move_in']").focus();
                $("input[name='rent_move_in']").addClass('is-invalid');
                $("input[name='rent_move_in']").next('.invalid-feedback').addClass('d-inline');
            }else if(!$("input[name='rent_increase']").is(":checked")) {
                $("input[name='rent_increase']:first").focus();
                $("input[name='rent_increase']:first").addClass('is-invalid');
            }else if(!$("input[name='property_condition']").is(":checked")) {
                $("input[name='property_condition']:first").focus();
                $("input[name='property_condition']:first").addClass('is-invalid');
            }else if(!$("input[name='relation_landlord']").is(":checked")) {
                $("input[name='relation_landlord']:first").focus();
                $("input[name='relation_landlord']:first").addClass('is-invalid')
            }else if(!$("input[name='legal_issue_property']").is(":checked")) {
                $("input[name='legal_issue_property']:first").focus();
                $("input[name='legal_issue_property']:first").addClass('is-invalid');
            }else if(!$("input[name='legal_issue_landlord']").is(":checked")) {
                $("input[name='legal_issue_landlord']:first").focus();
                $("input[name='legal_issue_landlord']:first").addClass('is-invalid');
            }else {
                var isPropertyImageRequired =
                @if (!$property->firstPhoto)
                    true
                @else
                    false
                @endif ;

                if ($('.property-file').html().trim() === '') {
                    isPropertyImageRequired = true;
                }

                var hasFilesToUpload = (
                    imageFilePond.filePond.getFiles().length > 0 ||
                    propertyFilePond.filePond.getFiles().length > 0 ||
                    relationLandlordFilePond.filePond.getFiles().length > 0
                );

                if (isPropertyImageRequired && !hasFilesToUpload) {
                    showToast('error', 'Please upload a property image.');
                    return;
                }

                Swal.fire({
                    title: 'Please wait',
                    text: 'Uploading files...',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false,
                });

                var fileProcessingPromises = [];
                if (imageFilePond.filePond.getFiles().length > 0) {
                    fileProcessingPromises.push(imageFilePond.filePond.processFiles().then(function() {}));
                }
                if (rentIncreaseFile.filePond.getFiles().length > 0) {
                    fileProcessingPromises.push(rentIncreaseFile.filePond.processFiles().then(function() {}));
                }
                if (propertyFilePond.filePond.getFiles().length > 0) {
                    fileProcessingPromises.push(propertyFilePond.filePond.processFiles().then(function() {}));
                }
                if (relationLandlordFilePond.filePond.getFiles().length > 0) {
                    fileProcessingPromises.push(relationLandlordFilePond.filePond.processFiles().then(function() {}));
                }

                Promise.all(fileProcessingPromises).then(function() {
                    Swal.close();
                    $("input[name='property_image_ids']").val(JSON.stringify(imageFilePond.fileIds));
                    $("input[name='rent_increase_file_ids']").val(JSON.stringify(rentIncreaseFile.fileIds));
                    $("input[name='property_file_ids']").val(JSON.stringify(propertyFilePond.fileIds));
                    $("input[name='relation_landlord_file_ids']").val(JSON.stringify(relationLandlordFilePond.fileIds));

                    $("#add_property_form").submit();
                })
                .catch(function(error) {
                    Swal.fire('Error', 'An error occurred while uploading files.', 'error');
                });
            }
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
            $('input[name=address]').val(address_detail.address1 + ' ' + address_detail.city + ' ' + address_detail.state +' ' + address_detail.postal_code + ' ' + address_detail.country);
            $('input[name=latitude]').val(address_detail.latitude);
            $('input[name=longitude]').val(address_detail.longitude);
        }
        setGoogleAddress('address1', setAddress);
    </script>
@endsection
