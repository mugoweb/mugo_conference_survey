<?php

print '<div class="form-group">';
if( $question[ 'text' ] )
{
echo <<<HTML
    <label class="form-question" for="question{$question[ 'id' ]}">{$question[ 'text' ]}</label>
HTML;
}
echo <<<HTML
    <textarea 
        class="form-control"
        type="textarea"
        placeholder="{$question[ 'placeholder' ]}"
        id="question{$question[ 'id' ]}"
        name="question{$question[ 'id' ]}"
        rows="5"
    ></textarea>
    <div class="valid-feedback">
        Looks good!
    </div>
</div>
HTML;
