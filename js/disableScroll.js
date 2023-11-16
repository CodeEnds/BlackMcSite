function disableScroll() {
    scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,

    window.onscroll = () => window.scrollTo(scrollLeft, scrollTop);
}

function enableScroll() {
    window.onscroll = function() {};
}

window.scrollTo(0, 0);
disableScroll();

$(window).on("load", function() {
    enableScroll();
});