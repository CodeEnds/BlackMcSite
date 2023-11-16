async function getSkinUrl(nick) {
    const response = await fetch(`../skin.php?nick=${nick}`);
    return response.url;
}

const skinDisplay = $('.profile-skin').get(0);
const leftPanel = $('.left').get(0);

function getRandomInt(max) {
    return Math.floor(Math.random() * (max + 1));
}

async function setSkinDisplay() {
    const playerName = skinDisplay.getAttribute('nick');

    const skinUrl = await getSkinUrl(playerName);

    let skinViewer = new skinview3d.SkinViewer({
        canvas: skinDisplay,
        width: leftPanel.offsetWidth + 1,
        height: leftPanel.offsetHeight,
        skin: skinUrl
    });

    skinViewer.loadPanorama(`../img/panorama${getRandomInt(2)}.jpg`);

    skinViewer.camera.position.x = 17.5;
    skinViewer.camera.position.y = 10.0;
    skinViewer.camera.position.z = 42.0;
    skinViewer.zoom = 0.6;
    skinViewer.fov = 90;

    skinViewer.controls.enableZoom = false;
}

setSkinDisplay();