<div class="modal-container" id="client-create-modal">

    <div class="modal-title mild-midori">
        <span class="form-ht">クライアント登録</span>
        <span class="fa fa-chevron-up close" onclick="closeModal('client-create-modal')"></span>
    </div>

    <div class="modal-form-container _user">
        <form id="reg_form" action="" method="">
            @csrf

            <div class="row">

                <div class="column left">
                    <div>
                        <img src="{{ asset('img/user_dp.png') }}" class="dp _user" alt="display photo">
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

                <div class="column right _user">
                    <div class="modal-form-input-container">
                        <div class="_full">
                            <div><label for="name">名前</label></div>
                            <div><input type="text" id="client_create_name_Input" name="name" required></div>
                        </div>
                    </div>

                    <div class="modal-form-input-container">
                        <div class="_half">
                            <div><label for="user_id">連絡先人の　アイヂ</label></div>
                            <div><input type="number" id="client_create_userId_Input" name="user_id" required></div>
                        </div>
                    </div>
                </div>
  
            </div>
            <div id="message"></div>

        </form>
    </div>
</div>



<script>

    function clientRegisterModalHandler() {
        event.preventDefault();
        showModal('client-create-modal');
    }

    function getClientRegFormData() {
        return {
            client_name: $('#client_create_name_Input').val(),
            user_id: $('#client_create_userId_Input').val(),
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
            if (err.responseJSON.errors.email != null) {
                $('#message').html(err.responseJSON.errors.email);
            }
            /*
            if (err.responseJSON.errors.client_name != null) {
                $('#message').html("エラー　： " + "顧客名が入力していないです。");
            }*/
        }
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

