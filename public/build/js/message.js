$('#reponseSujet').click(function(){
    var url = window.location.href;
    var id = url.substr(url.lastIndexOf('/') + 1);

    //récupération des valeurs
    var post = {
        "corps": $('#comment').val()
    }
    
    $.ajax({
            method: "post",
            url: window.location + "/create",
            data: post,
        }).done(function (response) {
//            $('#toggleForm').notify("Votre publication à bien été enregistrée", "success");
            $('#comment').val("");
            addMsg(response)
//            window.location.href = window.location.href;
            console.log((response));
        }).fail(function (xhr, status, error) {
//            $.notify("Une erreur est survenue, nous sommes désolés", "error");
            alert(xhr.responseText)
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

function formatDate(date){
    var dateFormated;
    var year = date.substr(0, 4);
    var month = date.substr(5, 2);
    var day = date.substr(8, 2);
    var hour = date.substr(11, 2);
    var minute = date.substr(14, 2);
    var seconde = date.substr(17, 2);

    dateFormated = day+'/'+month+'/'+year+' '+hour+':'+minute+':'+seconde;
    return dateFormated
}
