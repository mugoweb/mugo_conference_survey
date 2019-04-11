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
            <input type="text" class="form-control" aria-describedby="nameHelp" placeholder="Name" name="name" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABHklEQVQ4EaVTO26DQBD1ohQWaS2lg9JybZ+AK7hNwx2oIoVf4UPQ0Lj1FdKktevIpel8AKNUkDcWMxpgSaIEaTVv3sx7uztiTdu2s/98DywOw3Dued4Who/M2aIx5lZV1aEsy0+qiwHELyi+Ytl0PQ69SxAxkWIA4RMRTdNsKE59juMcuZd6xIAFeZ6fGCdJ8kY4y7KAuTRNGd7jyEBXsdOPE3a0QGPsniOnnYMO67LgSQN9T41F2QGrQRRFCwyzoIF2qyBuKKbcOgPXdVeY9rMWgNsjf9ccYesJhk3f5dYT1HX9gR0LLQR30TnjkUEcx2uIuS4RnI+aj6sJR0AM8AaumPaM/rRehyWhXqbFAA9kh3/8/NvHxAYGAsZ/il8IalkCLBfNVAAAAABJRU5ErkJggg==&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%;" required>
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
        <div class="spacer-sm"></div>
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
