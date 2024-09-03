import { Animal } from './Animal.js';

// Convertir a objetos de js
var depretator = new Animal(
    depretatorData.id,
    depretatorData.exp,
    depretatorData.level,
    depretatorData.atk, 
    depretatorData.ps,
    depretatorData.alias
);
var player = new Animal(
    playerData.id,
    playerData.exp,
    playerData.level,
    playerData.atk,
    playerData.ps,
    playerData.alias
);

//seleccion de elementos en el html
const atackBtn = document.getElementById('attackBtn');
const defendBtn = document.getElementById('defendBtn');
const quitBtn = document.getElementById('escBtn');

const psDepretatorDisp = document.getElementById('psDepretator');
const psPlayerDisp = document.getElementById('psPlayer');

const playerLastMoveDisp = document.getElementById('playerLastMove');
const depretatorLastMoveDisp =document.getElementById('depretatorLastMove');

const inputState = document.getElementById('state');
const submitBtn = document.getElementById('submitStatisticBtn')

//declaracion de variables
var playerMove = '';
var depretatorMove = '';

//declaracion de funciones globales
function verifyStatus(){
    if(player.isDead()){
        alert("Has muerto, la partida ha terminado.");
        inputState.value = 'LOSER';
        submitBtn.click();
    } else if (depretator.isDead()){
        alert("El depredador ha muerto.");
        inputState.value = 'WINNER';
        submitBtn.click();
    }
}

function update(playerAtk, enemyAtk) {
    //player turn
    psDepretatorDisp.textContent = depretator.ps;
    playerLastMoveDisp.classList.add('animated-text');
    playerLastMoveDisp.textContent = playerMove;

    if(playerAtk){
        psDepretatorDisp.classList.add('animated-text');
    }    
    setTimeout(() => {
        if(playerAtk){
            psDepretatorDisp.classList.remove('animated-text');
        } 
        playerLastMoveDisp.classList.remove('animated-text');
    }, 500);

    //depretator turn
    setTimeout(() => {
        psPlayerDisp.textContent = player.ps;
        depretatorLastMoveDisp.classList.add('animated-text');
        depretatorLastMoveDisp.textContent = depretatorMove;
        if(enemyAtk){
            psPlayerDisp.classList.add('animated-text');
        }

        setTimeout(() => {
            if(enemyAtk){
                psPlayerDisp.classList.remove('animated-text');
            } 
            depretatorLastMoveDisp.classList.remove('animated-text'); 
        }, 500);

    }, 2000); 
    verifyStatus();
}

function showAtack(displayMov, atacante, victima){
    displayMov = atacante.name + " ha atacado ";
    atacante.atacar(victima);
    if(victima.isDead()){
        displayMov += victima.name + " murio.";
    } else {
        displayMov += " la vida de " + victima.name + " se reduce";
    }
    return displayMov;
}


//evento de los botones
atackBtn.addEventListener('click', () => {
    var playerAtk = true;
    var enemyAtk = false;
    if(depretator.isDefending()){
        if(depretator.isEfectiveDefense()){
            playerMove = player.name + " ha intentado atacar pero ha fallado";
            depretatorMove = depretator.name + " ha esquivado un golpe exitosamente";
            playerAtk = false;
        } else {
            playerMove = showAtack(playerMove, player, depretator);
            depretatorMove = depretator.name + " ha intentado esquivar un golpe pero ha fallado";
        }
    } else {
        playerMove = player.name +" ha atacado, la vida de " + depretator.name + " se reduce.";
        player.atacar(depretator);
        if(depretator.isAlive()){
            depretatorMove = showAtack(depretatorMove, depretator, player);
            enemyAtk = true;
        } else {
            depretatorMove = depretator.name + " murio";
        }
    }

    update(playerAtk, enemyAtk);
});

defendBtn.addEventListener('click', () => {
    var enemyAtk = false;
    if(depretator.isDefending()){
        depretatorMove = depretator.name + " ha intentado esquivar";
        playerMove = player.name + " ha intentado esquivar";
    } else {
        if(player.isEfectiveDefense){
            depretatorMove = depretator.name + " ha intentado atacar pero ha fallado";
            playerMove = player.name + " ha esquivado un golpe exitosamente";
        } else {
            depretatorMove = showAtack(depretatorMove, depretator, player);
            playerMove = player.name + "ha intentado esquivar un golper pero ha fallado."
            enemyAtk = true;
        }
    }

    update(false, enemyAtk);
});

quitBtn.addEventListener('click', () => {
    alert("La partida quedo inconclusa, has huido.");
    inputState.value = 'INCOMPLEATE';
    submitBtn.click();
});