
function supprimerKey(id){
    console.log(id);
    nb = id.slice(3);
    keys = document.getElementsByTagName('table')[0].getElementsByTagName('tr')[nb].cells[1].innerHTML;
    // console.log(keys);
    $.ajax({
        url: "/keys/supKeys",
        type : "POST",
        cache: false,
        data:{
            'keys' : keys,
        },
        success: function(data) {
            console.log(keys);
        },
    });
    elem =document.getElementById("key"+nb);
    elem.remove();
}


function openForm(id)
{
    console.log('supprimerKey('+id+')');
    document.getElementById("action").setAttribute('onclick','supprimerKey(\''+id+'\'),closeForm()');
    document.getElementById("deleteForm").style.display = "block";
}

function closeForm() 
{
    document.getElementById("deleteForm").style.display = "none";
}