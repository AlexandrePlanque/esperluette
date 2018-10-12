// initialisation de la page actuelle à 1 par défaut
var currentPage = 1;


// event listener mis en place pour l'envoi des messages
$('#reponseSujet').click(function(){

    //récupération des valeurs
    var post = {
        "corps": $('#comment').val()
    }
    
    $.ajax({
            method: "post",
            url: window.location + "/create",
            data: post,
        }).done(function (response) {
            $('#toggleForm').notify("Votre publication à bien été enregistrée", "success");
            $('#comment').val("");
            //fonction ajoutant le message à la suite des autres
            addMsg(response)

            console.log((response));
        }).fail(function (xhr, status, error) {
            $.notify("Une erreur est survenue, nous sommes désolés", "error");
//            alert(xhr.responseText)
            console.log(status);
            console.log(error);
        });
})

function addMsg(data){
    $(".msgListing").append(
            $('<div>').addClass('card mb-2').append(
            $('<div>').addClass('card-body').append(
            $('<div>').addClass('card-title cardMessage').append(
            $('<span>').addClass('card-title nomPrenomMessage').append($('<strong>').text(data.userP+" "+data.userN))).append(
            $('<span>').addClass('float-right').text(formatDate(data.date)))).append(
            $('<hr>')).append(
            $('<p>').text(data.corps))))
}



//formatage de la date
function formatDate(date){
    var dateFormated;
    //les valeurs sont hardcoded car le format qui est retourné par le controlleur n'est pas variable
    var year = date.substr(0, 4);
    var month = date.substr(5, 2);
    var day = date.substr(8, 2);
    var hour = date.substr(11, 2);
    var minute = date.substr(14, 2);
    var seconde = date.substr(17, 2);
    // concatenation de chacunes des valeurs récuperées précédemment
    dateFormated = day+'/'+month+'/'+year+' '+hour+':'+minute+':'+seconde;
    
    return dateFormated
}


// lors du chargement mise en place du systeme de pagination si necessaire
$(document).ready(function(){
    $("#page").hide();
    
    //Si le nombre de message est supérieur, intégration de la pagination sur l'UI
    if($('.msgListing .card').length > 5){
        $("#page").show();
        var thisPage = 1;
//        alert($('.msgListing .card').length%5)
        for (var i = 0; i < $('.msgListing .card').length;i++){
            if(i%5 == 0){

            //création des éléments avant des les insérer avant l'element ayant l'id next
                $('<li>').addClass('page-item').append(
                    $('<a>').addClass('page-link').attr("onclick", "pagination("+thisPage+')').text(thisPage)).insertBefore($("#next"))
            
            thisPage++;
            }
        }
    }
    
    pagination(1);
})

//fonction permettant la gestion de la pagination homemade
function pagination(nbPage){
    
    var nbMsg = $('.msgListing .card').length;
    
    var incrementeur = 5;
    
    var rangeMin, rangeMax;

    (nbPage === 1)?rangeMin = 0: rangeMin = 0+(incrementeur*(nbPage-1));
    (nbPage === 1)?rangeMax = 4: rangeMax = 4+(incrementeur*(nbPage-1));
    
    for(var i = 0; i < nbMsg; i++){
        
        if(i>=rangeMin & i<=rangeMax){
            var currentObj = $('.msgListing .card')[i];
            $(currentObj).show()
        }else{
            var currentObj = $('.msgListing .card')[i];
            $(currentObj).hide()
            
        }

    }
    
}


//complément à la pagination pour les fleches precedent & suivant
function nextPrev(n){
    var limit = $('.msgListing .card').length % 5;
    var condition = currentPage + n;
//    (condition > 1)? true : false;
//    (condition < limit)?true : false;
//    currentPage += n;
    if((condition >= 1) && (condition < limit)){
    pagination(currentPage += n)
    }
}