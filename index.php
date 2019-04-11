<?php

$json = <<<JSON
[
    {
        "id": 1,
        "text": "Describe the presentation with a single word.",
        "type": "input",
        "placeholder": "Be creative.",
        "answers": []
    },{
        "id": 2,
        "text": "In your own words, what is one thing you would change about the presentation if you could?",
        "type": "textarea",
        "placeholder": "Please be as specific as possible.",
        "answers": []
    },{
        "id": 3,
        "text": "How satisfied were you with the presentation?",
        "type": "select",
        "placeholder": "Please select an item",
        "answers": [
            { 
                "not_satisfied": "Not Satisfied" 
            },
            { 
                "somewhat_satisfied": "Somewhat Satisfied"
            },
            { 
                "very_satisfied": "Very Satisfied"
            }
        ]
    },{
        "id": 4,
        "text": "Besides talk to us, what else did you do at the conference?",
        "type": "checkbox",
        "placeholder": "",
        "answers": [
            { 
                "other_vendors": "I visited other vendors" 
            },
            { 
                "price_quotes": "I requested an explicit quote"
            },
            { 
                "networking": "I did some networking"
            }
        ]
    },{
        "id": 5,
        "text": "Would you recommend Mugo to someone in the industry?",
        "type": "radio",
        "placeholder": "",
        "answers": [
            { 
                "maybe": "I think I might" 
            },
            { 
                "yes": "I think I would"
            },
            { 
                "no": "I don't think very often"
            }
        ]
    }
]
JSON;

$opts = array(
    'currentYear' => date( "Y" ),
    'formUri' => $_SERVER[ 'REQUEST_URI' ],
    'mainHeading' => 'Please take a few moments to fill in our survey!',
    'submittedHeading' => 'Thank you for taking the time to do our survey!',
    'submitButtonText' => 'Submit',
    'subHeading' => 'Some instructions',
    'surveyQuestions' => json_decode( $json, true ),
    'title' => 'Mugo Survey',
);

// if something was posted
if( isset( $_POST[ 'submit' ] ) ) {
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
    // let the rest of the script know we're in submitted mode
    $opts['submittedMode'] = true;
}

include "./templates/page_head.php";
include "./templates/survey.php";
include "./templates/page_tail.php";
