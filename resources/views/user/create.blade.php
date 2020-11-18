<div class="modal-container" id="user-create-modal">

    <div class="modal-title primary">
        <span class="form-ht">ユーザー登録</span>
        <span class="fa fa-chevron-up close" onclick="closeModal('user-create-modal')"></span>
    </div>

    <div class="modal-form-container _user">
        <form id="reg_form" action="" method="">
            @csrf

            <div class="row">

                <div class="column left">
                    <div>
                        <img src="{{ asset('img/dp.png') }}" class="dp" alt="display photo">
                    </div>

                    <div>
                        <button type="submit" onclick="createUser()"><i class="fa fa-floppy-o" aria-hidden="true"></i> 登録</button>
                    </div>

                    <div>
                        <button type="submit" class="cancel" onclick="closeModal('user-create-modal')"><i class="fa fa-times" 
                            aria-hidden="true"></i> 戻る</button>
                    </div>
                </div>

                <div class="column right _user">

                    <div class="modal-form-input-container">
                        <div class="_full">
                            <div><label for="name">名前</label></div>
                            <div><input type="text" id="user_create_nameInput" name="name" required></div>
                        </div>
                    </div>

                    <div class="modal-form-input-container">
                        <div class="_half">
                            <div><label for="email">メールアドレス</label></div>
                            <div><input type="email" id="user_create_emailInput" name="email" required></div>
                        </div>
                        <div class="_half">
                            <div><label for="password">パスワード</label></div>
                            <div><input type="password" id="user_create_passwordInput" name="password" required></div>
                        </div>
                    </div>

                    <div class="modal-form-input-container">
                        <div class="_half">
                            <div><label for="tel">電話番号</label></div>
                            <div><input type="text" id="user_create_telInput" name="tel" required></div>
                        </div>

                        <div class="_half">
                            <div><label>職場</label></div>
                            <div class="custom-select">
                                <select id="user_create_locationInput" required>
                                    @foreach (config('constants.Location') as $location => $value)
                                        <option>{{ $location }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-form-input-container">
                        <div class="_half">
                            <div><label for="salary">原価</label></div>
                            <div><input type="number" id="user_create_salaryInput" name="salary" required></div>
                        </div>

                        <div class="_half">
                            <div><label>ポジション</label></div>
                            <div class="custom-select">
                                <select id="user_create_positionInput" required>
                                    @foreach (config('constants.Position') as $position => $value)
                                        <option>{{ $position }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-form-input-container">
                        <div class="_half">
                            <div><label for="admission_day">入場日</label></div>
                            <div><input type="date" id="user_create_admission_dayInput" name="admission_day" required></div>
                        </div>

                        <div class="_half">
                            <div><label>ユーザー権限</label></div>
                            <div class="custom-select">
                                <select id="user_create_authorityInput" required>
                                    @foreach (config('constants.User_authority') as $authority => $value)
                                        <option name="user_authority">{{ $authority }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>     

                </div>
            </div>


            <div id="message"></div>

        </form>
    </div>
</div>


<script>
    function userRegisterModalHandler() {
        event.preventDefault();

        showModal('user-create-modal');
    }

    function getRegFormData() {
        return {
            name: $('#user_create_nameInput').val(),
            email: $('#user_create_emailInput').val(),
            password: $('#user_create_passwordInput').val(),
            tel: $('#user_create_telInput').val(),
            position: $('#user_create_positionInput').val(),
            location: $('#user_create_locationInput').val(),
            admission_day: $('#user_create_admission_dayInput').val(),
            unit_price: $('#user_create_salaryInput').val(),
            user_authority: $('#user_create_authorityInput').val(),
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


    function createUser() {
        event.preventDefault();

        modalData = getRegFormData();

        $.ajax({
            type: "post",
            url: "/API/createUser",
            data: modalData,
            cache: false,
            success: function(response) {
                if (response["resultStatus"]["isSuccess"]) {
                    updateUserTable(modalData);
                    closeModal('user-create-modal');
                } else
                    handleAJAXResponse(response);
            },
            error: function(err) {
                handleAJAXError(err);
            }
        });
    }

</script>

