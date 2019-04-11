<?php

$radioOptions = "";

$radioNo = 1;
foreach ( $question[ 'answers' ] as $answer ) {
    $key = key( $answer );
    $value = $answer[ $key ];
    $radioOptions .= '<div class="custom-control custom-radio">';
    $radioOptions .= '<input type="radio" class="custom-control-input" id="question' . $question[ 'id' ] . '_' . $radioNo . '" value="' . $key . '" name="question' . $question[ 'id' ] . '" value="' . $key . '" aria-labelledby="question' . $question[ 'id' ] . 'Label" required>';
    $radioOptions .= '<label class="custom-control-label" for="question' . $question[ 'id' ] . '_' . $radioNo . '">' . $value . '</label>';
    $radioOptions .= '</div>';
    $radioNo++;
}

echo <<<HTML
<div class="form-group my-5">
    <label class="form-question" id="question{$question[ 'id' ]}Label">{$question[ 'text' ]}</label>
    <fieldset class="form-group">
        $radioOptions
    </fieldset>
</div>
HTML;
