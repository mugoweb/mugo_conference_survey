$(function() {

    // Mobile Menu Functions

    // Mobile Menu
    $('#navbarMugoMenu').on('show.bs.collapse', function () {
        $('.mod-navbar .open-mobile-menu').addClass("animated-close");
        //colapse the search menu
        $('#navbarSearchMenu').collapse('hide');
        $('.mod-navbar .open-search-menu').removeClass("turn-close");
    })

    $('#navbarMugoMenu').on('hide.bs.collapse', function () {
        $('.mod-navbar .open-mobile-menu').removeClass("animated-close");
    })

    // Search Menu
    $('#navbarSearchMenu').on('show.bs.collapse', function () {
        $('.mod-navbar .open-search-menu').addClass("turn-close");
        //colapse the search menu
        $('#navbarMugoMenu').collapse('hide');
        $('.mod-navbar .open-mobile-menu').removeClass("animated-close");
    })

    $('#navbarSearchMenu').on('hide.bs.collapse', function () {
        $('.mod-navbar .open-search-menu').removeClass("turn-close");
    })

    // Hover effect for navbar
    $('.mod-navbar .has-sub-menu').parent().hover(
        function(){
            if ($(window).width() >= 768) {
                if($('.mod-navbar .sub-menu').hasClass('show')){
                    $('.mod-navbar .sub-menu').removeClass('show');
                    $('.mod-navbar .sub-menu').collapse('hide');
                }
                $(this).find('.sub-menu').stop(true, true).slideDown(300);
                $(this).find('.has-sub-menu').removeClass('collapsed');
            }
        },
        function(){
            if ($(window).width() >= 768) {
                $(this).find('.sub-menu').stop(true, true).slideUp(300);
                $(this).find('.has-sub-menu').addClass('collapsed');
            }
        }
    );

    // collapse the navbar menu when the window is resized
    $(window).resize(function() {
        if ($(window).width() >= 768) {
            $('.mod-navbar .sub-menu').collapse('hide');
        } else {
            $('.mod-navbar .sub-menu').css('display','');
        }
    })


    // Learning Block with slick at homepage
    $('.mod-learnings .slick').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    dots: false
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    dots: true
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: true
                }
            }
        ],
    });


    // Read More Block with slick at Process Page
    $('.read-more .slick').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        adaptiveHeight: false,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    dots: false
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    dots: true
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: true
                }
            }
        ],
    });
    // fix the height card when resize the page
    readMoreResize();
    $(window).resize(function() {
        setTimeout(readMoreResize, 200);
    })

    function readMoreResize(){
        $('.read-more .slick .card-read .content').css('height', '');
        $('.read-more .slick .card-read').css('height', '');

        var $tallest = 0;
        $('.read-more .slick .card-read').each(function(){
            var $my_height = $(this).height();
            if ($my_height > $tallest) {
                $tallest = $my_height;
            }
        })
        $('.read-more .slick .card-read').css('height', $tallest);
        $('.read-more .slick .card-read .content').css('height', $tallest);
    }
    


    // Slick on Content Block for Process Page
    $('.content-block .slick-images').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true
    });

    // Slick for Article and Case Studies on Services Page
    $('.services .slick').slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        adaptiveHeight: false,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    dots: false
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    dots: false
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    dots: false
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: true
                }
            }
        ],
    });


    // load the multiselect items
    // Docs at http://davidstutz.de/bootstrap-multiselect/
    $('.multiselect').multiselect({
        maxHeight: 400,
        numberDisplayed: 4,
        optionClass: function(element) {
            return 'checkbox-element';
        },
    });

    // active the selected checkbox element
    loadCheckBoxes();
    $('.checkbox-element').on('click', function(){
        loadCheckBoxes();
    });

    function loadCheckBoxes(){
        $( '.checkbox-element' ).each(function( index ) {
            if ($(this).find('input').is(':checked')) {
                $(this).addClass('active');
            } else {
                $(this).removeClass('active');
            }
        });
    }

    // load modal function
    $('*[data-toggle="modal"]').on('click', function(){
        var modalID = $('this').data('target');
        $(modalID).modal();
    })

    // subscribe placeholder element
    $('.subscribe-box input').keyup(function(){
        if ( $(this).val().length > 0 ) {
            $('.subscribe-box .subscribe-placeholder').addClass('active');
        } else {
            $('.subscribe-box .subscribe-placeholder').removeClass('active');
        }
    })

    // Parallax banners effects
    $(window).scroll(function() {
        var $topPosition = window.pageYOffset+1;
        if ($topPosition <= 700) {
            $('div[data-effect="parallax"]').each(function(){
                var $depth = $(this).data('factor');
                var $rotate = $(this).data('rotate');
                var $movement = -($topPosition*$depth/10);
                var $transform = 'translate3d(0, ' + $movement + 'px, 0) ';
                if ($rotate){
                    $transform += 'rotate(' + ($rotate + ($topPosition * 0.05) ) + 'deg)';
                }

                $(this).css('transform', $transform);
            })
        }
    })

})
