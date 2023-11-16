const avatar = $(".pfp").get();
const context = avatar.getContext('2d');
context.imageSmoothingEnabled = false;
const nick = avatar.getAttribute("nick");

(async function() {
    const skinReq = await fetch(`../skin.php?nick=${nick}`);
    const skinUrl = nick == "" ? "img/default-skin.png" : skinReq.url;
    var image = new Image();
    image.onload = () => context.drawImage(image, 8, 8, 8, 8, 0, 0, 64, 64);
    image.src = skinUrl;
})();
