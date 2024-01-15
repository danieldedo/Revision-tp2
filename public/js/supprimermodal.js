

$(document).ready(function () {

    $('.supprimerlivre').on('click', function() {
        let livreId = $(this).data('id');
        console.log(livreId)
        $('#confirmDelete').attr('href', "/livre/__id__/delete".replace('__id__', livreId))
    });


    $('.supprimeremprunt').on('click', function() {
        let empruntId = $(this).data('id');
        console.log(empruntId)
        $('#confirmDelete').attr('href', "/emprunt/__id__/delete".replace('__id__', empruntId))
    });
});