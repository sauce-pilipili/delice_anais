
let $collectionHolderdominante;
let $collectionHolderindispensable;
const $addNewItemDominante = $('<a href="#" class="btn btn-outline-info">Ajouter un ingredient</a>');
const $addNewItemIndispensable = $('<a href="#" class="btn btn-outline-info">Ajouter une étape</a>');
$(document).ready(function () {
    indispensable();
    dominante();
});
function dominante() {
    $collectionHolderdominante = $('#ingredient');
    $collectionHolderdominante.append($addNewItemDominante);
    $collectionHolderdominante.data('index', $collectionHolderdominante.find('.panel').length);
    $collectionHolderdominante.find('.panel').each(function () {
        addRemoveButton($(this));
    });
    $addNewItemDominante.click(function (e) {
        e.preventDefault();
        addNewFormDominante();
    })
};
function indispensable() {
    $collectionHolderindispensable = $('#directions');
    $collectionHolderindispensable.append($addNewItemIndispensable);
    $collectionHolderindispensable.data('index', $collectionHolderindispensable.find('.panel').length)
    $collectionHolderindispensable.find('.panel').each(function () {
        addRemoveButton($(this));
    });
    $addNewItemIndispensable.click(function (e) {
        e.preventDefault();

        addNewFormIndispensable();
    })
};
function addNewFormDominante() {

    let prototypeDominante = $collectionHolderdominante.data('prototype');
    let index = $collectionHolderdominante.data('index');// recup de l'index
    let newFormDominante = prototypeDominante; // creation du formulaire
    newFormDominante = newFormDominante.replace(/__name__/g, index); // remplace le __name__  dans le  html avec la valeur de l'index
    $collectionHolderdominante.data('index', index + 1);// ajout de 1 a l'index
    let $panelDominante = $('<div class="panel"></div>');// panel auquel on ajout le collectionHolder
    let $panelBodyDominante = $('<div class="panel-body"></div>').append(newFormDominante); // creation du panel-body and ajout du form
    $panelDominante.append($panelBodyDominante); // ajout du body dans le panel
    addRemoveButton($panelDominante);// ajout du remove bouton dans le panel
    // faire  le .before dans ce sens sinon le bouton est au dessus
    $addNewItemDominante.before($panelDominante); // ajout du panel a la function addNewItem
}
function addNewFormIndispensable() {

    let prototypeIndispensable = $collectionHolderindispensable.data('prototype');
    let index = $collectionHolderindispensable.data('index');// recup de l'index
    let newFormIndispensable = prototypeIndispensable; // creation du formulaire
    newFormIndispensable = newFormIndispensable.replace(/__name__/g, index); // remplace le __name__  dans le  html avec la valeur de l'index
    $collectionHolderindispensable.data('index', index + 1);// ajout de 1 a l'index
    let $panelIndispensable = $('<div class="panel"></div>');// panel auquel on ajout le collectionHolder
    let $panelBody = $('<div class="panel-body"></div>').append(newFormIndispensable); // creation du panel-body and ajout du form
    $panelIndispensable.append($panelBody); // ajout du body dans le panel
    addRemoveButton($panelIndispensable);// ajout du remove bouton dans le panel
    // faire  le .before dans ce sens sinon le bouton est au dessus
    $collectionHolderindispensable.before($panelIndispensable); // ajout du panel a la function addNewItem
}


/*
 * ajout du boutone remove dans le formulaire
 *
 */
function addRemoveButton($panel) {
    var $removeButton = $('<a href="#" class="btn btn-danger">Supprimer</a>');// creation du  bouton

    var $panelFooter = $('<div class="panel-footer"></div>').append($removeButton);// ajout du remove dans le footer panel
    // recup du click sur remove
    $removeButton.click(function (e) {
        e.preventDefault();
        // petite animation de la remonté du panel en cas re remove
        $(e.target).parents('.panel').remove();
    });

    $panel.append($panelFooter);// ajout du footer sur le panel
}

//
// .slideUp(1000, function () {
//     $(this).remove();
//  })