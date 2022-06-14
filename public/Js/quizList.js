
function deleteQuiz(id){
    $.ajax({
        url: "/aqg/quiz/delete",
        type : "POST",
        cache: false,
        data:{
            'id' : id,
        },
        success: function(data) {
            document.location.reload(true);
        },
    });
}


function publishQuiz(id){
    $.ajax({
        url: "/aqg/quiz/publish",
        type : "POST",
        cache: false,
        data:{
            'id' : id,
        },
        success: function(data) {
            document.location.reload(true);
        },
    });
}

function unpublishQuiz(id){
    $.ajax({
        url: "/aqg/quiz/unpublish",
        type : "POST",
        cache: false,
        data:{
            'id' : id,
        },
        success: function(data) {
            document.location.reload(true);
        },
    });
}

function openFormDelete(id)
{
    document.getElementById("popUpBodyText").textContent = "Voulez-vous vraiment supprimer : "+ id + " ?";
    document.getElementById("popUpHeadText").textContent = "Confirmer la suppression de : "+ id;
    document.getElementById("action").textContent = "Supprimer";
    document.getElementById("action").setAttribute('onclick','deleteQuiz(\''+id+'\'),closeForm()');
    document.getElementById("Form").style.display = "block";
}

function openFormPublish(id)
{
    document.getElementById("popUpBodyText").textContent = "Voulez-vous vraiment publier : "+ id + " ?";
    document.getElementById("popUpHeadText").textContent = "Confirmer la publication du quiz : "+ id;
    document.getElementById("action").textContent = "Publier";
    document.getElementById("action").setAttribute('onclick','publishQuiz(\''+id+'\'),closeForm()');
    document.getElementById("Form").style.display = "block";
}

function openFormUnpublish(id)
{
    document.getElementById("popUpBodyText").textContent = "Voulez-vous vraiment dépublier : "+ id + " ?";
    document.getElementById("popUpHeadText").textContent = "Confirmer la dépublication du quiz : "+ id;
    document.getElementById("action").textContent = "Dépublier";
    document.getElementById("action").setAttribute('onclick','unpublishQuiz(\''+id+'\'),closeForm()');
    document.getElementById("Form").style.display = "block";
}

function closeForm() 
{
    document.getElementById("Form").style.display = "none";
}
