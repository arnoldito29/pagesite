var messenger = {
    submit: function( form ){
        
        var data = $( form ).serialize();
        $('.input__error').hide();

        $.ajax({
            type: "POST",
            url: APP_URL + '/user/messenger/submit',
            data: data,
            dataType: "json",
            success: function( response ) {

                if ( response.errors.length > 0 ) {

                    for ( key in response.errors ) {

                        $('#' + key ).parent().find('.input__error').show();
                    }
                } else {
                    
                    $('#message').val('');
                    messenger.add( response.data );
                }
            }
        });
    },
    add: function( data ) {
        var text = '<div>' + data.text + '</div>';
        $('#messenger_container').append( text );
    }
}