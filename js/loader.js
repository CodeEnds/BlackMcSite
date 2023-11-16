$(document).ready(function() {
    $('nav').css("opacity", "0");
    $('.copy-ip').css("opacity", "0");
    $('.copy-info').css("opacity", "0");
    $('.server-status').css("opacity", "0");
});

$(window).on("load", function() {
    $(".loader_wrapper").delay(500).fadeOut(1000);
    $('nav').delay(1000).queue(function() {
       $(this).css("animation-name", "fade-down").css("animation-duration", "1s").css("animation-fill-mode", "forwards"); 
    });
    $('.copy-ip').delay(700).queue(function() {
       $(this).css("animation-name", "fade-up").css("animation-duration", "1s").css("animation-fill-mode", "forwards"); 
    });
    $('.copy-info').delay(800).queue(function() {
       $(this).css("animation-name", "fade-up").css("animation-duration", "1s").css("animation-fill-mode", "forwards"); 
    });
    $('.server-status').delay(1000).queue(function() {
       $(this).css("animation-name", "fade-up").css("animation-duration", "1s").css("animation-fill-mode", "forwards"); 
    });
    $('svg path').delay(500).queue(function() {
        $(this).css("animation-name", "logo-title-anim");
    });
});