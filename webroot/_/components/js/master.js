// DocReady
$(function() {

    project.navigation.init();
    // project.hero.init();

    console.log('Project Running Smooth!');
    // Comment out, if 

}); // DocReady

var project = project || {}; // project

project.navigation = project.navigation || new function() {
    var navigation = this;

    // Initialize search
    this.init = function() {
        navigation.initializeMobileNavigation();
    };

    this.initializeMobileNavigation = function() {
        $('body').on('click', '.toggle-menu', function(e) {
            e.preventDefault();
            $(this).blur();

            $('body').toggleClass('menu-open');

            return false;
        });
    };
}(); // project.navigation

// project.hero = project.hero || new function() {
//     var hero = this;

//     // Initialize search
//     this.init = function() {
//         hero.flexslider('#content-hero .hero-slider-wrapper');
//     };

//     this.flexslider = function(selector) {
//         $(selector).flexslider({
//             animation: "slide",
//             slideshow: true,
//             selector: '.hero-slider > li',
//             namespace: 'hero-slider-',
//             pauseOnAction: false,
//             pauseOnHover: true
//         });
//     };
// }(); // project.hero