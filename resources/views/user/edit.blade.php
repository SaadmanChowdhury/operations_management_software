<div class="modal-container" id="user-edit-modal">

    <div class="modal-title primary">
        <span class="form-ht">ユーザー編集</span>
        <span class="fa fa-chevron-up close" onclick="closeModal('user-edit-modal')"></span>
    </div>

    <div class="modal-form-container">
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

                <div class="column right">
                    <input type="hidden" id="id" value="">


                    <div><label for="name">名前</label></div>
                    <div><input type="text" id="nameInput" name="name" value="" required></div>


                    <div><label for="email">メールアドレス</label></div>
                    <div><input type="email" id="emailInput" name="email" value=""></div>


                    <div><label for="password">パスワード</label></div>
                    <div><input type="password" id="passwordInput" name="password"></div>


                    <div><label for="tel">電話番号</label></div>
                    <div><input type="text" id="telInput" name="tel" value=""></div>


                    <div><label>職場</label></div>
                    <div class="custom-select">
                        <select id="locationInput">
                            @foreach (config('constants.Location') as $location => $value)
                                <option value="{{ $value }}">{{ $location }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div><label>ポジション</label></div>
                    <div class="custom-select">
                        <select id="positionInput">
                            @foreach (config('constants.Position') as $position => $value)
                                <option value="{{ $value }}">{{ $position }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div><label for="admission_day">入場日</label></div>
                    @if ($loggedUser->user_authority == config('constants.User_authority.システム管理者'))
                        <div>
                            <input type="date" id="admission_day" name="admission_day" value="">
                        </div>
                    @else
                        <div>
                            <input type="date" id="admission_day" name="admission_day" value="" readonly>
                        </div>
                    @endif


                    <div><label for="resignation_year">退職日</label></div>
                    @if ($loggedUser->user_authority == config('constants.User_authority.システム管理者'))
                        <div>
                            <input type="date" id="resignation_yearInput" name="resignation_year" value="">
                        </div>
                    @else
                        <div>
                            <input type="date" id="resignation_yearInput" name="resignation_year" value="" readonly>
                        </div>
                    @endif


                    <div><label for="salary">原価</label></div>
                    @if ($loggedUser->user_authority == config('constants.User_authority.システム管理者'))
                        <div>
                            <input type="number" id="salaryInput" name="salary" value="" required>
                        </div>
                    @else
                        <div>
                            <input type="number" id="salaryInput" name="salary" value="" readonly>
                        </div>
                    @endif

                </div>
            </div>

        </form>
    </div>
</div>


<script>
    function getFormData() {
        return {
            id: $('#id').val(),
            name: $('#nameInput').val(),
            email: $('#emailInput').val(),
            password: $('#passwordInput').val(),
            tel: $('#telInput').val(),
            position: $('#positionInput').val(),
            location: $('#locationInput').val(),
            admission_day: $('#admission_day').val(),
            unit_price: $('#salaryInput').val(),
            user_authority: $('#authorityInput').val(),
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
    }

    $(document).ready(function() {
        $('#edit_form').submit(function(e) {
            console.log(getFormData());
            e.preventDefault();

            $.ajax({
                type: "post",
                url: "/API/updateUser",
                data: getFormData(),
                cache: false,
                success: function(response) {
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

        $.ajax({
            type: "post",
            url: "/API/deleteUser",
            data: {
                id: $('#id').val(),
                _token: $('input[name=_token]').val()
            },
            cache: false,
            success: function(response) {
                handleAJAXResponse(response);
            },
            error: function(err) {
                handleAJAXError(err);
            }
        });
    }

</script>
