<?php

$selectOptions = "";

foreach ( $question[ 'answers' ] as $answer ) {
    $key = key( $answer );
    $value = $answer[ $key ];
    $selectOptions .= '<option value="' . $key . '">' . $value . '</option>';
}

$question['placeholder'] = strtolower( $question[ 'placeholder' ] );

echo <<<HTML
<div class="form-group my-5">
    <label class="form-question" for="question{$question[ 'id' ]}">{$question[ 'text' ]}</label>
    <select 
        class="form-control"
        type="select"
        placeholder="{$question[ 'placeholder' ]}"
        id="question{$question[ 'id' ]}"
        name="question{$question[ 'id' ]}"
        required
    >
        <option disabled selected value> -- {$question[ 'placeholder' ]} -- </option>
        $selectOptions
    </select>
    <div class="valid-feedback">
        Looks good!
    </div>
</div>
HTML;
