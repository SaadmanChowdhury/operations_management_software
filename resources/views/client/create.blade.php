<div class="modal-container" id="client-create-modal">

    <div class="modal-title midori">
        <span class="form-ht">クライアント登録</span>
        <span class="fa fa-chevron-up close" onclick="closeModal('client-create-modal')"></span>
    </div>

    <div class="modal-form-container _client">
        <form id="reg_form" action="" method="">
            @csrf

            <div class="row">

                <div class="column left">
                    <div>
                        <img src="{{ asset('img/client_dp.png') }}" class="dp _client" alt="display photo">
                    </div>

                    <div>
                        <button type="submit" onclick="createClient()"><i class="fa fa-floppy-o" aria-hidden="true"></i>
                            登録</button>
                    </div>

                    <div>
                        <button type="submit" class="cancel" onclick="closeModal('client-create-modal')"><i
                                class="fa fa-times" aria-hidden="true"></i> 戻る</button>
                    </div>
                </div>

                <div class="column right _client">
                    <div class="modal-form-input-container">
                        <div class="_full">
                            <div><label for="name">顧客名<span class="reruired-field-marker">*</span></label></div>
                            <div><input type="text" id="client_create_name_Input" name="name" required></div>
                        </div>
                    </div>

                    <div class="_full">
                        <div><label for="user_id">顧客に責任者<span class="reruired-field-marker">*</span></label></div>
                        <div><input type="number" id="client_create_userID_Input" name="user_id" required></div>
                    </div>
                </div>

            </div>
            <div id="message"></div>

        </form>
    </div>
</div>



<script>
$(function() {
    convertToSearchableDropDown("client_create_userID_Input", "USER");
})

function clientRegisterModalHandler() {
    event.preventDefault();
    showModal('client-create-modal');
}

function getClientRegFormData() {
    return {
        client_name: $('#client_create_name_Input').val(),
        user_id: $('#client_create_userID_Input').val(),
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

function createClient() {
    event.preventDefault();
    modalData = getClientRegFormData();

    $.ajax({
        type: "post",
        url: "/API/createClient",
        data: modalData,
        cache: false,
        success: function(response) {
            if (response["resultStatus"]["isSuccess"]) {
                updateClientTable(modalData);
                closeModal('client-create-modal');
            } else
                handleAJAXResponse(response);
        },
        error: function(err) {
            handleAJAXError(err);
        }
    });
}
</script>