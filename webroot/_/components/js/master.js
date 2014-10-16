// document ready
$(function() {
    // severin.gallery.init();
    severin.hero.init();

}); // document ready

var severin = severin || {}; // severin

// severin.navigation = severin.navigation || new function() {
//     var navigation = this;

//     // Initialize search
//     this.init = function() {
//         navigation.initializeMobileNavigation();
//     };

//     this.initializeMobileNavigation = function() {
//         $('body').on('click', '.toggle-menu', function(e) {
//             e.preventDefault();
//             $(this).blur();

//             $('body').toggleClass('show-mobile-menu');

//             return false;
//         });
//     };
// }(); // severin.navigation

// severin.gallery = severin.gallery || new function() {
//     var gallery = this;

//     // Initialize search
//     this.init = function() {
//         gallery.slider('.gallery-slider');
//     };

//     this.slider = function(selector) {
//     	var first_main_id;
//     	var i = 0;
//     	var done = function(n){
//     		if(n == $(selector).length && first_main_id){
// 				setTimeout(function(){
// 	    			$('#' + first_main_id).closest('.panel').find('.panel-title > a').click();
// 	    			$('#gallery-page-wrapper').css('opacity','1');
// 				},500);
//     		}
//     	};
    	
//     	$(selector).each(function(key,slider){
//     		var main_id = $(slider).attr('id');
// 	    	if(!main_id){
// 	    		main_id = $(slider).attr('id','gallery' + key).attr('id');
// 	    	}
// 	    	first_main_id = first_main_id || main_id;
//     		var nav_id = $(slider).next('.gallery-navigation').attr('id');
// 	    	if(!nav_id){
// 	    		nav_id = $(slider).next('.gallery-navigation').attr('id','galleryNav' + key).attr('id');
// 	    	}

// 	    	var sliderOptions = {
// 	            animation: "slide",
// 	            controlNav: false,
// 	            animationLoop: true,
// 	            slideshow: true,
// 	            selector: 'ul > li',
// 	            namespace: 'gallery-main-',
// 			    sync: '#' + nav_id,
// 			    start: function(){
// 			    	$('#' + main_id).closest('.panel').find('.panel-title > a').click();
// 			    	done(++i);
// 			    }
// 	        };
// 	        var navOptions = {
// 	            animation: "slide",
// 	            controlNav: false,
// 	            animationLoop: false,
// 	            slideshow: false,
// 	            itemWidth: 80,
// 	    		itemMargin: 15,
// 	            selector: 'ul > li',
// 	            namespace: 'gallery-nav-',
// 	            asNavFor: '#' + main_id
// 	        };

// 	        if(nav_id)
// 		        $('#' + nav_id).flexslider(navOptions);
// 	        $('#' + main_id).flexslider(sliderOptions);
//     	});
//     };
// }(); // severin.gallery

severin.hero = severin.hero || new function() {
    var hero = this;

    // Initialize search
    this.init = function() {
        hero.flexslider('#content-hero .hero-slider-wrapper');
    };

    this.flexslider = function(selector) {
        $(selector).flexslider({
            animation: "slide",
            slideshow: true,
            selector: '.hero-slider > li',
            namespace: 'hero-slider-',
            pauseOnAction: false,
            pauseOnHover: true
        });
    };
}(); // severin.hero

