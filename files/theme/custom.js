jQuery(function(jQuery) {

	// Check your elements
  jQuery.fn.checkNavPositioning = function($el, $nav, scrollClass) {
    var navHeight = $nav.outerHeight();

    if(((this.outerHeight() - jQuery(window).scrollTop()) < $nav.outerHeight()) && !$el.hasClass(scrollClass)) {
      $el.addClass(scrollClass);
      $el.css('padding-top', navHeight);
    } else if((this.outerHeight() >= jQuery(window).scrollTop()) && $el.hasClass(scrollClass)) {
      $el.removeClass(scrollClass);
      $el.css('padding-top', 0);
    }
  }

  // Mobile sidebars
  jQuery.fn.expandableSidebar = function(expandedClass) {
    var $me = this;

    $me.on('click', function() {
      if(!$me.hasClass(expandedClass)) {
        $me.addClass(expandedClass);
      } else {
        $me.removeClass(expandedClass);
      }
    });
  }

  // Interval loop
  jQuery.fn.intervalLoop = function(condition, action, duration, limit) {
    var counter = 0;
    var looper = setInterval(function(){
      if (counter >= limit || jQuery.fn.checkIfElementExists(condition)) {
        clearInterval(looper);
      } else {
        action();
        counter++;
      }
    }, duration);
  }

  // Check if element exists
  jQuery.fn.checkIfElementExists = function(selector) {
    return jQuery(selector).length;
  }


	var centoController = {
		init: function(opts) {
      var base = this;

      // Check content positioning
      if(jQuery(window).width() > 767) {
        jQuery('.cento-header').checkNavPositioning(jQuery('body'), jQuery('.nav-wrap'), 'affix');
      }

      // Add classes to elements
      base._addClasses();

      setTimeout(function(){
        base._checkCartItems();
        base._attachEvents();
      }, 1000);
    },

    _addClasses: function() {
      var base = this;

      // Add class to nav items with subnav
      jQuery('.wsite-menu-default').find('li.wsite-menu-item-wrap').each(function(){
        var $me = jQuery(this);

        if($me.children('.wsite-menu-wrap').length > 0) {

          $me.addClass('has-submenu');
          jQuery('<span class="icon-caret"></span>').insertAfter($me.children('a.wsite-menu-item'));
        }
      });

      // Add class to subnav items with subnav
      jQuery('.wsite-menu').find('li.wsite-menu-subitem-wrap').each(function(){
        var $me = jQuery(this);

        if($me.children('.wsite-menu-wrap').length > 0) {

          $me.addClass('has-submenu');
          jQuery('<span class="icon-caret"></span>').insertAfter($me.children('a.wsite-menu-subitem'));
        }
      });

      // Keep subnav open if submenu item is active
    jQuery('li.wsite-menu-subitem-wrap.wsite-nav-current').parents('.wsite-menu-wrap').addClass('open');

      // Add placeholder text to inputs
      jQuery('.wsite-form-sublabel').each(function(){
        var sublabel = jQuery(this).text();
        jQuery(this).prev('.wsite-form-input').attr('placeholder', sublabel);
      });

      // Add fullwidth class to gallery thumbs if less than 6
      jQuery('.imageGallery').each(function(){
        if (jQuery(this).children('div').length <= 6) {
          jQuery(this).children('div').addClass('fullwidth-mobile');
        }
      });
    },

    _checkCartItems: function() {
      var base = this;

      if(jQuery('#wsite-mini-cart').find('li.wsite-product-item').length > 0) {
        jQuery('body').addClass('cart-full');
      } else {
        jQuery('body').removeClass('cart-full');
      }
    },

    _moveLogin: function() {
      var loginDetach = jQuery('#member-login').detach();
      jQuery('.mobile-nav .wsite-menu-default > li:last-child').after(loginDetach);
    },

    _attachEvents: function() {
    	var base = this;

      // Move cart + login
      if (jQuery(window).width() <= 992) {
        jQuery.fn.intervalLoop('.mobile-nav #member-login', base._moveLogin, 800, 5);
      }

    	// Window scroll
    	jQuery(window).on('scroll', function(){
    		// Affix nav
        if(jQuery(window).width() > 767) {
          jQuery('.cento-header').checkNavPositioning(jQuery('body'), jQuery('.nav-wrap'), 'affix');
        }
    	});

        // Subnav toggle
        jQuery('li.has-submenu span.icon-caret').on('click', function() {
            var $me = jQuery(this);

            if($me.siblings('.wsite-menu-wrap').hasClass('open')) {
                $me.siblings('.wsite-menu-wrap').removeClass('open');
            } else {
                $me.siblings('.wsite-menu-wrap').addClass('open');
            }
        });


      // Store category dropdown
      jQuery('.wsite-com-sidebar').expandableSidebar('sidebar-expanded');

      // Search filters dropdown
      jQuery('#wsite-search-sidebar').expandableSidebar('sidebar-expanded');

    	// Init fancybox swipe on mobile
      if ('ontouchstart' in window) {
        jQuery('body').on('click', 'a.w-fancybox', function() {
          base._initSwipeGallery();
        });
      }
    },

    _initSwipeGallery: function() {
      var base = this;

      setTimeout(function(){
        var touchGallery = document.getElementsByClassName('fancybox-wrap')[0];
        var mc = new Hammer(touchGallery);
        mc.on("panleft panright", function(ev) {
          if (ev.type == "panleft") {
            jQuery("a.fancybox-next").trigger("click");
          } else if (ev.type == "panright") {
            jQuery("a.fancybox-prev").trigger("click");
          }
          base._initSwipeGallery();
        });
      }, 500);
    }
	}

	jQuery(document).ready(function(){
		centoController.init();
	});

});
