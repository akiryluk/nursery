'use strict';

/////////////////////////////////////////////////////////////////////////////////////////
// FONCTIONS                                                                           //
/////////////////////////////////////////////////////////////////////////////////////////
function runFormValidation()
{
    var $form;
    var formValidator;

    $form = $('form:not([data-no-validation=true])');

    // Y a t'il un formulaire à valider sur la page actuelle ?
    if($form.length == 1)
    {
        // Oui, exécution de la validation de formulaire.
        formValidator = new FormValidator($form);
        formValidator.run();
    }
}



/////////////////////////////////////////////////////////////////////////////////////////
// CODE PRINCIPAL                                                                      //
/////////////////////////////////////////////////////////////////////////////////////////
$(function()
{

    // Exécution de la validation de formulaire si besoin.
    runFormValidation();

}); 
