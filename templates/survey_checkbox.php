<?php

$checkboxes = "";

$checkboxNo = 1;
foreach ( $question[ 'answers' ] as $answer ) {
    $key = key( $answer );
    $value = $answer[ $key ];
    $checkboxes .= '<div class="custom-control custom-checkbox my-2">';
    $checkboxes .= '<input type="checkbox" class="custom-control-input" id="question' . $question[ 'id' ] . '_' . $checkboxNo . '" value="' . $key . '" name="question' . $question[ 'id' ] . '[]" value="' . $key . '" aria-labelledby="question' . $question[ 'id' ] . 'Label">';
    $checkboxes .= '<label class="custom-control-label" for="question' . $question[ 'id' ] . '_' . $checkboxNo . '">' . $value . '</label>';
    $checkboxes .= '</div>';
    $checkboxNo++;
}

echo <<<HTML
<div class="form-group my-5">
    <label class="form-question" id="question{$question[ 'id' ]}Label">{$question[ 'text' ]}</label>
    <fieldset class="form-group">
        $checkboxes
    </fieldset>
</div>
HTML;
