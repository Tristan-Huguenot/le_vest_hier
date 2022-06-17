/**
 * Script pour l'annimation du carousel d'événements de la page d'accueil
 * @author: Tristan Huguenot
 * @version: 1.0
 * Création : 12/03/2022
 * Dernière modification : Nan
 */

var fleche_gauche = document.getElementById('fleche_gauche_carousel')
var fleche_droite = document.getElementById('fleche_droite_carousel')
var evenements = document.getElementsByClassName('conteneur_evenement')
var order = 0;
var actuel = 0;

function met_invisible(){
    for(let i = 0; i < evenements.length; i++){
        if(!(i == order)){
            evenements[i].style.left = '-4000px'
            evenements[i].style.position = "absolute"
            evenements[i].style.opacity = 0;
        }
    }
}

met_invisible()

function evenement_suivant(){
    actuel = order
    if((order + 1) >= evenements.length){
        order = 0
    }
    else {
        order++
    }


    let left
    if(document.body.clientWidth > 1200) left = "125px"
    let cent = document.body.clientWidth
    cent -= 10;
    cent = 15 * cent / 100 - 45
    if(document.body.clientWidth > 968 && document.body.clientWidth < 1200) left = cent
    evenements[actuel].style.position = "absolute"
    evenements[actuel].style.left = left
    evenements[actuel].style.opacity = 0;
    setTimeout(function(){
        evenements[actuel].style.left = '-4000px'
    }, 1000)
    evenements[order].style.left = 'unset'
    evenements[order].style.opacity = 1;
    evenements[order].style.position = "unset"
}

fleche_droite.addEventListener('click', function(){
    evenement_suivant()
})

fleche_gauche.addEventListener('click', function(){
    actuel = order
    if(order == 0){
        order = evenements.length - 1
    }
    else {
        order--
    }

    
    let left
    if(document.body.clientWidth > 1200) left = "75px"
    let cent = document.body.clientWidth
    cent -= 10;
    cent = 15 * cent / 100 - 45
    if(document.body.clientWidth > 968 && document.body.clientWidth < 1200) left = cent
    evenements[actuel].style.position = "absolute"
    evenements[actuel].style.left = left
    evenements[actuel].style.opacity = 0;
    setTimeout(function(){
        evenements[actuel].style.left = '-4000px'
    }, 1000)
    evenements[order].style.left = 'unset'
    evenements[order].style.opacity = 1;
    evenements[order].style.position = "unset"
})

setInterval(evenement_suivant, 6000)