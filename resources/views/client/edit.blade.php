<div class="modal-container" id="client-edit-modal">

    <div class="modal-title primary">
        <span class="form-ht">クライアント編集</span>
        <span class="fa fa-chevron-up close" onclick="closeModal('client-edit-modal')"></span>
    </div>

    <div class="modal-form-container _user">
        <form id="edit_form" action="" method="">
            @csrf

            <div class="row">
                <div class="column left">
                    <div>
                        <img src="{{ asset('img/dp.png') }}" class="dp" alt="display photo">
                    </div>

                    <div>
                        <button type="submit" onclick="updateClient()">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i>
                            更新
                        </button>
                    </div>

                    <div>
                        <button type="submit" class="cancel" onclick="closeModal('client-edit-modal')">
                            <i class="fa fa-times" aria-hidden="true"></i> 戻る
                        </button>
                    </div>

                    @if ($loggedInUser->user_authority == config('constants.User_authority.システム管理者'))
                        <div onclick="deleteClient()">
                            <a class="button delete-button" id="deleteButton"> <i class="fa fa-trash-o"
                                    aria-hidden="true"></i>
                                削除</a>
                        </div>
                    @endif
                </div>

                <div class="column right _user">
                    <input type="hidden" id="id" value="{{ $client->client_id }}">

                    <div class="modal-form-input-container">
                        <div class="_full">
                            <div><label for="name">名前</label></div>
                            <div><input type="text" id="client_edit_nameInput" name="name" value="{{ $client->client_name }}" required></div>
                        </div>
                    </div>

                    <div class="modal-form-input-container">
                        <div>
                            <div><label>Point of Contact Person ID</label></div>
                            <div><input type="number" id="client_edit_user_id" name="user_id" value="{{ $client->user_id }}"></div> 
                        </div>  
                    </div>
                </div>

            </div>

        </form>
    </div>
</div>


<script>
    function getFormData() {
        return {
            id: $('#id').val(),
            customer_name: $('#name').val(),
            point_of_contact_person_id: $('#point_of_contact_person_id').val(),
            _token: $('input[name=_token]').val()
        };
    }

    function handleAJAXResponse(response) {

        if (response["resultStatus"]["isSuccess"])
            $('#message').html("Operation Succesful");

        else if (response["resultStatus"]["errorMessage"] === "UNAUTHORIZED_ACTION")
            $('#message').html("You are not authorized to make this change");

        else
            $('#message').html("Unhandled Status: " + response["resultStatus"]["errorMessage"]);
    }

    function handleAJAXError(err) {
        console.log(err);
        if (err.status == "422") {
            if (err.responseJSON.errors.point_of_contact_person_id != null) {
                $('#message').html("エラー　： " + "担当者が入力していないです。");
            }
            if (err.responseJSON.errors.customer_name != null) {
                $('#message').html("エラー　： " + "顧客名が入力していないです。");
            }
        }
    }

    $(document).ready(function() {
        $('#edit_form').submit(function(e) {
            console.log(getFormData());
            e.preventDefault();

            $.ajax({
                type: "post",
                url: "/API/updateClient",
                data: getFormData(),
                cache: false,
                success: function(response) {
                    handleAJAXResponse(response);
                },
                error: function(err) {
                    handleAJAXError(err);
                }
            });
        });
    });

// ---------------------------------------------

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

    function handleAJAXError(err) {
        console.log(err);
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

        for (let i = 0; i < data.length; i++) {
            if (data[i] == null)
                data[i] = "";
        }

        $("#id").val(data.client_id)
        $("#client_edit_nameInput").val(data.name)
        $("#client_edit_user_id").val(data.user_ID)
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

        $.ajax({
            type: "post",
            url: "/API/deleteClient",
            data: {
                id: clientId,
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

