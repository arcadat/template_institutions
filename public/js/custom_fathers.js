/**
	Custom JS

	1. MOBILE MENU
	2. PRELOADER
	3. BOTTOM TO UP
	4. PARALLAX HEADER
    5. HIRE ME SCROLL
**/

jQuery(function($){


	/* ----------------------------------------------------------- */
	/*  1. Mobile MENU
	/* ----------------------------------------------------------- */

    jQuery(".button-collapse").sideNav({
        menuWidth: 300, // Default is 300
        closeOnClick: true, // Closes side-nav on <a> clicks, useful for Angular/Meteor
        draggable: true // Choose whether you can drag to open on touch screens
    });

	/* ----------------------------------------------------------- */
	/*  2. PRELOADER
	/* ----------------------------------------------------------- */

	jQuery(window).load(function() { // makes sure the whole site is loaded
      $('.progress').fadeOut(); // will first fade out the loading animation
      $('#preloader').delay(100).fadeOut('slow'); // will fade out the white DIV that covers the website.
      $('body').delay(100).css({'overflow':'visible'});
    });

	/* ----------------------------------------------------------- */
	/* 3. BOTTOM TO UP
	/* ----------------------------------------------------------- */

	jQuery(".up-btn, .brand-logo").click(function() {
    jQuery('html,body').animate({
        scrollTop: $("#header").offset().top},
        'slow');
	});

	/* ----------------------------------------------------------- */
	/* 4. PARALLAX HEADER
	/* ----------------------------------------------------------- */

	jQuery('.parallax').parallax();

	/* ----------------------------------------------------------- */
	/* 5. HIRE ME SCROLL
	/* ----------------------------------------------------------- */

	jQuery(".hire-me-btn").click(function(e) {
		e.preventDefault();
    jQuery('html,body').animate({
        scrollTop: $("#footer").offset().top},
        'slow');
	});

    /* ----------------------------------------------------------- */
    /* 6. MODAL WINDOWS
    /* ----------------------------------------------------------- */
    jQuery("#modal_download").modal();
    jQuery("#modal_reports").modal();
    jQuery("#modal_results").modal();

    /* ----------------------------------------------------------- */
    /* 7. LIGHTBOX ( FOR PORTFOLIO POPUP VIEW )
    /* ----------------------------------------------------------- */

    jQuery(".portfolio-list").lightGallery({
        selector: '.portfolio-thumbnill',
        download: false
    });

    // WHEN CLICK CLOSE BUTTON

    jQuery(document).on('click','.modal-close-btn', function(event) {
        event.preventDefault();
        $('#portfolio-popup').removeClass("portfolio-popup-show");
        $('#portfolio-popup').animate({
              "opacity": 0
        },500);

    });

    /* ----------------------------------------------------------- */
    /* 7. COLLAPSIBLE
    /* ----------------------------------------------------------- */

    jQuery('.collapsible').collapsible();

});
