let dropdownActive = false;
let dropdownAnimFinished = true;

$(".profile-box").get(0).addEventListener("click", (e) => {
    if(!dropdownAnimFinished) return;
    if(!e.target.matches(".dropdown")) {
        if(dropdownActive) {
            hideDropdown();
        } else {
            showDropdown();
        }
    }
});

$(document).click((e) => {
    if(!e.target.matches(".dropdown") && !e.target.matches(".profile-box") && $(e.target).parents(".profile-box").length <= 0) hideDropdown();
});

function showDropdown() {
    dropdownActive = true;
    dropdownAnimFinished = false;
    $(".dropdown").removeClass("dropdown-hidden");
    $(".dropdown").css("visibility", "visible");
    setTimeout(() => dropdownAnimFinished = true, 300);
}

function hideDropdown() {
    dropdownActive = false;
    dropdownAnimFinished = false;
    $(".dropdown").addClass("dropdown-hidden");
    setTimeout(() => { dropdownAnimFinished = true; $(".dropdown").css("visibility", "hidden"); }, 300);
}