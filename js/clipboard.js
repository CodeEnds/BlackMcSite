var showMessageTimeout;
var hideMessageTimeout;

function copyToClipboard(element) {
    console.log("działa");
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).text()).select();
    document.execCommand("copy");
    $temp.remove();

    clearTimeout(showMessageTimeout);
    clearTimeout(hideMessageTimeout);
    document.getElementById("box_message").style.display = "block";
    document.getElementById("box_message").style.opacity = "1";
    showMessageTimeout = window.setTimeout(showBoxMessage, 2 * 1000);
}

function showBoxMessage() {
    document.getElementById("box_message").style.opacity = "0";
    hideMessageTimeout = window.setTimeout(hideBoxMessage, 500);
}

function hideBoxMessage() {
    document.getElementById("box_message").style.display = "none";
}
