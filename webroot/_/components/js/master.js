// document ready
$(function() {

    venma.navigation.init();
    venma.hero.init();
    venma.header.init();

}); // document ready

var venma = venma || {}; // venma

venma.navigation = venma.navigation || new function() {
    var navigation = this;

    // Initialize search
    this.init = function() {
        navigation.initializeMobileNavigation();
    };

    this.initializeMobileNavigation = function() {
        $('body').on('click', '.toggle-menu, #off-canvas-overlay', function(e) {
            e.preventDefault();
            $(this).blur();

            $('#off-canvas-panel').toggleClass('panel-open');
            $('#off-canvas, #site').toggleClass('off-canvas-active');

            return false;
        });
    };
}(); // venma.navigation

venma.hero = venma.hero || new function() {
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
}(); // venma.hero

venma.header = venma.header || new function() {
    var header = this;

    this.init = function(){
        $('#page').data('size','big');
    };

    $(window).scroll(function(){
        if($(document).scrollTop() > 110){
            if($('#page').data('size') == 'big')
            {
                $('#page').data('size','small');
                $('#page').addClass('scroll');
            }
        }
        else{
            if($('#page').data('size') == 'small')
            {
                $('#page').data('size','big');
                $('#page').removeClass('scroll');
            }  
        }
    });

}(); // venma.header