function openModal(action, modal_size = 'modal-lg') {
    $('#empty_modal').find('.modal-dialog').removeClass('modal-md');
    $('#empty_modal').find('.modal-dialog').removeClass('modal-lg');
    $('#empty_modal').find('.modal-dialog').removeClass('modal-xl');
    $('#empty_modal').find('.modal-dialog').addClass(modal_size);

    $('#empty_modal').modal('show');
    $('#empty_modal .modal-content').html('<div class="modal-body p-5"><div id="pre-modal-loader"><div class="lds-ripple"><div></div><div></div></div></div></div>');
    setTimeout(function () {
        $.ajax({
            url: action,
            async: false,
            success: function (response) {
                $('#empty_modal .modal-content').html(response);
            }
        });
    }, 100);
}
function confirmationById(action, content, id, key = 0) {
    $('#confirmation_by_id_modal').find('form').attr('action', action);
    $('#confirmation_by_id_modal').find('.content').html(content);
    $('#confirmation_by_id_modal').find('input[name=id]').val(id);
    $('#confirmation_by_id_modal').find('input[name=key]').val(key);
    $('#confirmation_by_id_modal').modal('show');
}
function infoModal(status = 'success', title, content) {
    if (status == 'error') {
        $('#info_modal').find('.modal-header').addClass('bg-danger');
    } else {
        $('#info_modal').find('.modal-header').removeClass('bg-danger');
    }
    $('#info_modal').find('.modal-title').html(title);
    $('#info_modal').find('.content').html(content);
    $('#info_modal').modal('show');
}
function loaderModal(message) {
    $('#loader_modal').find('.loader-text').text(message);
    $('#loader_modal').modal('show');
}

var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      	toast.addEventListener('mouseenter', Swal.stopTimer)
      	toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})
function showToast(type, message) {
    Toast.fire({
        icon: type,
        title: message
    });
}

function setGoogleAddress(field_id, setAddress) {
    var address_field = document.getElementById(field_id);
    var sydneyBounds = new google.maps.LatLngBounds(
        new google.maps.LatLng(-34.118347, 150.595074),
        new google.maps.LatLng(-33.578463, 151.343020)
    );

    var address_field_google = new google.maps.places.Autocomplete(address_field, {
        bounds: sydneyBounds,
        componentRestrictions: { country: "aus" }
    });
    google.maps.event.addListener(address_field_google, 'place_changed', function () {
        var place = address_field_google.getPlace();
        var address_detail = {
            'address1' : '',
            'address2' : '',
            'city' : '',
            'state' : '',
            'postal_code' : '',
            'country' : '',
        };

        place.address_components.forEach((component, key) => {
            if (component.types[0] == 'street_number') {
                address_detail.address1 += component.long_name;
            }else if (component.types[0] == 'route') {
                address_detail.address1 += ' '+component.long_name;
            }else if (component.types[0] == 'premise') {
                address_detail.address1 += ' '+component.long_name;
            }else if (component.types[0] == 'sublocality_level_2') {
                address_detail.address1 += ' '+component.long_name;
            }else if (component.types[0] == 'sublocality_level_1') {
                address_detail.address1 += ' '+component.long_name;
            }else if (component.types[0] == 'locality') {
                address_detail.city = component.long_name;
            }else if (component.types[0] == 'neighborhood' && address_detail.city == '') {
                address_detail.city = component.long_name;
            }else if (component.types[0] == 'administrative_area_level_1') {
                address_detail.state = component.short_name;
            }else if (component.types[0] == 'country') {
                address_detail.country = component.long_name;
            }else if (component.types[0] == 'postal_code') {
                address_detail.postal_code = component.long_name;
            }
        });
        address_detail.address1 = address_detail.address1.trim();
        address_detail.city = address_detail.city.trim();
        address_detail.state = address_detail.state.trim();
        address_detail.postal_code = address_detail.postal_code.trim();
        address_detail.country = address_detail.country.trim();

        address_detail.latitude = place.geometry.location.lat();
        address_detail.longitude = place.geometry.location.lng();
        address_detail.url = place.url;
        if (place.photos && place.photos[0] && place.photos[0].getUrl()) {
            address_detail.photo = place.photos[0].getUrl();
        }

        setAddress(address_detail);
    });
}

function addFavorite(favorite, property_slug, url, authUrl){
    var csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
    $.ajax({
        url: url,
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': csrf_token,
        },
        data: {
            property_slug: property_slug,
        },
        dataType: 'json',
        success: function(response) {
            $(favorite).find(".fa-solid, .fa-regular").toggleClass("d-none");
            showToast('success', response['1']);
        },
        error: function (response, error) {
            if(response.status == 401){
                window.location.href = authUrl;
            }else{
                showToast('error', response.responseText)
            }
        }
    });
}

function initializeFilePond(selector, allowMultiple, acceptedFileTypes, url) {
    var filepondElement = document.querySelector(selector);
    var csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var fileIds = [];

    var filePond = FilePond.create(filepondElement, {
        allowMultiple: allowMultiple,
        labelIdle: 'Drag & Drop your files or <span class="filepond--label-action">Browse</span>',
        acceptedFileTypes: acceptedFileTypes,
        fileValidateTypeLabelExpectedTypes: 'Expects {allTypes}',
        server: {
            process: {
                url: url,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrf_token
                },
                onload: (response) => {
                    fileIds.push(response);
                },
                onerror: (error) => {
                    console.error('Error:', error);
                }
            }
        },
        instantUpload: false,
        allowRevert: false
    });

    return { filePond, fileIds };
}