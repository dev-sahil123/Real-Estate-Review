@extends('frontend.layouts.app')

@section('content')
<div id="main">
    <div class="container pt-5">
        <div class="row">
            <h3 class="text-center display-6">Write a Review</h3>
            <div class="col-md-9 mx-auto mt-5">
                <span class="col"><span class="text-danger">*</span> Please fill all required field.</span>
            </div>
            <form action="{{ url('write_a_review/store_step3') }}" method="POST" id="property_form">
                <input type="hidden" name="slug" value="{{ $property->slug }}">
                @csrf
                <div class="col-md-9 mx-auto material-shadow rounded-3 my-3 mb-5 py-4 bg-white">
                    <div class="px-4">
                        <div class="mb-3">
                            <label class="form-label">How was the relationship with the landlord / real estate agent / real estate agencies?<span class="text-danger">*</span></label>
                            <div class="option-bg px-3 py-2 mb-2 rounded-3">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="relation_landlord" id="unmanageable" value="0" {{ $property->relation_landlord == '0' ? 'checked' : '' }} required>
                                    <label class="form-check-label mb-0" for="unmanageable">Unmanageable (no repairs creating a hazard, illegal/ unethical actions etc…)</label>
                                </div>
                            </div>
                            <div class="option-bg px-3 py-2 mb-2 rounded-3">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="relation_landlord" id="unsatisfactory" value="1" {{ $property->relation_landlord == '1' ? 'checked' : '' }} required>
                                    <label class="form-check-label mb-0" for="unsatisfactory"> Unsatisfactory (rudeness, no repair creating discomfort, unreachable)</label>
                                </div>
                            </div>
                            <div class="option-bg px-3 py-2 mb-2 rounded-3">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="relation_landlord" id="passable" value="2" {{ $property->relation_landlord == '2' ? 'checked' : '' }} required>
                                    <label class="form-check-label mb-0" for="passable">Passable (difficulty reaching them, feeling ignored or dismissed)</label>
                                </div>
                            </div>
                            <div class="option-bg px-3 py-2 mb-2 rounded-3">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="relation_landlord" id="moderate" value="3" {{ $property->relation_landlord == '3' ? 'checked' : '' }} required>
                                    <label class="form-check-label mb-0" for="moderate">Moderate (neither good nor bad)</label>
                                </div>
                            </div>
                            <div class="option-bg px-3 py-2 mb-2 rounded-3">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="relation_landlord"
                                        id="good" value="4"
                                        {{ $property->relation_landlord == '4' ? 'checked' : '' }} required>
                                    <label class="form-check-label mb-0" for="good">
                                        Good (good, the reasonable tenancy rights being respected)
                                    </label>
                                </div>
                            </div>
                            <div class="option-bg px-3 py-2 mb-2 rounded-3">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="relation_landlord"
                                        id="excellent" value="5"
                                        {{ $property->relation_landlord == '5' ? 'checked' : '' }} required>
                                    <label class="form-check-label mb-0" for="excellent">
                                        Excellent (went above and beyond, friendly, flexible etc…)
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Opinions or details about relationship with the landlord (optional):</label>
                            <textarea class="form-control" name="relation_landlord_opinion" rows="3">{{ $property->relation_landlord_opinion }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Upload relation landlord files (photos or documents):</label>
                            <input type="file" class="form-control relation-landlord-doc" name="filepond_document">
                        </div>
                        @foreach ($property->relationLandlordDocs as $relation_landlord_doc)
                            <div class="mb-1 option-bg p-3 rounded-3">
                                <div class="row">
                                    <div class="col-sm-1">
                                        <i class="fa-solid fa-file fs-4"></i>
                                    </div>
                                    <div class="col d-flex justify-content-between">
                                        <a href="{{ url($relation_landlord_doc->path) }}" target="_blank">{{ $relation_landlord_doc->name }}</a>
                                        <i class="fa-solid fa-trash-can fs-4 pointer" onclick="removefile(this, {{ $relation_landlord_doc->id }}, 'document')"></i>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <hr class="my-5">
                    <div class="px-4">
                        <div class="mb-3">
                            <label class="form-label">How were the conditions of living in the property?</label>
                            <div class="option-bg px-3 py-2 mb-2 rounded-3">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="property_living_condition" id="property_unmanageable" value="0" {{ $property->property_living_condition == '0' ? 'checked' : '' }} required>
                                    <label class="form-check-label mb-0" for="property_unmanageable">Unmanageable (noises being unbearable, neighbors creating issues far beyond reasonable, problematic street/ neighbourhood that weren’t discussed).</label>
                                </div>
                            </div>
                            <div class="option-bg px-3 py-2 mb-2 rounded-3">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="property_living_condition" id="property_unsatisfactory" value="1" {{ $property->property_living_condition == '1' ? 'checked' : '' }} required>
                                    <label class="form-check-label mb-0" for="property_unsatisfactory">Unsatisfactory (loud noises - from streets or neighbors -, rude neighbors, other issues)</label>
                                </div>
                            </div>
                            <div class="option-bg px-3 py-2 mb-2 rounded-3">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="property_living_condition" id="property_passable" value="2" {{ $property->property_living_condition == '2' ? 'checked' : '' }} required>
                                    <label class="form-check-label mb-0" for="property_passable">Passable (not a good experience overall)</label>
                                </div>
                            </div>
                            <div class="option-bg px-3 py-2 mb-2 rounded-3">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="property_living_condition" id="property_moderate" value="3" {{ $property->property_living_condition == '3' ? 'checked' : '' }} required>
                                    <label class="form-check-label mb-0" for="property_moderate">Moderate (neither good nor bad).</label>
                                </div>
                            </div>
                            <div class="option-bg px-3 py-2 mb-2 rounded-3">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="property_living_condition" id="property_good" value="4" {{ $property->property_living_condition == '4' ? 'checked' : '' }} required>
                                    <label class="form-check-label mb-0" for="property_good">Good (friendly neighbors, good street, good location, quiet, etc…).</label>
                                </div>
                            </div>
                            <div class="option-bg px-3 py-2 mb-2 rounded-3">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="property_living_condition" id="property_excellent" value="5" {{ $property->property_living_condition == '5' ? 'checked' : '' }} required>
                                    <label class="form-check-label mb-0" for="property_excellent">Excellent (would highly recommend living there).</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Opinions or details about property living condition (optional):</label>
                            <textarea class="form-control" name="property_living_condition_opinion" rows="3">{{ $property->relation_landlord_opinion }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Upload relation landlord files (photos or documents):</label>
                            <input type="file" class="form-control property-living-condition-doc" name="filepond_document">
                        </div>
                        @foreach ($property->propertyLivingConditionDocs as $property_living_condition_doc)
                            <div class="mb-1 option-bg p-3 rounded-3">
                                <div class="row">
                                    <div class="col-sm-1">
                                        <i class="fa-solid fa-file fs-4"></i>
                                    </div>
                                    <div class="col d-flex justify-content-between">
                                        <a href="{{ url($property_living_condition_doc->path) }}" target="_blank">{{ $property_living_condition_doc->name }}</a>
                                        <i class="fa-solid fa-trash-can fs-4 pointer" onclick="removefile(this, {{ $property_living_condition_doc->id }}, 'document')"></i>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <hr class="my-5">
                    <div class="px-4">
                        <div class="mb-3">
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
                        <div class="mb-3">
                            <label class="form-label">Opinions or details legal issues around the property (optional):</label>
                            <textarea class="form-control" name="legal_issue_property_opinion" rows="3">{{ $property->legal_issue_property_opinion }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Upload legal issues around the property (photos or documents)</label>
                            <input type="file" class="form-control legal-issue-property-doc" name="filepond_document">
                        </div>
                        @foreach ($property->legalIssuesDocs as $legal_issues_doc)
                            <div class="mb-1 option-bg p-3 rounded-3">
                                <div class="row">
                                    <div class="col-sm-1">
                                        <i class="fa-solid fa-file fs-4"></i>
                                    </div>
                                    <div class="col d-flex justify-content-between">
                                        <a href="{{ url($legal_issues_doc->path) }}" target="_blank">{{ $legal_issues_doc->name }}</a>
                                        <i class="fa-solid fa-trash-can fs-4 pointer" onclick="removefile(this, {{ $legal_issues_doc->id }}, 'document')"></i>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <hr class="my-5">
                    <div class="px-4 mb-5">
                        <div class="mb-3">
                            <label class="form-label">If yes, were those legal issues managed appropriately by the landlord/real estate agency:<span class="text-danger">*</span></label>
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
                                    <label class="form-check-label mb-0" for="legalIssuesNo">No</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Opinions or details about legal issues managed appropriately by the landlord/real estate agency (optional):</label>
                            <textarea class="form-control" name="legal_issue_landlord_opinion" rows="3">{{ $property->legal_issue_landlord_opinion }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Upload legal issues managed appropriately by the landlord/real estate agency files (photos or documents):</label>
                            <input type="file" class="form-control legal-issue-landlord-doc" name="filepond_document">
                        </div>
                        @foreach ($property->legalIssuesLandlordDocs as $legal_issue_landlord_doc)
                            <div class="mb-1 option-bg p-3 rounded-3">
                                <div class="row">
                                    <div class="col-sm-1">
                                        <i class="fa-solid fa-file fs-4"></i>
                                    </div>
                                    <div class="col d-flex justify-content-between">
                                        <a href="{{ url($legal_issue_landlord_doc->path) }}" target="_blank">{{ $legal_issue_landlord_doc->name }}</a>
                                        <i class="fa-solid fa-trash-can fs-4 pointer" onclick="removefile(this, {{ $legal_issue_landlord_doc->id }}, 'document')"></i>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <input type="hidden" name="step" value="3">
                    <div class="d-flex justify-content-between px-4">
                        <a href="{{ url('write_a_review/step2?slug='.$property->slug) }}" class="btn btn-purple">Previous Step</a>
                        <button type="submit" class="btn btn-purple" id="save_property">Submit</button>
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
    const acceptedFileTypes = ['image/png', 'image/jpeg', 'application/pdf',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'text/plain',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    ];

    const relationLandlordFilePond = initializeFilePond('.relation-landlord-doc', allowMultiple, acceptedFileTypes, '{{ url('file_upload') }}' + '?type=relation_landlord_doc' + '&type_id=' + '{{ $property->id }}');
    const propertyLivingConditionFilePond = initializeFilePond('.property-living-condition-doc', allowMultiple, acceptedFileTypes, '{{ url('file_upload') }}' + '?type=property_living_condition_doc' + '&type_id=' + '{{ $property->id }}');
    const legalIssuesPropertyFilePond = initializeFilePond('.legal-issue-property-doc', allowMultiple, acceptedFileTypes, '{{ url('file_upload') }}' + '?type=legal_issues_doc' + '&type_id=' + '{{ $property->id }}');
    const legalIssueLandlordFilePond = initializeFilePond('.legal-issue-landlord-doc', allowMultiple, acceptedFileTypes, '{{ url('file_upload') }}' + '?type=legal_issue_landlord_doc' + '&type_id=' + '{{ $property->id }}');

    $('#property_form').on('submit', function(event){
        event.preventDefault();
        var fileProcessingPromises = [];
        
        if (relationLandlordFilePond.filePond.getFiles().length > 0) {
            fileProcessingPromises.push(relationLandlordFilePond.filePond.processFiles().then(function() {}));
        }
        if (propertyLivingConditionFilePond.filePond.getFiles().length > 0) {
            fileProcessingPromises.push(propertyLivingConditionFilePond.filePond.processFiles().then(function() {}));
        }
        if (legalIssuesPropertyFilePond.filePond.getFiles().length > 0) {
            fileProcessingPromises.push(legalIssuesPropertyFilePond.filePond.processFiles().then(function() {}));
        }
        if (legalIssueLandlordFilePond.filePond.getFiles().length > 0) {
            fileProcessingPromises.push(legalIssueLandlordFilePond.filePond.processFiles().then(function() {}));
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
</script>
@endsection