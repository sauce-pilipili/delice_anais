// liste dans le dom
var $collection;
// genere le nouvel item lors du clique
var $add = $('<a href="#" class="btn btn-success">Ajouter une étape</a>');

$(document).ready(function () {

    $collection = $('#directions');//donne la liste a la variable
    $collection.append($add);// append le bouton ajout au collectionHolder
    $collection.data('index', $collection.find('.panel').length)// ajout index
    $collection.find('.panel').each(function () {
        addRemoveButton($(this));// ajout fonction et bouton remove
    });
    $addNewItem.click(function (e) {
        e.preventDefault();
        addNewForm()
    })
    ;

});

/*
 * creation du formulaire et ajout au collection holder
 */
function addNewForm() {

    let prototype1 = $collection.data('prototype');
    let index1 = $collection.data('index');// recup de l'index
    let newForm1 = prototype1; // creation du formulaire
    newForm1 = newForm1.replace(/__name__/g, index1); // remplace le __name__  dans le  html avec la valeur de l'index
    $collection.data('index', index + 1);// ajout de 1 a l'index
    let $panel1 = $('<div class="panel my-3"></div>');// panel auquel on ajout le collectionHolder
    let $panelBody1 = $('<div class="panel-body my-3"></div>').append(newForm1); // creation du panel-body and ajout du form
    $panel1.append($panelBody1); // ajout du body dans le panel

    addRemoveButton($panel1);// ajout du remove bouton dans le panel
    // faire  le .before dans ce sens sinon le bouton est au dessus
    $add.before($panel1); // ajout du panel a la function addNewItem
}

/*
 * ajout du boutone remove dans le formulaire
 *
 */
function addRemoveButton($panel) {
    var $removeButton1 = $('<a href="#" class="btn btn-danger">Supprimer</a>');// creation du  bouton
    var $panelFooter1 = $('<div class="panel-footer my-3"></div>').append($removeButton1);// ajout du remove dans le footer panel
    // recup du click sur remove
    $removeButton1.click(function (e) {
        e.preventDefault();
        $(e.target).parents('.panel').remove();
    });
    $panel1.append($panelFooter1);// ajout du footer sur le panel
}