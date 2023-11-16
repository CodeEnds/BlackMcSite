$("#logo-title").children("path").get().forEach((element) => {
    element.addEventListener("animationend", () => element.style.strokeDasharray = 0, false);
});