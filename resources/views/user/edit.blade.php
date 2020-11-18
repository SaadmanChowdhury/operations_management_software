<div class="modal-container" id="user-edit-modal">

    <div class="modal-title primary">
        <span class="form-ht">ユーザー編集</span>
        <span class="fa fa-chevron-up close" onclick="closeModal('user-edit-modal')"></span>
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
                        <button type="submit" onclick="updateUser()">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i>
                            更新
                        </button>
                    </div>

                    <div>
                        <button type="submit" class="cancel" onclick="closeModal('user-edit-modal')">
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

                <div class="column right _user">
                    <input type="hidden" id="id" value="">


                    <div class="modal-form-input-container">
                        <div class="_full">
                            <div><label for="name">名前</label></div>
                            <div><input type="text" id="user_edit_nameInput" name="name" value="" required></div>
                        </div>
                    </div>

                    <div class="modal-form-input-container">
                        <div class="_half">
                            <div><label for="email">メールアドレス</label></div>
                            <div><input type="email" id="user_edit_emailInput" name="email" value=""></div>
                        </div>

                        <div class="_half">
                            <div><label for="password">パスワード</label></div>
                            <div><input type="password" id="user_edit_passwordInput" name="password"></div>
                        </div>
                    </div>

                    <div class="modal-form-input-container">
                        <div class="_half">
                            <div><label for="tel">電話番号</label></div>
                            <div><input type="text" id="user_edit_telInput" name="tel" value=""></div>
                        </div>

                        <div class="_half">
                            <div><label>職場</label></div>
                            <div class="custom-select">
                                <select id="user_edit_locationInput">
                                    @foreach (config('constants.Location') as $location => $value)
                                        <option value="{{ $value }}">{{ $location }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-form-input-container">

                        <div class="_half">
                            <div><label for="salary">原価</label></div>
                            @if ($loggedUser->user_authority == config('constants.User_authority.システム管理者'))
                                <div>
                                    <input type="number" id="user_edit_salaryInput" name="salary" value="" required>
                                </div>
                            @else
                                <div>
                                    <input type="number" id="user_edit_salaryInput" name="salary" value="" readonly>
                                </div>
                            @endif
                        </div>

                        <div class="_half">
                            <div><label>ポジション</label></div>
                            <div class="custom-select">
                                <select id="user_edit_positionInput">
                                    @foreach (config('constants.Position') as $position => $value)
                                        <option value="{{ $value }}">{{ $position }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-form-input-container">
                        <div class="_half">
                            <div><label for="admission_day">入場日</label></div>
                            @if ($loggedUser->user_authority == config('constants.User_authority.システム管理者'))
                                <div>
                                    <input type="date" id="user_edit_admission_dayInput" name="admission_day" value="">
                                </div>
                            @else
                                <div>
                                    <input type="date" id="user_edit_admission_dayInput" name="admission_day" value="" readonly>
                                </div>
                            @endif
                        </div>

                        <div class="_half">
                            <div><label for="resignation_year">退職日</label></div>
                            @if ($loggedUser->user_authority == config('constants.User_authority.システム管理者'))
                                <div>
                                    <input type="date" id="user_edit_resignation_yearInput" name="resignation_year" value="">
                                </div>
                            @else
                                <div>
                                    <input type="date" id="user_edit_resignation_yearInput" name="resignation_year" value=""
                                        readonly>
                                </div>
                            @endif
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
        clearModalData('user-edit-modal');
        showModal('user-edit-modal');

        getUserData(userID);
    }

    function getEditFormData() {
        return {
            id: $('#id').val(),
            name: $('#user_edit_nameInput').val(),
            email: $('#user_edit_emailInput').val(),
            password: $('#user_edit_passwordInput').val(),
            tel: $('#user_edit_telInput').val(),
            position: $('#user_edit_positionInput').val(),
            positionText: $("#user_edit_positionInput").find(":selected").text(),
            location: $('#user_edit_locationInput').val(),
            locationText: $("#user_edit_locationInput").find(":selected").text(),
            admission_day: $('#user_edit_admission_dayInput').val(),
            unit_price: $('#user_edit_salaryInput').val(),
            user_authority: $('#user_edit_authorityInput').val(),
            _token: $('input[name=_token]').val()
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

        console.log("UDPATE USER TABLE")

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
        $("#user_edit_nameInput").val(data.name)
        $("#user_edit_emailInput").val(data.email)
        $("#user_edit_telInput").val(data.tel)
        $("#user_edit_locationInput").val(data.location)
        $("#user_edit_positionInput").val(data.position)
        $("#user_edit_admission_dayInput").val(data.admission_day)
        $("#user_edit_resignation_yearInput").val(data.resign_day)
        $("#user_edit_salaryInput").val(data.unit_price)
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

        modalData = getEditFormData();

        $.ajax({
            type: "post",
            url: "/API/updateUser",
            data: modalData,
            cache: false,
            success: function(response) {
                if (response["resultStatus"]["isSuccess"]) {
                    updateUserTable(modalData);
                    closeModal('user-edit-modal');
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
                closeModal('user-edit-modal');
            },
            error: function(err) {
                handleAJAXError(err);
            }
        });
    }

</script>
