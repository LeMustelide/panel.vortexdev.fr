
function deleteVersion(id){
    $.ajax({
        url: "/aqg/version/delete",
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

function disableVersion(id){
    $.ajax({
        url: "/aqg/version/disable",
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

function enableVersion(id){
    $.ajax({
        url: "/aqg/version/enable",
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
    document.getElementById("action").setAttribute('onclick','deleteVersion(\''+id+'\'),closeForm()');
    document.getElementById("Form").style.display = "block";
}

function openFormDisable(id)
{
    document.getElementById("popUpBodyText").textContent = "Voulez-vous vraiment désactiver la version : "+ id + " ?";
    document.getElementById("popUpHeadText").textContent = "Confirmer la désactivation de la version : "+ id;
    document.getElementById("action").textContent = "désaciver";
    document.getElementById("action").setAttribute('onclick','disableVersion(\''+id+'\'),closeForm()');
    document.getElementById("Form").style.display = "block";
}

function openFormEnable(id)
{
    document.getElementById("popUpBodyText").textContent = "Voulez-vous vraiment activer la version : "+ id + " ?";
    document.getElementById("popUpHeadText").textContent = "Confirmer l'activation de la version : "+ id;
    document.getElementById("action").textContent = "Activer";
    document.getElementById("action").setAttribute('onclick','enableVersion(\''+id+'\'),closeForm()');
    document.getElementById("Form").style.display = "block";
}

function closeForm() 
{
    document.getElementById("Form").style.display = "none";
}

function openFormAdd()
{
    document.getElementById("addForm").style.display = "block";
}

function closeFormAdd()
{
    document.getElementById("addForm").style.display = "none";
}