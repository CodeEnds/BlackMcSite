const leaderboard = $(".leaderboard").get(0);
const leaderboardModes = {
    time: {
        name: "time",
        localeSuffix: "m"
    },
    kills: {
        name: "kills",
        localeSuffix: " zabójstw"
    },
    deaths: {
        name: "deaths",
        localeSuffix: " śmierci"
    },
    level: {
        name: "level",
        localeSuffix: " poziom"
    },
    money: {
        name: "money",
        localeSuffix: " monet"
    },
    moneywebsite: {
        name: "moneywebsite",
        localeSuffix: " wydanych zł"
    }
}

async function refreshLeaderboardSkins() {
    for(const playerRecord of $(".leaderboard-top .player-record")) {
        const playerName = $(playerRecord).children(".player-name").get(0).textContent;
        const avatar = $($(playerRecord).children(".player-skin").get(0)).children(".avatar").get(0);
        const context = avatar.getContext('2d');
        context.imageSmoothingEnabled = false;
        
        const skinReq = await fetch(`../skin.php?nick=${playerName}`)
        const skinUrl = playerName == "-" ? "img/default-skin.png" : skinReq.url;
        var image = new Image();
        image.onload = () => context.drawImage(image, 8, 8, 8, 8, 0, 0, 64, 64);
        image.src = skinUrl;
    }

    for(const playerRecord of $(".leaderboard-bottom .player-record")) {
        const playerName = $(playerRecord).children(".player-name").get(0).textContent;
        const avatar = $($(playerRecord).children(".head").get(0)).children(".avatar").get(0);
        const context = avatar.getContext('2d');
        context.imageSmoothingEnabled = false;
        
        const skinReq = await fetch(`../skin.php?nick=${playerName}`)
        const skinUrl = playerName == "-" ? "img/default-skin.png" : skinReq.url;
        var image = new Image();
        image.onload = () => context.drawImage(image, 8, 8, 8, 8, 0, 0, 64, 64);
        image.src = skinUrl;
    }
}

async function unloadLeaderboard() {
    leaderboard.style.transform = window.innerWidth > 640 ? "translateY(130%)" : "translateX(-130%)";
    return new Promise(r => setTimeout(r, 1500));
}

async function loadLeaderboard() {
    leaderboard.style.transform = "translateY(0)";
    return new Promise(r => setTimeout(r, 1500));
}

async function getLeaderboardData(mode) {
    const response = await fetch(`../get-top-players.php?type=${mode}`);
    const json = await response.json();
    return json;
}

function refreshLeaderboardData(data, suffix) {
    const swapRecords = (array, first, second) => {
        const temp = array[first];
        array[first] = array[second];
        array[second] = temp;
    }

    const topRecords = $(".player-record");
    swapRecords(topRecords, 0, 1);

    let index = 0;
    for(const playerRecord of topRecords) {
        if(index < data.length) {
            const playerNameEl = $(playerRecord).children(".player-name").get(0);
            const score = $(playerRecord).children(".score").get(0);
            playerNameEl.textContent = data[index][0];
            score.textContent = data[index][1] + suffix;
        } else {
            const playerNameEl = $(playerRecord).children(".player-name").get(0);
            const score = $(playerRecord).children(".score").get(0);
            playerNameEl.textContent = "-";
            score.textContent = "0" + suffix;
        }
        index++;
    }

    refreshLeaderboardSkins();
}

let changeFinished = true;

async function changeLeaderboard(mode) {
    if(!changeFinished) return;
    mode = leaderboardModes[mode];
    if(mode == undefined) return;
    changeFinished = false;
    const unloading = unloadLeaderboard();
    const data = await getLeaderboardData(mode.name);
    await unloading;
    refreshLeaderboardData(data, mode.localeSuffix);
    await loadLeaderboard();
    changeFinished = true;
}

changeLeaderboard("level");