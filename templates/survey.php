<?php

if ( isset( $opts[ 'submittedMode' ] ) ) {
    return;
}

function requireQuestionTemplateToVar( $question, $file ) {
    ob_start();
    require( $file );
    return ob_get_clean();
}

$surveyQuestions = "";

ob_start();
foreach( $opts[ 'surveyQuestions' ] as $question ) {
    switch ( $question[ 'type' ] ) {
        case "input":
            $surveyQuestions .= requireQuestionTemplateToVar( $question, realpath( dirname( __FILE__ ) ) . "/survey_input.php" );
            break;
        case "textarea":
            $surveyQuestions .= requireQuestionTemplateToVar( $question, realpath( dirname( __FILE__ ) ) . "/survey_textarea.php" );
            break;
        case "select":
            $surveyQuestions .= requireQuestionTemplateToVar( $question, realpath( dirname( __FILE__ ) ) . "/survey_select.php" );
            break;
        case "checkbox":
            $surveyQuestions .= requireQuestionTemplateToVar( $question, realpath( dirname( __FILE__ ) ) . "/survey_checkbox.php" );
            break;
        case "radio":
            $surveyQuestions .= requireQuestionTemplateToVar( $question, realpath( dirname( __FILE__ ) ) . "/survey_radio.php" );
            break;
    }
}
ob_get_clean();

echo <<<HTML
<div class="col-12 col-md-8 col-lg-6">
    <form class="survey-form needs-validation" action="{$opts[ 'formUri' ]}" method="post" novalidate>
        <div class="form-group">
            <label class="form-question hidden" for="name">Please provide your name.</label>
            <input type="text" class="form-control" aria-describedby="nameHelp" placeholder="Name" name="name" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Please provide your name.
                </div>
        </div>
        <div class="form-group">
            <label class="form-question hidden" for="email">Please provide a valid email address.</label>
            <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Email" name="email" required>
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Please provide a valid email address.
            </div>
        </div>
        $surveyQuestions
        <div class="spacer-sm"></div>
        <input name="submit" value="true" hidden>
        <div class="row align-items-center">
            <div class="col-12 col-sm-auto mb-3 mb-sm-0">
                <button type="submit" class="btn btn-outline-primary no-background">{$opts[ 'submitButtonText' ]}</button>
            </div>
        </div>
    </form>
</div>
HTML;
