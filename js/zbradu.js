
/*
* Open/close overlay
* */
jQuery(document).ready(function() {

    var overlay = jQuery('.header__overlay');
    var overlayInner = overlay.find('.header__overlay-inner');
    var overlayCartHolder = overlayInner.find('.cart-holder');
    var overlaySearchHolder = overlayInner.find('.search-holder');
    var loaderImage = jQuery('.loader-image');

    overlayInner.fadeOut();

    jQuery(document).on('click', '.open-search a, .shopping-cart a, .close-trigger, .woocommerce-message .button.wc-forward', function(e) {
        e.preventDefault();
        handleOverlayContent();

        /* Toggle overlay visibility */
        if (overlay.is(':hidden')) {
            overlay.slideToggle(200).find(overlayInner).delay(200).fadeIn(200);
        } else {
            overlayInner.fadeOut().closest(overlay).delay(200).slideToggle(200);
        }


        function handleOverlayContent() {

            /* Search */
            if (jQuery('.open-search a').is(e.target)) {

                loaderImage.hide();
                overlayCartHolder.empty();
                overlaySearchHolder.css('display', 'block');

                setTimeout(function(){
                    jQuery('input.overlay-search-input').focus();
                }, 400);
            }


            /* Shopping cart */
            if (jQuery('.shopping-cart a, .button.wc-forward').is(e.target)) {

                overlaySearchHolder.css('display', 'none');
                overlayCartHolder.empty();
                loaderImage.show();

                jQuery.ajax({
                    type: 'POST',
                    url: zbradu_ajax_object.ajax_url,
                    cache: false,
                    data: {
                        action: 'ajax_shopping_cart'
                    },
                    success: function(data) {
                        overlayCartHolder.append(data).hide().fadeIn(200);
                        loaderImage.hide();

                        /* Update cart on load because otherwise it has some issues */
                        jQuery( '.woocommerce-cart-form :button[name="update_cart"]' ).trigger('click');

                        /* Enable "Update Cart" button when quantity is changed with + and - buttons */
                        jQuery(document).on('click', '.quantity-button', function () {
                            jQuery(this).parent().parent().parent().find('.product-quantity :input.qty').change();
                        });

                        /* "Remove product" hack, since original remove product button didn't worked when cart is loaded via AJAX and shortcode */
                        jQuery(document).on('click', '.woocommerce-cart-form .product-remove > button', function (e) {
                            jQuery(this).parent().parent().find('.product-quantity :input.qty').change().val("0");
                            jQuery( '.woocommerce-cart-form :button[name="update_cart"]' ).trigger('click');
                        });
                    },

                    error: function(MLHttpRequest, textStatus, errorThrown){
                        alert(errorThrown);
                        loaderImage.hide();
                    }

                });
            }
        }
    });
});




/*
* Stick nav bar to the top of the page when scrolling
* */
jQuery(document).ready(function() {

    /* Declare variables in this scope */
    var contentWrap, navBarHolder, navBarHolderHeight, heroHeight, wpadminbarHeight, breakpoint;


    function setVariables() {
        contentWrap = jQuery("main.main");
        navBarHolder = jQuery("body").find(".header__navigation-bar");
        navBarHolderHeight = navBarHolder.outerHeight();
        heroHeight = jQuery(".header__hero").outerHeight();
        wpadminbarHeight = jQuery("#wpadminbar").outerHeight();
        breakpoint = heroHeight + navBarHolderHeight + wpadminbarHeight;
    }

    /* Define variables on load */
    setVariables();

    /* Re-define (overwrite) variables and reset browsebar position on resize */
    jQuery(window).resize(function(){

        setVariables();

        navBarHolder.removeClass("fixed-top");
        contentWrap.css("margin-top", "0");
    });



    /* Stick Browse Bar to the top when scrolling */
    jQuery(document).scroll(function () {

        var scroll = jQuery(window).scrollTop();

        if (navBarHolder.length) {
            if (scroll > breakpoint && !navBarHolder.hasClass("fixed-top")) {
                navBarHolder.addClass("fixed-top");
                navBarHolder.css({top: -navBarHolderHeight});
                contentWrap.css("margin-top", navBarHolderHeight);
                navBarHolder.animate({top: "0"});
            }

            if (scroll < breakpoint - navBarHolderHeight && navBarHolder.hasClass("fixed-top")) {
                navBarHolder.removeClass("fixed-top");
                contentWrap.css("margin-top", "0");
            }
        }
    });

});




/*
* Set placeholders as labels in WP 7 Form
* */
jQuery(document).ready(function() {

    var contactForm = jQuery('body').find('.wpcf7');

    contactForm.find('.wpcf7-text,' + '.wpcf7-textarea').each(function() {

        if (jQuery(this).closest('label').length > 0) {
            var label = jQuery(this).closest('label');
            var labelText = label.text().trim();
        }

        if (!jQuery(this).attr('placeholder') || jQuery(this).attr('placeholder') == "") {
            jQuery(this).attr('placeholder', labelText);
        }
    });
});




/*
* Owl Carousel settings
* */
jQuery(document).ready(function(){

    jQuery('.owl-carousel').owlCarousel({
        loop: true,
        autoplay: true,
        autoplayTimeout: 5000,
        margin: 10,
        nav: false,
        items: 1,
        responsive:{
        }
    })

});




/*
* Sub-menu items behavior
* */
jQuery(document).ready(function(){
    var dropdownMenuTrigger = jQuery('li.menu-item-has-children');
    var dropdownMenuContent = jQuery('.dropdown-menu');

    dropdownMenuTrigger.on('click', function(e) {

        e.preventDefault();

        if(!dropdownMenuContent.is(e.target) && dropdownMenuContent.has(e.target).length === 0
        ) {
            jQuery(this).toggleClass('open');
        }
    });

    jQuery(dropdownMenuContent.click(function(e){
        e.stopPropagation();
    }));


    /* Close dropdown menus on outside click */
    jQuery(document).mouseup(function (e) {
        if (dropdownMenuContent && dropdownMenuContent.length > 0
            && !dropdownMenuContent.is(e.target) && dropdownMenuContent.has(e.target).length === 0
            && !dropdownMenuTrigger.is(e.target) && dropdownMenuTrigger.has(e.target).length === 0
        ) {
            dropdownMenuTrigger.removeClass('open');
        }
    });

});
