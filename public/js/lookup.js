USER_LIST = [];
CLIENT_LIST = [];

// function convertClientDOM(className) {
//     $("." + className);
// }


function convertClient_IDToName(id) {
    for (let i = 0; i < CLIENT_LIST.length; i++) {
        if (CLIENT_LIST[i].id == id)
            return CLIENT_LIST[i].name;
    }

    return "";
}
function convertUser_IDToName(id) {
    for (let i = 0; i < USER_LIST.length; i++) {
        if (USER_LIST[i].id == id)
            return USER_LIST[i].name;
    }
    return "";
}

function convertClient_nameToID(name) {
    for (let i = 0; i < CLIENT_LIST.length; i++) {
        if (CLIENT_LIST[i].name == name)
            return CLIENT_LIST[i].id;
    }
    return "";
}

function convertUser_nameToID(name) {
    for (let i = 0; i < USER_LIST.length; i++) {
        if (USER_LIST[i].name == name)
            return USER_LIST[i].id;
    }
    return "";
}

function fetchUserList() {
    $.ajax({

        type: "post",
        url: "/API/fetchUserLookup",
        data: {
            _token: $('#csrf-token')[0].content,
        },
        cache: false,

        success: function (response) {

            USER_LIST = response;

        },
        error: function (err) {
            console.log(err)
        }
    });
}

function fetchClientList() {
    $.ajax({

        type: "post",
        url: "/API/fetchClientLookup",
        data: {
            _token: $('#csrf-token')[0].content,
        },
        cache: false,

        success: function (response) {

            CLIENT_LIST = response;


            //console.log(response);

            if (response.length > 0) {

                //  console.log(response);
            }
            else {


                if (typeof showEmptyListInfromation !== "undefined")
                    showEmptyListInfromation(".client");

            }


        },
        error: function (err) {
            console.log(err)
        }
    });
}

function convertToSearchableDropDown(id, type) {
    dom = $("#" + id);
    let options = "";
    currentVal = $(dom).val();

    if (type == "USER" && USER_LIST.length > 0) {
        options = userSelectGenerator();
    }
    else if (type == "CLIENT" && CLIENT_LIST > 0) {
        options = clientSelectGenerator();
    }

    else {

        setTimeout(() => {
            convertToSearchableDropDown(id, type);
        }, 50);

        return;
    }

    $(dom).replaceWith(`<select id="${id}">${options}</select>`);
    $(dom).val(currentVal);
}

function userSelectGenerator() {
    innerHTML = "";

    for (let i = 0; i < USER_LIST.length; i++)
        innerHTML += `<option value="${USER_LIST[i].id}">${USER_LIST[i].name}</option>`;

    return innerHTML;

}

function clientSelectGenerator() {

    innerHTML = "";

    for (let i = 0; i < CLIENT_LIST.length; i++)
        innerHTML += `<option value="${CLIENT_LIST[i].id}">${CLIENT_LIST[i].name}</option>`;

    return innerHTML;
}