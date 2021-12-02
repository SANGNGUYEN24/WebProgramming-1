'use strict';

const clickSound0= document.getElementById("click");
function playClick() {
    clickSound0.play();
}

const beginButton = document.getElementById('beginBTN')

beginButton.addEventListener('click', e=>{
    e.preventDefault()
    playClick()
    let nextPage = setTimeout(function(){window.location.replace('selection.php')},1000)
    
})

const gameOn = document.getElementById('submitForm')

gameOn.addEventListener('click', e=>{
    e.preventDefault()
    playClick()
    let nextPage = setTimeout(function(){window.location.replace('gamescreen.php')},1000)
    
})