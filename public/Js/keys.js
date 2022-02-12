
function deleteKey(key){
    $.ajax({
        url: "/keys/delete",
        type : "POST",
        cache: false,
        data:{
            'key' : key,
        },
        success: function(data) {
            document.location.reload(true);
            /*var elem = document.getElementById("row"+key);
            elem.remove();*/
        },
    });

}

function addKey(){
    var steamKey = document.getElementById("steamKey").value;
    var description = document.getElementById("description").value;
    var tag = document.getElementById("tag").value;
    var select = document.getElementById("selectAccount");
    var steamId = select.options[select.selectedIndex].value ;
    $.ajax({
        url: "/keys/add",
        type : "POST",
        cache: false,
        data:{
            'steamKey' : steamKey,
            'description' : description,
            'tag' : tag,
            'steamId' : steamId,
        },
        success: function(data) {
            document.location.reload(true);
            /*var elem = document.createElement('tr');
            document.getElementById('tbody').appendChild(elem);*/
        },
    });
}


function openFormDelete(id)
{
    console.log('deleteKey('+id+')');
    document.getElementById("popUpBodyText").textContent = "Voulez-vous vraiment supprimer : "+ id + " ?";
    document.getElementById("popUpHeadText").textContent = "Confirmer la suppression de : "+ id;
    document.getElementById("action").setAttribute('onclick','deleteKey(\''+id+'\'),closeFormDelete()');
    document.getElementById("deleteForm").style.display = "block";
}

function closeFormDelete() 
{
    document.getElementById("deleteForm").style.display = "none";
}

function openFormAdd()
{
    document.getElementById("addForm").style.display = "block";
}

function closeFormAdd() 
{
    document.getElementById("addForm").style.display = "none";
}