var ride = {

    initMap: function( r_additional ) {

        var additional_ride = document.getElementById('ride_' + r_additional );

        var options = {
            types: ['(cities)']
        };

        var additional_autocomplete = new google.maps.places.Autocomplete( additional_ride, options );

        google.maps.event.addListener( additional_autocomplete, 'place_changed', function() {
            $('#' + r_additional + '_latitude').val( additional_autocomplete.getPlace().geometry.location.lat() );
            $('#' + r_additional + '_longitude').val( additional_autocomplete.getPlace().geometry.location.lng() );
            $('#' + r_additional + '_place').val( additional_autocomplete.getPlace().place_id );
        });

        $('#ride_' + r_additional ).on('blur', function() {
            setTimeout(function() {
                if (!$('#' + r_additional + '_latitude').val() || !$('#' + r_additional + '_longitude').val()) {
                    ride.resetCoordinatesForInput('ride_' + r_additional, r_additional + '_latitude', r_additional + '_longitude', r_additional + '_place');
                }
            }, 200);
        });

        $('#ride_' + r_additional ).on('keyup', function(){
            ride.resetRideData( r_additional );
        });
    },

    resetRideData: function ( type ) {
        $('#' + type + '_latitude').val('');
        $('#' + type + '_longitude').val('');
        $('#' + type + '_place').val('');
    },

    resetCoordinatesForInput: function ( textInputId, latitudeInputId, longitudeInputId, placeIDInputId) {
        var geoCoder = new google.maps.Geocoder();

        geoCoder.geocode( { 'address': $('#'+textInputId).val()}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                $('#' + textInputId).val(results[0].formatted_address);
                $('#' + latitudeInputId).val(results[0].geometry.location.lat());
                $('#' + longitudeInputId).val(results[0].geometry.location.lng());
                $('#' + placeIDInputId).val(results[0].place_id);
            }
        });
    },

    rideSearchSubmit: function ( form ) {

        var data = $( form ).serialize();
        var errors = ride.validateRide();

        if ( errors ) {

            return false;
        }

        ride.rideLoading( 'ride_container', 'ride_loading');

        $.ajax({
            type: "POST",
            url: APP_URL + '/ride/search',
            data: data,
            success: function( response ) {
                $('#ride_container').html( response );
                ride.rideLoading( 'ride_loading', 'ride_container');
            }
        });

        return false;
    },

    rideLoading: function ( from, to ) {

        $('#' + from ).hide();
        $('#' + to ).show();
    },

    validateRide: function () {

        $('.invalid').removeClass( 'invalid' );

        var errors = 0;

        if ( !$( '#ride_from' ).val() && !$( '#ride_to' ).val() ) {

            $( '#ride_from' ).addClass( 'invalid' );
            $( '#ride_to' ).addClass( 'invalid' );
            errors++;
        }

        if ( !$( '#ride_date' ).val() ) {

            $( '#ride_date' ).addClass( 'invalid' );
            errors++;
        }

        return errors;
    },
    
    clickAddRide: function( form ){
        
        //$('.add_ride_step').hide();
        var data = $(form).serialize();
        $('.error').removeClass('error');
        
        $.ajax({
            type: "POST",
            url: APP_URL + '/ride/add/step1',
            data: data,
            success: function( response ) {
                
                if ( response.successful == false ) {

                    for ( key in response.errors ) {

                        $("[name='" + key + "']").addClass('error');
                    }
                } else {

                    $('.add_ride_step_2').html( response.html );
                    $('.add_ride_step_2').show();
                }
            }
        });
        
    }
}

$(function() {
    ride.initMap( 'from' );
    ride.initMap( 'to' );
    
    $('.input__addon-right').click(function(){
        var from = $('#ride_from').val();
        var from_lat = $('#from_latitude').val();
        var from_lng = $('#from_longitude').val();
        var from_place = $('#from_place').val();
        var to = $('#ride_to').val();
        var to_lat = $('#to_latitude').val();
        var to_lng = $('#to_longitude').val();
        var to_place = $('#to_place').val();
        $('#ride_from').val( to );
        $('#from_latitude').val( to_lat );
        $('#from_longitude').val( to_lng );
        $('#from_place').val( to_place );
        $('#ride_to').val( from );
        $('#to_latitude').val( from_lat );
        $('#to_longitude').val( from_lng );
        $('#to_place').val( from_place );
    });
    
    $( '.datepicker' ).datepicker({ dateFormat: 'yy-mm-dd' });
    
    $('.ride_search_buttons').on('click', function(){
        console.log('aaaa');
    });
    
    $('.add_city').on('click', function(){
        
        $('.more_city:hidden').each( function( i, val ){
            var no = $( val ).attr('rel');
            $( val ).show();
            ride.initMap('additional_' + no );
            return false;
        } );
    });
});

function copyToRequest() {
    $('#ride_popup_from').val( $('#ride_from').val() );
    $('#popup_from_latitude').val( $('#from_latitude').val() );
    $('#popup_from_longitude').val( $('#from_longitude').val() );
    $('#popup_from_place').val( $('#from_place').val() );
    
    $('#ride_popup_to').val( $('#ride_to').val() );
    $('#popup_to_latitude').val( $('#to_latitude').val() );
    $('#popup_to_longitude').val( $('#to_longitude').val() );
    $('#popup_to_place').val( $('#to_place').val() );
    
    $('#popup_ride_date').val( $('#ride_date').val() );
    $('#popup_ride_date_to').val( $('#ride_date').val() );
}

function requestFormSubmit( form ) {
    
    var data = $( form ).serialize();
    $('.invalid').removeClass('invalid');
    
    $.ajax({
        type: "POST",
        url: APP_URL + '/requests/submit',
        data: data,
        success: function( response ) {
            
            if ( response.successful == false ) {
                
                for ( key in response.errors ) {
                    
                    $("[name='" + key + "']").addClass('invalid');
                }
            } else {
                
                $( form ).parents('.modal-body').html( response.html );
                $( form ).parents( '.modal-dialog.modal-request-of-a-ride').addClass('modal-successfully-created').removeClass('modal-request-of-a-ride');
            }
        }
    });
}

function submitBookSeat( form ) {
    
    var data = $( form ).serialize();
    $('.invalid').removeClass('invalid');
    
    $.ajax({
        type: "POST",
        url: APP_URL + '/ride/book_seat',
        data: data,
        success: function( response ) {
            
            if ( response.successful == false ) {
                
                for ( key in response.errors ) {
                    
                    $("[name='" + key + "']").addClass('invalid');
                }
            } else {
                
                $('#modalBooking').modal('hide');
            }
        }
    });
}