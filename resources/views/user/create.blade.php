@include("header")

<div class="modal-container" id="user-create-modal">

    <div class="modal-title primary">
        <span class="form-ht">ユーザー登録</span>
        <span class="fa fa-chevron-up close" onclick="closeModal('user-create-modal')"></span>
    </div>

    <div id="reg_modal" class="modal-form-container">
        <form id="reg_form" action="" method="">
            @csrf

            <div class="row">

                <div class="column left">
                    <div>
                        <img src="{{ asset('img/dp.png') }}" class="dp" alt="display photo">
                    </div>

                    <div>
                        <button type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> 登録</button>
                    </div>

                    <div>
                        <button type="submit" class="cancel"><i class="fa fa-times" aria-hidden="true"
                                onclick="closeModal('user-create-modal')"></i> 戻る</button>
                    </div>
                </div>

                <div class="column right">
                    <div><label for="name">名前</label></div>
                    <div><input type="text" id="nameInput" name="name" required></div>


                    <div><label for="email">メールアドレス</label></div>
                    <div><input type="email" id="emailInput" name="email" required></div>


                    <div><label for="password">パスワード</label></div>
                    <div><input type="password" id="passwordInput" name="password" required></div>


                    <div><label for="tel">電話番号</label></div>
                    <div><input type="text" id="telInput" name="tel" required></div>


                    <div><label>ポジション</label></div>
                    <div class="custom-select">
                        <select id="positionInput" required>
                            @foreach (config('constants.Position') as $position => $value)
                                <option>{{ $position }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div><label>職場</label></div>
                    <div class="custom-select">
                        <select id="locationInput" required>
                            @foreach (config('constants.Location') as $location => $value)
                                <option>{{ $location }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div><label for="admission_day">入場日</label></div>
                    <div><input type="date" id="admission_dayInput" name="admission_day" required></div>


                    <div><label for="salary">原価</label></div>
                    <div><input type="number" id="salaryInput" name="salary" required></div>


                    <div><label>ユーザー権限</label></div>
                    <div class="custom-select">
                        <select id="authorityInput" required>
                            @foreach (config('constants.User_authority') as $authority => $value)
                                <option name="user_authority">{{ $authority }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div id="message"></div>

        </form>
    </div>
</div>


<script>
    function getFormData() {
        return {
            name: $('#nameInput').val(),
            email: $('#emailInput').val(),
            password: $('#passwordInput').val(),
            tel: $('#telInput').val(),
            position: $('#positionInput').val(),
            location: $('#locationInput').val(),
            admission_day: $('#admission_dayInput').val(),
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

    $(document).ready(function() {
        $('#reg_form').submit(function(e) {
            console.log(getFormData());
            e.preventDefault();

            $.ajax({
                type: "post",
                url: "/API/createUser",
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

</script>

@include("footer")
