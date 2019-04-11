<?php

echo <<<HTML
<div class="form-group my-5">
    <label class="form-question" for="question{$question[ 'id' ]}">{$question[ 'text' ]}</label>
    <textarea 
        class="form-control"
        type="textarea"
        placeholder="{$question[ 'placeholder' ]}"
        id="question{$question[ 'id' ]}"
        name="question{$question[ 'id' ]}"
        rows="5"
        required
    ></textarea>
    <div class="valid-feedback">
        Looks good!
    </div>
</div>
HTML;
