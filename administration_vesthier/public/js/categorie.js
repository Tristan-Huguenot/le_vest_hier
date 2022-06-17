var boutons_modifier = document.getElementsByClassName('modifier')
var boutons_annuler = document.getElementsByClassName('annuler')

var dernier_boutons
var dernier_liens
var dernier_titre
var dernier_input

for(let bouton_modifier of boutons_modifier){

    bouton_modifier.addEventListener('click', function(e){

        let actionsLiens_modifier = e.target.parentNode.parentNode.getElementsByClassName('icone_lien')
        let boutonsLiens_modifier = e.target.parentNode.parentNode.getElementsByClassName('bouton')

        for(let action_modifier of actionsLiens_modifier){
            action_modifier.classList.add('actions_invisible')
        }
        for(let bouton_modifier of boutonsLiens_modifier){
            bouton_modifier.classList.remove('actions_invisible')
        }

        if(dernier_boutons != null && dernier_boutons != boutonsLiens_modifier){

            for(let action of dernier_liens){
                action.classList.remove('actions_invisible')
            }
            for(let bouton of dernier_boutons){
                bouton.classList.add('actions_invisible')
            }
            dernier_input.value = dernier_titre.innerHTML
        }
        
        dernier_input = e.target.parentNode.parentNode.children[1]
        dernier_titre = e.target.parentNode.parentNode.children[0]
        dernier_boutons = boutonsLiens_modifier
        dernier_liens = actionsLiens_modifier
    })
}

for(let bouton_annuler of boutons_annuler){
    bouton_annuler.addEventListener('click', function(e){

        let actionsLiens_annuler = e.target.parentNode.parentNode.getElementsByClassName('icone_lien')
        let boutonsLiens_annuler = e.target.parentNode.parentNode.getElementsByClassName('bouton')

        for(let action_annuler of actionsLiens_annuler){
            action_annuler.classList.remove('actions_invisible')
        }
        for(let bouton_annuler of boutonsLiens_annuler){
            bouton_annuler.classList.add('actions_invisible')
        }
        dernier_input.value = dernier_titre.innerHTML
    })
}