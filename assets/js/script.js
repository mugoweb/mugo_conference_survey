(function() {
    'use strict';
    window.addEventListener( 'load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName( 'needs-validation' );
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call( forms, function( form ) {
            form.addEventListener( 'submit', function( event ) {
                let formSubmitButton = $( '.form-submit-button' );
                $( formSubmitButton ).attr( 'disabled', true );
                if ( !$( form ).attr( 'data-processed' ) ) {
                    event.preventDefault();
                    event.stopPropagation();
                    // if the form fails validation, display the validation tips
                    if ( form.checkValidity() === false ) {
                        form.classList.add( 'was-validated' );
                        $( formSubmitButton ).attr( 'disabled', false );
                    } else {
                        // otherwise, submit via ajax
                        $.ajax({
                            type: 'post',
                            data: $( form ).serialize() + '&ajax=1',
                            success: function(){
                                // if everything goes well, load the confirmation
                                // page
                                let confirmationPage = '//'
                                    + window.location.hostname
                                    + window.location.pathname.replace(/\/$/, "")
                                    + '/?confirmationMode=1';
                                $( formSubmitButton ).attr( 'disabled', false );
                                window.location.href = confirmationPage;
                            },
                            error: function(jqXHR, textStatus, message){
                                // otherwise, throw an error and enable the button
                                // again
                                alert( 'Something went wrong with this request: ' + JSON.stringify( textStatus ) );
                                $( formSubmitButton ).attr( 'disabled', false );
                            },
                            timeout: 7000 // timeout after 7 seconds
                        });
                    }
                } else {
                    $( formSubmitButton ).attr( 'disabled', false );
                }
            }, false );
        });
    }, false );
})();