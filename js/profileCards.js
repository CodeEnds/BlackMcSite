class ProfileCard {

    constructor(elementClassName) {
        this.element = $(elementClassName).get(0);
    }

    async getProfileData(nick) {
        const response = await fetch(`../get-player.php?nick=${nick}`);
        const json = (await response.json())[0];
        if(json == undefined) return undefined;
        const profileData = {
            nick: json[2] ? json[2] : "",
            level: json[3] ? json[3] : 0,
            exp: json[4] ? json[4] : 0,
            maxexp: json[5] ? json[5] : 0,
            rank: json[6] ? json[6].toUpperCase() : "",
            kills: json[7] ? json[7] : 0,
            deaths: json[8] ? json[8] : 0,
            time: json[9] ? json[9] : 0,
            money: json[10] ? json[10] : 0,
            moneywebsite: json[11] ? json[11] : 0,
        }
        if(profileData.rank == "DEFAULT") profileData.rank = "GRACZ";
        return profileData;
    }

    async setProfileData(playerData) {
        this.currentPlayerName = playerData.nick;
        const profileAvatar = $(this.element).find(".profile-avatar canvas").get(0);
        const profileName = $(this.element).find(".profile-name").get(0);
        const profileRank = $(this.element).find(".profile-rank").get(0);
        const profileLevel = $(this.element).find(".profile-level .value").get(0);
        const expValue = $(this.element).find(".progress-info .value").get(0);
        const maxExpValue = $(this.element).find(".progress-info .max-value").get(0);
        const profileKills = $(this.element).find(".profile-kills .value").get(0);
        const profileDeaths = $(this.element).find(".profile-deaths .value").get(0);
        const profileTime = $(this.element).find(".profile-time .value").get(0);
        const profileMoney = $(this.element).find(".profile-money .value").get(0);
        const profileMoneywebsite = $(this.element).find(".profile-moneywebsite .value").get(0);
        const progressFill = $(this.element).find(".progress-fill").get(0);

        profileName.textContent = playerData.nick;
        profileRank.textContent = playerData.rank;
        profileLevel.textContent = playerData.level;
        expValue.textContent = playerData.exp;
        maxExpValue.textContent = playerData.maxexp;
        profileKills.textContent = playerData.kills;
        profileDeaths.textContent = playerData.deaths;
        profileTime.textContent = playerData.time;
        profileMoney.textContent = playerData.money;
        profileMoneywebsite.textContent = playerData.moneywebsite;
        progressFill.style.width = (100 * playerData.exp / playerData.maxexp) + '%';

        const context = profileAvatar.getContext('2d');
        context.imageSmoothingEnabled = false;
        
        const skinReq = await fetch(`../skin.php?nick=${playerData.nick}`)
        const skinUrl = skinReq.url;
        var image = new Image();
        image.onload = () => context.drawImage(image, 8, 8, 8, 8, 0, 0, 64, 64);
        image.src = skinUrl;
    }

    async changeProfile(playerName) {
        if(this.changingProfile || playerName == this.currentPlayerName) return;
        this.changingProfile = true;
        const playerData = (await Promise.all([this.getProfileData(playerName), this.loaded ? this.unload() : Promise.resolve()]))[0];
        if(playerData == undefined) {
            this.changingProfile = false;
            return;
        }
        await this.setProfileData(playerData);
        await this.load();
        this.changingProfile = false;
    }
}

const leftProfileCard = new ProfileCard(".profile-card-1");
const rightProfileCard = new ProfileCard(".profile-card-2");

leftProfileCard.unload = async function() {
    if(this.unloading) return;
    this.unloading = true;
    this.element.style.animation = "none";
    setTimeout(() => this.element.style.animation = "profile-left 0.7s cubic-bezier(0.07, 0.48, 0.58, 1) forwards reverse, profile-vertical 1s cubic-bezier(0.49, 0.17, 0.92, 0.54) forwards reverse");
    return new Promise(r => setTimeout(r, 1000)).then(() => { this.unloading = false; this.loaded = false; this.currentPlayerName = null; });
}
leftProfileCard.load = async function() {
    if(this.loading) return;
    this.loading = true;
    this.element.style.animation = "none";
    await new Promise(r => setTimeout(r, 100));
    setTimeout(() => this.element.style.animation = "profile-left 0.7s cubic-bezier(0.07, 0.48, 0.58, 1) forwards normal, profile-vertical 1s cubic-bezier(0.49, 0.17, 0.92, 0.54) forwards normal");
    return new Promise(r => setTimeout(r, 1000)).then(() => { this.loading = false; this.loaded = true; });
}

rightProfileCard.unload = async function() {
    if(this.unloading) return;
    this.unloading = true;
    this.element.style.animation = "none";
    setTimeout(() => this.element.style.animation = "profile-right 0.7s cubic-bezier(0.07, 0.48, 0.58, 1) forwards reverse, profile-vertical 1s cubic-bezier(0.49, 0.17, 0.92, 0.54) forwards reverse");
    return new Promise(r => setTimeout(r, 1000)).then(() => { this.unloading = false; this.loaded = false; this.currentPlayerName = null; });
}
rightProfileCard.load = async function() {
    if(this.loading) return;
    this.loading = true;
    this.element.style.animation = "none";
    await new Promise(r => setTimeout(r, 100));
    setTimeout(() => this.element.style.animation = "profile-right 0.7s cubic-bezier(0.07, 0.48, 0.58, 1) forwards normal, profile-vertical 1s cubic-bezier(0.49, 0.17, 0.92, 0.54) forwards normal");
    return new Promise(r => setTimeout(r, 1000)).then(() => { this.loading = false; this.loaded = true; });
}

function getFreeProfileCard() {
    return leftProfileCard.currentPlayerName ? rightProfileCard : leftProfileCard;
}

for(const card of [leftProfileCard, rightProfileCard]) {
    const initialNick = card.element.getAttribute("initial-nick");
    if(initialNick) card.changeProfile(initialNick);
}

for(const playerRecord of $(".player-record")) {
    playerRecord.addEventListener("click", () => {
        const playerName = $(playerRecord).children(".player-name").get(0).textContent;
        getFreeProfileCard().changeProfile(playerName)
    });
}

window.addEventListener("load", () => {
    let nick = leftProfileCard.element.getAttribute("nick");
    if(nick == undefined) return;
    leftProfileCard.changeProfile(nick);
});

// document.addEventListener("keypress", (event) => {
//     if(event.key == "r") {
//         rightProfileCard.changeProfile("Steve");
//     } else if(event.key == "s") {
//         rightProfileCard.unload();
//     }
// });