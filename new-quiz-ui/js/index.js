'use strict';
const myMusic= document.getElementById("music");


function toggle() {
    const image = document.getElementById("toggle");
    if (image.className === "play") {
        image.className = "pause"
        image.src = "images/play.png";
        myMusic.pause();
    } else {
        image.className = "play"
        image.src = "images/pause.png";
        myMusic.play();
    }
}

const clickSound = document.getElementById("click");
function playClick() {
    clickSound.play();
};
