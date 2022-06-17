/**
 * Script pour l'affichage et l'animation du menu burger
 * @author: Tristan Huguenot
 * @version: 1.0
 * Création : 12/03/2022
 * Dernière modification : Nan
 */

let boite_burger = document.getElementById('burger')
let image_burger = document.getElementById('burger_img')
let menu = document.getElementById('menu_sticky')


boite_burger.addEventListener('click', function(){

    if(menu.classList.contains('visible')){
        menu.classList.remove('visible')
        menu.style.opacity = 0
        boite_burger.classList.remove('open')
        image_burger.src = 'public/img/icone/burger.svg'
    }
    else{
        menu.classList.add('visible')
        menu.style.opacity = 1
        boite_burger.classList.add('open')
        image_burger.src = 'public/img/icone/croix.svg'
    }
})

window.addEventListener('resize', function(){
    if(document.body.clientWidth > 968){
        menu.style.opacity = 1
    }
})