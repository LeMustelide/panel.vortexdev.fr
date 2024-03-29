
function deleteKey(key) {
    $.ajax({
        url: "/aqg/keys/delete",
        type: "POST",
        cache: false,
        data: {
            'key': key,
        },
    });
}

function addKey() {
    let steamKey = document.getElementById("steamKeyForm").value;
    let description = document.getElementById("descriptionAdd").value;
    let tag = document.getElementById("tagAdd").value;
    let select = document.getElementById("selectAccount");
    let steamId = select.options[select.selectedIndex].value;
    $.ajax({
        url: "/aqg/keys/add",
        type: "POST",
        cache: false,
        data: {
            'steamKey': steamKey,
            'description': description,
            'tag': tag,
            'steamId': steamId,
        },
        success: function (data) {
            document.location.reload(true);
        },
        error: function () {
            alert('erreur ajax');
        }
    });
    
}

function openFormDelete(id) {
    document.getElementById("popUpBodyText").textContent = "Voulez-vous vraiment supprimer : " + id + " ?";
    document.getElementById("popUpHeadText").textContent = "Confirmer la suppression de : " + id;
    document.getElementById("action").setAttribute('onclick', 'deleteKey(\'' + id + '\'),closeFormDelete()');
    document.getElementById("deleteForm").style.display = "block";
}

function closeFormDelete() {
    document.getElementById("deleteForm").style.display = "none";
}

function openFormAdd() {
    document.getElementById("addForm").style.display = "block";
}

function closeFormAdd() {
    document.getElementById("addForm").style.display = "none";
}

function openFormModify(key) {
    let description = document.getElementById("row" + key).querySelector("#description").textContent;
    let tag = document.getElementById("row" + key).querySelector("#tag").textContent;
    let steamID = document.getElementById("row" + key).querySelector("#steamID").textContent;
    let steamKey = document.getElementById("row" + key).querySelector("#steamKey").textContent;

    document.getElementById("popUpHeadTextModify").textContent = "modify la clé : " + steamKey;
    document.getElementById("steamKeyModify").value = steamKey;
    document.getElementById("descriptionModify").value = description;
    document.getElementById("tagModify").value = tag;
    document.getElementById("selectAccountModify").value = steamID;
    document.getElementById("id").value = key;

    document.getElementById("modifyForm").style.display = "block";
}

function closeFormModify() {
    document.getElementById("modifyForm").style.display = "none";
}

function modifyKey() {
    let id = document.getElementById("id").value;
    let steamKey = document.getElementById("steamKeyModify").value;
    let description = document.getElementById("descriptionModify").value;
    let tag = document.getElementById("tagModify").value;
    let select = document.getElementById("selectAccountModify");
    let steamId = select.options[select.selectedIndex].value;
    $.ajax({
        url: "/aqg/keys/modify",
        type: "POST",
        cache: false,
        data: {
            "id": id,
            'steamKey': steamKey,
            'description': description,
            'tag': tag,
            'steamId': steamId,
        },
        success: function () {
        },
        error: function () {
            alert('erreur ajax');
        }
    });
    document.location.reload(true);
}