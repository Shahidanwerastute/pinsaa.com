$(document).ready(function () {
    if ($('#regForm').length) {
        $('.address-for:first').trigger('click');
        goPrev();
    }
});

function clog(str) {
    console.log(str);
}

function change_language(locale) {
    $.ajax({
        url: change_language_url,
        type: "POST",
        data: {'locale': locale},
        success: function (response) {
            window.location.reload();
        }
    });
}

$(document).on('submit', '.ajax_form', function (e) {
    $form = $(this);
    $.ajax({
        type: $form.attr('method'),
        url: $form.attr('action'),
        data: new FormData(this),
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function () {
            show_loader();
        },
        complete: function () {
            hide_loader();
        },
        success: function (result) {
            if (result.status) {
                $('.login-modal').modal('hide');
                $('.login-modal').find('form').trigger('reset');
                show_success(result.message);
                if (result.data.redirect) {
                    if (result.data.redirect_to) {
                        setTimeout(function () {
                            window.location.href = result.data.redirect_to;
                        }, 1000);
                    } else {
                        setTimeout(function () {
                            window.location.reload();
                        }, 1000);
                    }
                }
            } else {
                show_error(result.message);
            }
        }
    });
});

function show_success(message) {
    $.toast({
        /*heading: 'Success',*/
        text: message,
        position: 'bottom-' + (locale == 'en' ? 'center' : 'center'),
        bgColor: '#5cb85c',
        loader: false,
        hideAfter: 10000,
        /*icon: 'success',*/
        showHideTransition: 'fade',  // It can be plain, fade or slide
        stack: false,
    });
}

function show_error(message) {
    $.toast({
        /*heading: 'Error',*/
        text: message,
        position: 'bottom-' + (locale == 'en' ? 'center' : 'center'),
        bgColor: '#d9534f',
        loader: false,
        hideAfter: 10000,
        /*icon: 'error',*/
        showHideTransition: 'fade',  // It can be plain, fade or slide
        stack: false,
    });
}

function show_info(message) {
    $.toast({
        /*heading: 'Success',*/
        text: message,
        position: 'bottom-' + (locale == 'en' ? 'center' : 'center'),
        bgColor: '#f28f01',
        loader: false,
        hideAfter: 10000,
        /*icon: 'success'*/
        showHideTransition: 'fade',  // It can be plain, fade or slide
        stack: false,
    });
}

$(document).on('click', '.delete_address', function () {
    var address_id = $(this).data('id');
    $.confirm({
        title: (locale == 'en' ? 'Confirm!' : 'يتأكد!'),
        content: (locale == 'en' ? 'Are you sure to delete this address?' : 'هل أنت متأكد من حذف هذا العنوان؟'),
        buttons: {
            confirm: {
                text: (locale == 'en' ? 'Confirm!' : 'يتأكد!'),
                btnClass: 'btn-red',
                action: function () {
                    $.ajax({
                        url: base_url + 'address/delete',
                        type: "POST",
                        dataType: 'JSON',
                        data: {'id': address_id},
                        beforeSend: function () {
                            show_loader();
                        },
                        complete: function () {
                            hide_loader();
                        },
                        success: function (response) {
                            if (response.status) {
                                show_success(response.message);
                                setTimeout(function () {
                                    window.location.reload();
                                }, 1000);
                            } else {
                                show_error(response.message);
                            }
                        }
                    });
                }
            },
            cancel: {
                text: (locale == 'en' ? 'Cancel' : 'يلغي'),
                action: function () {
                }
            },
        }
    });
});

$(document).on('click', '.delete_address_url', function () {
    var address_url_id = $(this).data('id');
    var ele = $(this);
    $.confirm({
        title: (locale == 'en' ? 'Confirm!' : 'يتأكد!'),
        content: (locale == 'en' ? 'Are you sure to delete this address?' : 'هل أنت متأكد من حذف هذا العنوان؟'),
        buttons: {
            confirm: {
                text: (locale == 'en' ? 'Confirm!' : 'يتأكد!'),
                btnClass: 'btn-red',
                action: function () {
                    $.ajax({
                        url: base_url + 'address_url/delete',
                        type: "POST",
                        dataType: 'JSON',
                        data: {'id': address_url_id},
                        beforeSend: function () {
                            show_loader();
                        },
                        complete: function () {
                            hide_loader();
                        },
                        success: function (response) {
                            if (response.status) {
                                show_success(response.message);
                                ele.closest('td').closest('tr').remove();
                            } else {
                                show_error(response.message);
                            }
                        }
                    });
                }
            },
            cancel: {
                text: (locale == 'en' ? 'Cancel' : 'يلغي'),
                action: function () {
                }
            },
        }
    });
});

$(document).on('click', '.copy', function () {
    navigator.clipboard.writeText($(this).data('content'));
    show_info((locale == 'en' ? 'Copied to clipboard!' : 'نسخ إلى الحافظة!'))
});

$(function () {
    $('#preloader').hide();
});

var marker, i;

function init_map() {
    if ($('#map').length) {

        // initializing google map start
        var mapOptions = {
            center: new google.maps.LatLng(map_lat, map_long),
            zoom: 14,
            mapTypeControl: false,
            scaleControl: true,
            streetViewControl: false,

            fullscreenControl: true,
            fullscreenControlOptions: {
                position: (locale == 'ar' ? google.maps.ControlPosition.LEFT_TOP : google.maps.ControlPosition.RIGHT_TOP)
            },

            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.LARGE,
                position: (locale == 'ar' ? google.maps.ControlPosition.LEFT_BOTTOM : google.maps.ControlPosition.RIGHT_BOTTOM)
            },

            mapTypeId: google.maps.MapTypeId.ROADMAP,
            gestureHandling: 'greedy',
        };
        var map = new google.maps.Map(document.getElementById("map"), mapOptions);

        if (is_edit_address) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(map_lat, map_long),
                map: map,
                icon: base_url + 'assets/frontend/images/marker.png'
            });
        }
        // initializing google map end

        // google map click map draw start
        var infoWindow = new google.maps.InfoWindow();
        var geocoder = new google.maps.Geocoder();

        google.maps.event.addListener(map, 'click', function (event) {
            infoWindow.close();
            if (marker) {
                marker.setPosition(event.latLng);
            } else {
                marker = new google.maps.Marker({
                    position: event.latLng,
                    map: map,
                    icon: base_url + 'assets/frontend/images/marker.png'
                });
            }
            $('input[name="latitude"]').val(event.latLng.lat());
            $('input[name="longitude"]').val(event.latLng.lng());

            geocoder.geocode({
                'latLng': event.latLng
            }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {

                        fill_form_with_data_from_google(results[0]);

                        google.maps.event.addListener(marker, 'click', function () {
                            infoWindow.setContent('<div class="map_address_info">' + results[0].formatted_address + '</div>');
                            infoWindow.open(map, marker);
                        });
                    }
                }
            });

        });
        // google map click map draw end

        var address = document.getElementById('map_search');
        var autocomplete = new google.maps.places.Autocomplete(address);
        autocomplete.addListener('place_changed', function () {
            var place = autocomplete.getPlace();
            var place_lat = place.geometry.location.lat();
            var place_lng = place.geometry.location.lng();
            map.setCenter(new google.maps.LatLng(place_lat, place_lng));
            infoWindow.close();
            if (marker) {
                marker.setPosition(new google.maps.LatLng(place_lat, place_lng));
            } else {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(place_lat, place_lng),
                    map: map,
                    icon: base_url + 'assets/frontend/images/marker.png'
                });
            }
            $('input[name="latitude"]').val(place_lat);
            $('input[name="longitude"]').val(place_lng);

            geocoder.geocode({
                'latLng': new google.maps.LatLng(place_lat, place_lng)
            }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {

                        fill_form_with_data_from_google(results[0]);

                        google.maps.event.addListener(marker, 'click', function () {
                            infoWindow.setContent('<div class="map_address_info">' + results[0].formatted_address + '</div>');
                            infoWindow.open(map, marker);
                        });
                    }
                }
            });
        });
    }
}

function fill_form_with_data_from_google(address) {
    $('input[name="address"]').val(address.formatted_address).addClass('is-valid');
    $.each(address.address_components, function (index, value) {
        if (value.types[0] == 'country') {
            $('input[name="country"]').val(value.long_name).addClass('is-valid');
        }
        if (value.types[0] == 'administrative_area_level_1') {
            $('input[name="region"]').val(value.long_name).addClass('is-valid');
        }
        if (value.types[0] == 'locality') {
            $('input[name="city"]').val(value.long_name).addClass('is-valid');
        }
        if (value.types[0] == 'political') {
            $('input[name="district"]').val(value.long_name).addClass('is-valid');
        }
    });
}

function goPrev() {
    $("#prevBtn").css("display", "none");
    $("#nextBtn").show();
    $("#submitBtn").hide();
    $('.step-img').attr('src', base_url + 'assets/frontend/images/step1.png');
    $('.tab:first').addClass('active');
    $('.tab:last').removeClass('active');
}

function goNext() {
    if (validateForm()) {
        $("#prevBtn").css("display", "inline");
        $("#nextBtn").hide();
        $("#submitBtn").show();
        $('.step-img').attr('src', base_url + 'assets/frontend/images/step2.png');
        $('.tab:first').removeClass('active');
        $('.tab:last').addClass('active');
    }
}

function submitForm() {
    if (validateForm()) {
        $('#regForm').submit();
    }
}

function validateForm() {

    var is_valid = true;
    var inputs_text_fields = $('.tab.active').find('input[type="text"].required');
    var inputs_file_fields = $('.tab.active').find('input[type="file"].required');

    inputs_text_fields.each(function (index) {
        $(this).removeClass('is-valid is-invalid');
        if ($(this).val() === '') {
            $(this).addClass('is-invalid');
            is_valid = false;
        } else {
            $(this).addClass('is-valid');
        }
    });

    inputs_file_fields.each(function (index) {
        $(this).siblings('label').removeClass('is-valid is-invalid');
        if ($(this).val() === '') {
            $(this).siblings('label').addClass('is-invalid');
            is_valid = false;
        } else {
            $(this).siblings('label').addClass('is-valid');
        }
    });

    return is_valid;
}

$(document).on('click', '.address-for', function () {
    var address_for = $(this).val();
    if (address_for == 'me') {
        $(".user_detail").each(function (index) {
            if ($(this).data('value')) {
                $(this).val($(this).data('value'));
                $(this).attr('readonly', true);
            }
        });
    } else {
        $(".user_detail").each(function (index) {
            $(this).val('');
            $(this).attr('readonly', false);
        });
    }
    validateForm();
});

$('input[type="file"]').change(function () {
    $(this).siblings('label').text('File Selected: ' + this.files[0].name);
});

$(document).on('click', '.get_address_urls', function () {
    $.ajax({
        url: base_url + 'address_url',
        type: "POST",
        data: {'address_id': $(this).data('id')},
        beforeSend: function () {
            show_loader();
        },
        complete: function () {
            hide_loader();
        },
        success: function (response) {
            $('#addressURLs').find('.modal-body').html(response);
            $('#addressURLs').modal('show');
        }
    });
})

$(document).on('click', '.generate_address_url', function () {
    $.ajax({
        url: base_url + 'address_url/generate',
        type: "POST",
        data: {'address_id': $(this).data('id')},
        beforeSend: function () {
            show_loader();
        },
        complete: function () {
            hide_loader();
        },
        success: function (response) {
            $('#addressURLs').find('.modal-body').html(response);
            $('#addressURLs').modal('show');
        }
    });
})

function show_loader() {
    $('.ajax_loader').css('display', 'flex');
}

function hide_loader() {
    $('.ajax_loader').css('display', 'none');
}

$(document).on('change', '#building_type', function () {
    var building_type = $(this).val();

    $('.field-for-villa').hide();
    $('.field-for-villa').find('input').removeClass('required');
    $('.field-for-villa').find('input').val('');


    $('.field-for-building').hide();
    $('.field-for-building').find('input').removeClass('required');
    $('.field-for-building').find('input').val('');

    $('.field-for-office').hide();
    $('.field-for-office').find('input').removeClass('required');
    $('.field-for-office').find('input').val('');

    $('.field-for-other').hide();
    $('.field-for-other').find('input').removeClass('required');
    $('.field-for-other').find('input').val('');

    if (building_type == 1) {
        $('.field-for-villa').show();
        $('.field-for-villa').find('input').addClass('required');
    } else if (building_type == 2) {
        $('.field-for-building').show();
        $('.field-for-building').find('input').addClass('required');
    } else if (building_type == 3) {
        $('.field-for-office').show();
        $('.field-for-office').find('input').addClass('required');
    } else if (building_type == 4) {
        $('.field-for-other').show();
        $('.field-for-other').find('input').addClass('required');
    }
});

$(document).on('click', '#submitBtn', function () {
    var building_type = $('#building_type').find(":selected").val();
    if (building_type == '') {
        $('#building_type').addClass('required is-invalid');
    } else {
        $('#building_type').removeClass('required is-invalid');
    }
});

/*$(document).on('click', '.share-address', function () {
    ga('send', {
        hitType: 'event',
        eventCategory: 'Address',
        eventAction: 'Share',
        eventLabel: 'Address Shared'
    });
});*/
