var selectCategorie = document.getElementById('categorie')
var selectSousCategorie = document.getElementById('sous_categorie')

var liste_categorie = document.getElementsByClassName('categorie')
var liste_sous_categorie = document.getElementsByClassName('sous_categorie')

var option_categorie = document.getElementById('aucune_categorie')
var option_sous_categorie = document.getElementById('aucune_sous_categorie')

for (let sous_categorie of liste_sous_categorie) {
    sous_categorie.classList.add('hidden')
}
for(let categorie of liste_categorie){
    if(categorie.selected == true){
        for (let sous_categorie of liste_sous_categorie) {
            if(sous_categorie.classList.contains(categorie.id)){
                sous_categorie.classList.remove('hidden')
            }
        }
    }
}

if(option_categorie.selected){
    option_sous_categorie.selected = true
}

selectCategorie.addEventListener('change', function(e){

    for (let sous_categorie of liste_sous_categorie) {
        sous_categorie.classList.add('hidden')
    }

    for(let categorie of liste_categorie){
        console.log(categorie)
        if(categorie.selected == true){
            for (let sous_categorie of liste_sous_categorie) {
                if(sous_categorie.classList.contains(categorie.id)){
                    sous_categorie.classList.remove('hidden')
                }
            }
        }
    }

    if(option_categorie.selected){
        option_sous_categorie.selected = true
    }

})