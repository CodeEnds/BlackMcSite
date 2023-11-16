for(const progressFill of $(".progress-fill")) {
    const value = progressFill.getAttribute("value");
    const maxValue = progressFill.getAttribute("max-value");
    progressFill.style.width = (100 * value / maxValue) + "%";
}
