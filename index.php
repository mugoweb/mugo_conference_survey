<?php

$json = <<<JSON
[
    {
        "id": 1,
        "text": "",
        "type": "input",
        "placeholder": "Phone",
        "answers": []
    },{
        "id": 2,
        "text": "",
        "type": "input",
        "placeholder": "Organization",
        "answers": []
    },{
        "id": 3,
        "text": "Do you love your website?",
        "type": "checkbox",
        "placeholder": "",
        "answers": [
            { 
                "yes": "Yes" 
            },
            { 
                "no": "No"
            }
        ]
    },{
        "id": 4,
        "text": "Is the content easy to manage?",
        "type": "checkbox",
        "placeholder": "",
        "answers": [
            { 
                "yes": "Yes" 
            },
            { 
                "sort_of": "Sort of"
            },
            {
                "no": "No"
            }
        ]
    },{
        "id": 5,
        "text": "Is the website flexible enough to do everything required?",
        "type": "checkbox",
        "placeholder": "",
        "answers": [
            { 
                "yes": "Yes" 
            },
            {
                "no": "No"
            }
        ]
    },{
        "id": 6,
        "text": "Do your patrons like your website?",
        "type": "checkbox",
        "placeholder": "",
        "answers": [
            { 
                "yes": "Yes" 
            },
            {
                "no": "No"
            }
        ]
    },{
        "id": 7,
        "text": "Does your website have all of these features?",
        "type": "checkbox",
        "placeholder": "",
        "answers": [
            { 
                "mobile": "Mobile-friendly" 
            },
            { 
                "eventreg": "Event registration, including wait lists and payment processing" 
            },
            {
                "roombookings": "Room bookings, including cancellations"
            },
            {
                "languages": "Multiple languages"
            },
            {
                "openinghours": "Dynamic display of opening hours"
            },
            {
                "search": "Catalog and resource search"
            }
        ]
    },{
        "id": 8,
        "text": "Is your library part of a library system, and if so, does each branch get its own website?",
        "type": "input",
        "placeholder": "",
        "answers": []
    },{
        "id": 300,
        "text": "",
        "type": "textarea",
        "placeholder": "Other comments.",
        "answers": []
    }
]
JSON;

$pageUriWithoutGetParams = parse_url( $_SERVER[ "REQUEST_URI" ], PHP_URL_PATH );

$opts = array(
    'currentYear' => date( "Y" ),
    'formUri' => $pageUriWithoutGetParams,
    'mainHeading' => 'Website satisfaction survey',
    'submittedHeading' => 'Thank you for taking the time to do our survey!<br>Stay for a bit and chat with us :)<br><br><br><br><a class="btn btn-outline-primary no-background" href="'
        . $pageUriWithoutGetParams
        . '">Start again</a>',
    'submitButtonText' => 'Submit',
    'subHeading' => 'Please fill in our quick website survey for a chance to win Bose noise-cancelling headphones!',
    'surveyQuestions' => json_decode( $json, true ),
    'title' => 'Mugo Survey',
);

// if something was posted
if( isset( $_POST[ 'submit' ] ) ) {
    // if the form was submitted via AJAX
    // (NOTE: AJAX submission requires manually appending an 'ajax' form field -- the HTML form does NOT have an input
    // named 'ajax' so a regular submit which doesn't inject this value will never be processed)
    if ( $_POST[ 'ajax' ] ) {
        // filter the posted values
        $post = array(
            'name' => filter_var( $_POST[ 'name' ], FILTER_SANITIZE_STRING ),
            'email' => filter_var( $_POST[ 'email' ], FILTER_SANITIZE_EMAIL ),
        );
        for ( $x = 1; $x <= sizeof( $opts[ 'surveyQuestions' ] ); $x++ ) {
            if ( is_array($_POST[ 'question' . $x ] ) ) {
                $post[ 'question' . $x ] = json_encode( $_POST[ 'question' . $x ] );
            } else {
                $post[ 'question' . $x ] = filter_var( $_POST[ 'question' . $x ], FILTER_SANITIZE_ENCODED );
            }
        }
        // store the posted values
        file_put_contents('survey.log', json_encode( $post ).PHP_EOL , FILE_APPEND | LOCK_EX );
        // exit without producing any HTML output
        exit;
    }
}

// if we're in confirmation mode, let the rest of the scripts know
if ( isset( $_GET[ 'confirmationMode' ] ) ) {
    $opts[ 'confirmationMode' ] = true;
}

include "./templates/page_head.php";
include "./templates/survey.php";
include "./templates/page_tail.php";
