<?php

echo <<<HTML
<div class="form-group my-5">
    <label class="form-question" for="question{$question[ 'id' ]}">{$question[ 'text' ]}</label>
    <input 
        class="form-control"
        type="text"
        placeholder="{$question[ 'placeholder' ]}"
        id="question{$question[ 'id' ]}"
        name="question{$question[ 'id' ]}"
        required
    >
    <div class="valid-feedback">
        Looks good!
    </div>
</div>
HTML;
