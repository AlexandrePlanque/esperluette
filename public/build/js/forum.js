var currentTab;
var statusHide = false;
$(window).on('load', function() { 
    //au chargement de la page on cache les elements non souhaité
    $('.forumContent').hide();
    $('.ajoutPubli').hide();
    //puis on affiche l'element qu'on a defini par defaut
    $('#tabForum div').first().show();
    currentTab = $('#tabForum div').first();
    $('#btnCatForum a').first().addClass("aActive");

});

$(document).ready(function() {    
    //retrait du display none dédié à éviter les affichages non souhaités

    $("#tabForum").removeClass("hidden")
    $(".forumContent").removeClass("hidden")

    //alternative à la propriété text-overflow : ellipsis; pour éviter les débordements
    
//    var content = $('.paragraphCard').html();

    //récupération du texte avant de le tronquer
//    $('.description').text($('.description').text().substr(0, 30) + '...');

});


$("#btnCatForum a").click(function (e) {
    e.preventDefault();
    // on cache les differentes parties du forum
    $('.forumContent').hide();
    //on retire le mode actif du bouton courant avant de l'assigner à un nouveau
    $("#btnCatForum a").removeClass("aActive");
    $(this).addClass("aActive");

    //on affiche la section souhaité grace à l'ID placé sur l'element courant
    $( $(this).attr('href') ).show();
    currentTab = $( $(this).attr('href') );
});

$('.table-bordered tbody tr').click(function(){
   window.location.href = window.location + "/sujet/" + $(this).attr('id');
});

$('#publicationForm').submit(function(e){
    //annulation de l'event submit du form
    e.preventDefault();
    
    //récupération des valeurs
    var post = {
        "forum" : $("#btnCatForum a.aActive span").text(),
        "intitule" : $('#titre').val(),
        "corps": $('#corps').val()
    }
    
    $.ajax({
            method: "post",
            url: window.location + "/sujet/create",
            data: post,
        }).done(function (response) {
            $('#toggleForm').notify("Votre publication à bien été enregistrée", "success");
            $('#titre').val("");
            $('#corps').val("");
            statusHide = !statusHide;
            $('.ajoutPubli').hide();
            currentTab.show();
            $('#toggleForm').addClass("btn-info");
            $('#toggleForm').removeClass("btn-danger");
            $('#toggleForm').text("Publier");
            
//            console.log((response));
        }).fail(function (xhr, status, error) {
            $.notify("Une erreur est survenue, nous sommes désolés", "error");
            alert(xhr.responseText)
            console.log(status);
            console.log(error);
        });
})

    // fonction dédié à un jeu de hide and show entre le formulaire de création de sujet et la liste des sujets
$('#toggleForm').click(function(){
    
    if(!statusHide){
        statusHide = true;
        $('.ajoutPubli').show();
        currentTab.hide();
        $('#toggleForm').removeClass("btn-info");
        $('#toggleForm').addClass("btn-danger");
        $('#toggleForm').text("Annuler");
    }else{
        statusHide = false;
        $('.ajoutPubli').hide();
        currentTab.show();
        $('#toggleForm').addClass("btn-info");
        $('#toggleForm').removeClass("btn-danger");
        $('#toggleForm').text("Publier");
    }
});


