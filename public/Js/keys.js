function supprimerKey(){
    var keys = document.getElementById("keystr").value;

    $.ajaxSetup({
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