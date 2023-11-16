async function getSkinUrl(nick) {
    const response = await fetch(`../skin.php?nick=${nick}`);
    return response.url;
}

(async function() {
    const skinViewer = new skinview3d.SkinViewer({
        width: window.innerWidth > 640 ? 400 : 200,
        height: window.innerWidth > 640 ? 500 : 250,
        renderPaused: true
    });
    
    skinViewer.camera.rotation.x = -0.620;
    skinViewer.camera.rotation.y = 0.534;
    skinViewer.camera.rotation.z = 0.348;
    skinViewer.camera.position.x = 30.5;
    skinViewer.camera.position.y = 34.0;
    skinViewer.camera.position.z = 42.0;
    skinViewer.zoom = 1;

    for(const card of $('.mod-card')) {
        let cardSkin = $(card).children(".card-skin")[0];
        let playerName = $(card).find(".card-info-name").text();
        if(playerName === undefined || playerName == "") continue;
        const skinUrl = await getSkinUrl(playerName);
        await Promise.all([
            skinViewer.loadSkin(skinUrl)
        ]);
        skinViewer.render();
        const image = skinViewer.canvas.toDataURL();

        const imgElement = document.createElement("img");
        imgElement.src = image;
        imgElement.width = skinViewer.width;
        imgElement.height = skinViewer.height;
        cardSkin.appendChild(imgElement);
    }

    skinViewer.dispose();
})();