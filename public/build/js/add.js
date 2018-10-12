/*Ajoute une liste de reponses en BDD*/
$('#addQuest').submit(function (e) {
    e.preventDefault(e);

    var data = {
        "1": $("#quest1").val(),
        "2": $("#quest2").val(),
        "3": $("#quest3").val(),
        "4": $("#quest4").val(),
        "5": $("#quest5").val(),
        "6": $("#quest6").val(),
        "7": $("#quest7").val(),
        "8": $("#quest8").val(),
        "9": $("#quest9").val(),
        "10": $("#quest10").val(),
        "11": $("#quest11").val(),
        "12": $("#quest12").val(),
        "13": $("#quest13").val(),
        "14": $("#quest14").val(),
        "15": $("#quest15").val(),
        "16": $("#quest16").val(),
        "17": $("#quest17").val(),
        "18": $("#quest18").val(),
        "19": $("#quest19").val()
    };

    console.log(data);

    $.ajax({
        url : "http://esperluette/add",
        type : "POST",
        
        data : data,
        
        success : function(donne){
            $.notify('Votre formulaire à été valider, merci d\'avoir pris le temps de répondre', 'success');
//            console.log(donne);
        },
        
        error : function (xhr, status, error) {
            $.notify('Une erreur est survenue, veuillez nous excusez', 'danger');
            console.log(xhr.responseText)
        }
    });
})