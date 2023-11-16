addEventListener('scroll', () => {
    if(window.scrollY == 0)
        $("nav").removeClass("nav-collapse");
    else
        $("nav").addClass("nav-collapse");
});