<div class="modal-container" id="client-edit-modal">

    <div class="modal-title midori">
        <span class="form-ht">クライアント編集</span>
        <span class="fa fa-chevron-up close" onclick="closeModal('client-edit-modal')"></span>
    </div>

    <div class="modal-form-container _client">
        <form id="edit_form" action="" method="">
            @csrf

            <div class="row">
                <div class="column left">
                    <div>
                        <img src="{{ asset('img/client_dp.png') }}" class="dp _client" alt="display photo">
                    </div>
                    <div>
                        <span>アクティブ</span>
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div class="fav">
                        <span>お気に入り</span>
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider round"></span>
                        </label>
                    </div>

                    <div>
                        <button type="submit" onclick="updateClient()">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                            更新
                        </button>
                    </div>

                    <div>
                        <button type="submit" class="cancel" onclick="closeModal('client-edit-modal')">
                            <i class="fa fa-times" aria-hidden="true"></i> 戻る
                        </button>
                    </div>

                    @if ($loggedInUser->user_authority == 'システム管理者')
                    <div onclick="deleteClient()">
                        <a class="button delete-button" id="deleteButton"> <i class="fa fa-trash-o"
                                aria-hidden="true"></i>
                            削除</a>
                    </div>
                    @endif
                </div>

                <div class="column right _client">
                    <input type="hidden" id="id" value="{{ $client->client_id }}">

                    <div class="modal-form-input-container">
                        <div class="_half">
                            <div><label for="clientID">顧客コード<span class="reruired-field-marker">*</span></label></div>
                            <div><input class="modal_input" type="text" id="client_edit_clientID" name="clientID"
                                     required></div>
                        </div>
                        <div class="_half">
                            <div><label for="name">顧客名<span class="reruired-field-marker">*</span></label></div>
                            <div><input class="modal_input" type="text" id="client_edit_nameInput" name="name"
                                    value="{{ $client->client_name }}" required></div>
                        </div>
                    </div>

                    <div class="modal-form-input-container">
                        <div class="_full">
                            <div><label>顧客に責任者<span class="reruired-field-marker">*</span></label></div>

                            <div><input class="modal_input" type="number" id="client_edit_user_id" name="user_id"
                                    value="{{ $client->user_id }}"></div>

                        </div>

                    </div>
                </div>

            </div>

        </form>
    </div>
</div>


<script>
$(function() {
    convertToSearchableDropDown("client_edit_user_id", "USER");

    @if($loggedInUser->user_authority != 'システム管理者')
    document.getElementById("client_edit_user_id").disabled = true;
    @endif

})

function clientEditModalHandler(clientID) {
    event.preventDefault();
    clearModalData('client-edit-modal');
    showModal('client-edit-modal');

    getClientData(clientID);
}

function getClientEditFormData() {
    return {
        id: $('#id').val(),
        client_name: $('#client_edit_nameInput').val(),
        user_id: $('#client_edit_user_id').val(),
        _token: $('input[name=_token]').val()
    };
}

function handleAJAXResponse(response) {

    if (response["resultStatus"]["isSuccess"])
        updateClientTable();

    else if (response["resultStatus"]["errorMessage"] === "UNAUTHORIZED_ACTION")
        $('#message').html("You are not authorized to make this change");

    else
        $('#message').html("Unhandled Status: " + response["resultStatus"]["errorMessage"]);
}

function updateClientTable(updatedData) {
    console.log(updatedData);

    console.log("UDPATE Client TABLE")

    let row = $("#client-row-" + updatedData.id);

    row.find(".client-name").html(updatedData.name);
    row.find(".client-userID").html(updatedData.userID);


    positionDom = row.find(".pos");
    positionDom.html(updatedData.positionText);
    positionDom.removeClass();
    positionDom.addClass("pos");
    positionDom.addClass("pos-" + updatedData.positionText);

}

function updateClientEditModalData(data) {
    console.log(data);
    for (let i = 0; i < data.length; i++) {
        if (data[i] == null)
            data[i] = "";
    }

    $("#id").val(data.client_id)
    $("#client_edit_nameInput").val(data.client_name)
    $("#client_edit_user_id").val(data.user_id)
}

function getClientData(clientID) {
    $.ajax({
        type: "post",
        url: "/API/readClient",
        data: {
            clientID: clientID,
            _token: $('input[name=_token]').val()
        },
        cache: false,
        success: function(response) {
            if (response["resultStatus"]["isSuccess"]) {
                updateClientEditModalData(response["resultData"]);
            } else
                handleAJAXResponse(response);
        },
        error: function(err) {
            handleAJAXError(err);
        }
    });
}

function updateClient() {
    event.preventDefault();

    modalData = getClientEditFormData();

    $.ajax({
        type: "post",
        url: "/API/updateClient",
        data: modalData,
        cache: false,
        success: function(response) {
            if (response["resultStatus"]["isSuccess"]) {
                updateClientTable(modalData);
                closeModal('client-edit-modal');
            } else
                handleAJAXResponse(response);
        },
        error: function(err) {
            handleAJAXError(err);
        }
    });
}

function deleteClient() {
    event.preventDefault();
    clientId = $('#id').val();
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085D6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            deleteClientComfirmation(clientId);
            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            )
        }
    })
}

function deleteClientComfirmation(clientId) {
    $.ajax({
        type: "post",
        url: "/API/deleteClient",
        data: {
            clientID: clientId,
            _token: $('input[name=_token]').val()
        },
        cache: false,
        success: function(response) {
            if (response["resultStatus"]["isSuccess"])
                $("#client-row-" + clientId).remove();
            else
                handleAJAXResponse(response);
            closeModal('client-edit-modal');
        },
        error: function(err) {
            handleAJAXError(err);
        }
    });
}
</script>