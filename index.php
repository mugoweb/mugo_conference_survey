<?php

$json = <<<JSON
[
    {
        "id": 1,
        "text": "",
        "type": "input",
        "placeholder": "Organization",
        "answers": []
    },{
        "id": 2,
        "text": "What pain points do you have with your current website?",
        "type": "checkbox",
        "placeholder": "",
        "answers": [
            { 
                "outdated": "Design is outdated" 
            },
            { 
                "editorial": "Hard to add or edit content"
            },
            { 
                "developers": "Developers are hard to reach or slow"
            },
            { 
                "functionality": "Missing functionality"
            },
            { 
                "goesdown": "Crashes frequently"
            }
        ]
    },{
        "id": 3,
        "text": "",
        "type": "textarea",
        "placeholder": "Other pain points or comments.",
        "answers": []
    }
]
JSON;

$opts = array(
    'currentYear' => date( "Y" ),
    'formUri' => $_SERVER[ 'REQUEST_URI' ],
    'mainHeading' => 'Website satisfaction survey',
    'submittedHeading' => 'Thank you for taking the time to do our survey!<br>Stay for a bit and chat with us :)',
    'submitButtonText' => 'Submit',
    'subHeading' => 'Please fill in our quick website survey for a chance to win Bose noise-cancelling headphones!',
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
