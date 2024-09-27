<style>
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
</style>
<div class="modal-header">
    <h3>Property Detail</h3>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="mb-5">
        <h4 class="mb-3">Renter lease and/ or payment receipts to prove who lived in the property.</h4>
        <div class="property-live-proof-div">
            @forelse ($property->propertyLiveProofDocs as $property_live_proof_doc)
                <div class="mb-1 option-bg p-3 rounded-3">
                    <div class="row">
                        <div class="col-sm-1">
                            <i class="fa-solid fa-file fs-4"></i>
                        </div>
                        <div class="col d-flex justify-content-between">
                            <a href="{{ url($property_live_proof_doc->path) }}" target="_blank">{{ $property_live_proof_doc->name }}</a>
                            <div>
                                <a href="{{ url($property_live_proof_doc->path) }}" class="me-2" download><i class="fa-solid fa-file-arrow-down fs-4"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <span class="fs-5 text-center">The renter has not uploaded any documents.</span>
            @endforelse
        </div>
    </div>
    <div class="mb-5 renter-review">
		<h4 class="mb-3">Below are all the questions and answers, to the renter's experience who lived in this property.</h4>
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
<div class="modal-footer">
</div>

<script>
    var toggles = document.getElementsByClassName("toggle");
	var contentDiv = document.getElementsByClassName("content");
	var icons = document.getElementsByClassName("icon");

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
</script>