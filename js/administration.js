const modSections = [];
const backgroundArrow = $(".background-arrow");
const backgroundTitle = $(".background-title");

let animToggled = false;
let animFinished = true;

for(const section of $('.mod-section')) {
    modSections.push(section);
}

for(const section of modSections) {
    $(section).children(".section-caption")[0].addEventListener("click", () => {
        if(!animFinished) return;
        if(animToggled) {
            disableAnimation();
        } else {
            enableAnimation(section);
        }
    });
}

const enableAnimation = (element) => {
    animFinished = false;
    animToggled = true;
    backgroundArrow.addClass("background-arrow-animation");
    backgroundTitle.addClass("background-title-animation");
    for(const section of modSections) {
        if(section != element) $(section).addClass("mod-section-disabled");
    }
    $(element).addClass("mod-section-enabled");

    setTimeout(() => animFinished = true, 1000);
}

const disableAnimation = () => {
    animFinished = false;
    animToggled = false;
    backgroundArrow.removeClass("background-arrow-animation");
    backgroundTitle.removeClass("background-title-animation");
    for(const section of modSections) {
        $(section).removeClass("mod-section-disabled");
        $(section).removeClass("mod-section-enabled");
    }

    setTimeout(() => animFinished = true, 1000);
}