const $ = require('jquery');
require('popper.js');
require('bootstrap');

console.log('log');

// Global Vars
global.$ = global.jQuery = $;

let smUp = 576;
let mdUp = 768;
let lgUp = 992;
let xlUp = 1200;
let xxlUp = 1600;
let windowWidth = $(window).width();
let windowHeight = $(window).height();
let windowTop;

// Initialisation
$(window).on('load', function() {
  console.log('window load');
});

// Re-initialisation au resize
$(window).on('resize orientationchange', function() {
  console.log('window resize orientationchange');
});

// Re-initialisation au scroll
$(window).on('scroll', function() {
  console.log('window scroll');
});
