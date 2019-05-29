<?php

if ( isset( $opts[ 'confirmationMode' ] ) ) {
    $opts[ 'subHeading' ] = $opts[ 'submittedHeading' ];
}

echo <<<HTML
<!DOCTYPE html>
<html lang="en" data-blockbyte-bs-uid="37883">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="./assets/css/bootstrap-multiselect.css">
        <link rel="stylesheet" href="./assets/css/slick.css">
        <link rel="stylesheet" href="./assets/css/stylesheet.css">
        <link rel="stylesheet" href="./assets/css/survey.css">
        <link rel="shortcut icon" type="image/x-icon" href="https://www.mugo.ca/extension/mugoca/design/mugoca2.0/images/favicon.ico"/>
        <title>{$opts[ 'title' ]}</title>
    </head>
    <body class="contact-us">
        <div class="mod-navbar container navbar-expand-md">
            <div class="row align-items-center">
                <div class="col-7 col-xs-6 col-md-3 order-1">
                    <a class="brand" href="https://www.mugo.ca">
                        <img src="./assets/img/mugo-web.svg">
                    </a>
                </div>
            </div>
        </div>
        <div class="banner-page d-flex">
            <div class="container">
                <div class="row justify-content-center align-items-center align-items-md-start align-items-lg-center h-100">
                    <div class="narrow-block text-center">
                        <h1>{$opts[ 'mainHeading' ]}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="block-title narrow-block">
                        <p>{$opts[ 'subHeading' ]}</p>
                    </div>
                    <div class="spacer-sm"></div>
HTML;
