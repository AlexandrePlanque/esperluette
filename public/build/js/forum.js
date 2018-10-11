$(window).on('load', function() { 
    //au chargement de la page on cache les elements non souhaité
    $('.forumContent').hide();
    //puis on affiche l'element qu'on a defini par defaut
    $('#tabForum div').first().show();
});

$(document).ready(function() {    
    //retrait du display none dédié à éviter les affichages non souhaités

    $("#tabForum").removeClass("hidden")
    $(".forumContent").removeClass("hidden")

    //alternative à la propriété text-overflow : ellipsis; pour éviter les débordements
    
    var content = $('.paragraphCard').html();
    //récupération du texte avant de le tronquer
    $('.paragraphCard').text($('.paragraphCard').html().substr(0, 75) + '...');

});


$(".btn-pref .btn").click(function () {
    // on cache les differentes parties du forum
    $('.forumContent').hide();
    //on retire le mode actif du bouton courant avant de l'assigner à un nouveau
    $(".btn-pref .btn").removeClass("btn-primary").addClass("btn-default");
    $(this).removeClass("btn-default").addClass("btn-primary");

    //on affiche la section souhaité grace à l'ID placé sur l'element courant
    $( $(this).attr('id') ).show();
});