
function deleteKey(key){
    $.ajax({
        url: "/keys/delKey",
        type : "POST",
        cache: false,
        data:{
            'key' : key,
        },
        success: function(data) {
            // console.log(key);
        },
    });
    elem =document.getElementById("row"+key);
    elem.remove();
}

function addKey(){
    steamKey = document.getElementById("steamKey").value;
    console.log(steamKey);
    description = document.getElementById("description").value;
    tag = document.getElementById("tag").value;
    select = document.getElementById("selectAccount");
    steamId = select.options[select.selectedIndex].value ;
    // console.log(keys);
    $.ajax({
        url: "/keys/addKey",
        type : "POST",
        cache: false,
        data:{
            'steamKey' : steamKey,
            'description' : description,
            'tag' : tag,
            'steamId' : steamId,
        },
        success: function(data) {
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