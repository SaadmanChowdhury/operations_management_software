<div class="modal-container" id="template-modal">

    <div class="modal-title primary">
        <span class="form-ht">モーダル名前</span>
        <span class="fa fa-chevron-up close" onclick="closeModal('template-modal')"></span>
    </div>

    <div class="modal-form-container _template">
        <form id="edit_form" action="" method="">
            @csrf

            <div class="row">
                <div class="column left">
                    <div>
                        <img src="{{ asset('img/dp.png') }}" class="dp" alt="display photo">
                    </div>

                    <div>
                        <button type="submit" onclick="updateUser()">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i>
                            更新
                        </button>
                    </div>

                    <div>
                        <button type="submit" class="cancel" onclick="closeModal('template-modal')">
                            <i class="fa fa-times" aria-hidden="true"></i> 戻る
                        </button>
                    </div>

                    @if ($loggedUser->user_authority == config('constants.User_authority.システム管理者'))
                        <div onclick="deleteUser()">
                            <a class="button delete-button" id="deleteButton"> <i class="fa fa-trash-o"
                                    aria-hidden="true"></i>
                                削除</a>
                        </div>
                    @endif
                </div>

                <div class="column right _template">
                    <input type="hidden" id="id" value="">


                    <div class="modal-form-input-container">
                        <div class="_full">
                            <div><label for="name">名前</label></div>
                            <div><input type="text" id="nameInput" name="name" value="" required></div>
                        </div>
                    </div>

                    <div class="modal-form-input-container">
                        <div class="_half">
                            <div><label for="email">メールアドレス</label></div>
                            <div><input type="email" id="emailInput" name="email" value=""></div>
                        </div>

                        <div class="_half">
                            <div><label for="password">パスワード</label></div>
                            <div><input type="password" id="passwordInput" name="password"></div>
                        </div>
                    </div>

                    <div class="modal-form-input-container">
                        <div class="_half">
                            <div><label for="tel">電話番号</label></div>
                            <div><input type="text" id="telInput" name="tel" value=""></div>
                        </div>

                        <div class="_half">
                            <div><label>職場</label></div>
                            <div class="custom-select">
                                <select id="locationInput">
                                    @foreach (config('constants.Location') as $location => $value)
                                        <option value="{{ $value }}">{{ $location }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>


<script>
    function userEditModalHandler(userID) {
        event.preventDefault();
        clearModalData('template-modal');
        showModal('template-modal');

        getUserData(userID);
    }

    function getFormData() {
        return {
            // id: $('#id').val(),
            // name: $('#nameInput').val(),
            // email: $('#emailInput').val(),
            // password: $('#passwordInput').val(),
            // tel: $('#telInput').val(),
            // location: $('#locationInput').val(),
            // locationText: $("#locationInput").find(":selected").text(),
        };
    }

    function handleAJAXResponse(response) {

        if (response["resultStatus"]["isSuccess"])
            updateUserTable();

        else if (response["resultStatus"]["errorMessage"] === "UNAUTHORIZED_ACTION")
            $('#message').html("You are not authorized to make this change");

        else
            $('#message').html("Unhandled Status: " + response["resultStatus"]["errorMessage"]);
    }

    function handleAJAXError(err) {
        console.log(err);
    }

    function updateUserTable(updatedData) {
        console.log(updatedData);

        console.log("UDPATE TABLE AFTER MODAL UPDATE")

        let row = $("#user-row-" + updatedData.id);

        row.find(".user-name").html(updatedData.name);
        row.find(".salary").html(updatedData.unit_price);

        row.find(".user-location").html(updatedData.locationText);

        positionDom = row.find(".pos");
        positionDom.html(updatedData.positionText);
        positionDom.removeClass();
        positionDom.addClass("pos");
        positionDom.addClass("pos-" + updatedData.positionText);

    }

    function updateUserEditModalData(data) {

        for (let i = 0; i < data.length; i++) {
            if (data[i] == null)
                data[i] = "";
        }

        $("#id").val(data.user_id)
        $("#nameInput").val(data.name)
        $("#emailInput").val(data.email)
        $("#telInput").val(data.tel)
        $("#locationInput").val(data.location)
        $("#positionInput").val(data.position)
        $("#admission_day").val(data.admission_day)
        $("#resignation_yearInput").val(data.resign_day)
        $("#salaryInput").val(data.unit_price)
    }

    function getUserData(userID) {
        $.ajax({
            type: "post",
            url: "/API/readUser",
            data: {
                userID: userID,
                _token: $('input[name=_token]').val()
            },
            cache: false,
            success: function(response) {
                if (response["resultStatus"]["isSuccess"]) {
                    updateUserEditModalData(response["resultData"]);
                } else
                    handleAJAXResponse(response);
            },
            error: function(err) {
                handleAJAXError(err);
            }
        });
    }

    function updateUser() {
        event.preventDefault();

        modalData = getFormData();

        $.ajax({
            type: "post",
            url: "/API/updateUser",
            data: modalData,
            cache: false,
            success: function(response) {
                if (response["resultStatus"]["isSuccess"]) {
                    updateUserTable(modalData);
                    closeModal('template-modal');
                } else
                    handleAJAXResponse(response);
            },
            error: function(err) {
                handleAJAXError(err);
            }
        });
    }

    function deleteUser() {
        event.preventDefault();
        userId = $('#id').val();

        $.ajax({
            type: "post",
            url: "/API/deleteUser",
            data: {
                id: userId,
                _token: $('input[name=_token]').val()
            },
            cache: false,
            success: function(response) {
                if (response["resultStatus"]["isSuccess"])
                    $("#user-row-" + userId).remove();
                else
                    handleAJAXResponse(response);
            },
            error: function(err) {
                handleAJAXError(err);
            }
        });
    }

</script>
