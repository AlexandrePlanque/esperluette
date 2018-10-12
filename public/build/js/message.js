$('#reponseSujet').click(function(){
    var url = window.location.href;
    var id = url.substr(url.lastIndexOf('/') + 1);

    //récupération des valeurs
    var post = {
        "sujet" : this.href.substr(this.href.lastIndexOf('/') + 1),
        "corps": $('#comment').val()
    }
    
    $.ajax({
            method: "post",
            url: window.location + "/message/create",
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