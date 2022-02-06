

function supprimerKey(id){
    nb = id.slice(3);
    keys =document.getElementsByTagName('table')[0].getElementsByTagName('tr')[nb].cells[1].innerHTML;
    console.log(keys);
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
}

function supprimerKey2(id)
{
    nb = id.slice(3);
    elem =document.getElementById("key"+nb);
   
    elem.remove();
}