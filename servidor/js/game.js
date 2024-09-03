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

//declaracion de variables
var playerMove = '';
var depretatorMove = '';

//declaracion de funciones globales
function update() {
    psDepretatorDisp.textContent = depretator.ps;
    psPlayerDisp.textContent = player.ps;
    playerLastMoveDisp.textContent = playerMove;
    depretatorLastMoveDisp.textContent = depretatorMove;
}


atackBtn.addEventListener('click', () => {

    if(depretator.isDefending()){
        if(depretator.isEfectiveDefense()){
            playerMove = player.name + " ha intentado atacar pero ha fallado";
            depretatorMove = depretator.name + " ha esquivado un golpe exitosamente";
        } else {
            playerMove = player.name + " ha atacado, la vida de " + depretator.name + " se reduce.";
            player.atacar(depretator);
            if(depretator.ps > 0){
                depretatorMove = depretator.name + " ha intentado esquivar un golper pero ha fallado";
            } else {
                depretatorMove = depretator.name + "murio";
            }
        }
    } else {
        playerMove = player.name +" ha atacado, la vida de " + depretator.name + " se reduce.";
        player.atacar(depretator);
        if(depretator.ps > 0){
            depretatorMove = depretator.name + " ha atacado, la vida de " + player.name + " se reduce.";
            depretator.atacar(player);
        } else {
            depretatorMove = depretator.name + " murio";
        }
    }

    update();
});

defendBtn.addEventListener('click', () => {
    var isDefending = depretator.isDefending();
    if(isDefending){
        depretatorMove = depretator.name + " ha intentado esquivar";
        playerMove = player.name + " ha intentado esquivar";
    } else {
        if(player.isEfectiveDefense){
            depretatorMove = depretator.name + " ha intentado atacar pero ha fallado";
            playerMove = player.name + " ha esquivado un golpe exitosamente";
        } else {
            depretatorMove = depretator.name + " ha atacado, la vida de " + player.name + " se reduce.";
            depretator.atacar(player);
            playerMove = player.name + "ha intentado esquivar un golper pero ha fallado."
        }
    }

    update();
});
