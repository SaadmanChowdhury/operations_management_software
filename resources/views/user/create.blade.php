<div class="modal-container" id="user-create-modal">

    <div class="modal-title mild-midori">
        <span class="form-ht">ユーザー登録</span>
        <span class="fa fa-chevron-up close" onclick="closeModal('user-create-modal')"></span>
    </div>

    <div class="create_modal modal-form-container _user">
        <form id="reg_form" action="" method="">
            @csrf

            <div class="row">

                <div class="column left">
                    <div>
                        <img src="{{ asset('img/user_dp.png') }}" class="dp _user" alt="display photo">
                    </div>

                    <div>
                        <button type="submit" onclick="createUser()"><i class="fa fa-floppy-o" aria-hidden="true"></i>
                            登録</button>
                    </div>
                    <div>
                        <button type="submit" class="heart">
                            <i class="fa fa-heart" aria-hidden="true"></i> お気に入り
                        </button>
                    </div>

                    <div>
                        <button type="submit" class="cancel" onclick="closeModal('user-create-modal')"><i
                                class="fa fa-times" aria-hidden="true"></i> 戻る</button>
                    </div>
                </div>

                <div class="column right _user">

                    

                    <div class="modal-form-input-container">
                        <div class="_half">
                            <div><label for="userid">User ID<span class="reruired-field-marker">*</span></label></div>
                            <div><input class="modal_input" type="text" id="user_create_userID" name="userid" value=""></div>
                        </div>
                        <div class="_half">
                            <div><label for="name">名前<span class="reruired-field-marker">*</span></label></div>
                            <div><input class="modal_input" type="text" id="user_create_nameInput" name="name" value="" required></div>
                        </div>
                    </div>

                    <div class="modal-form-input-container">
                        <div class="_half">
                            <div><label for="email">メールアドレス<span class="reruired-field-marker">*</span></label></div>
                            <div><input class="modal_input" type="email" id="user_create_emailInput" name="email" required></div>
                        </div>
                        <div class="_half">
                            <div><label for="password">パスワード<span class="reruired-field-marker">*</span></label></div>
                            <div><input class="modal_input" type="password" id="user_create_passwordInput" name="password" required></div>
                        </div>
                    </div>

                    <div class="modal-form-input-container">
                        <div class="_half">
                            <div><label for="tel">電話番号<span class="reruired-field-marker">*</span></label></div>
                            <div><input class="modal_input" type="text" id="user_create_telInput" name="tel" required></div>
                        </div>

                        <div class="_half">
                            <div><label>職場</label></div>
                            <div class="custom-select">
                                <select  class="modal_input" id="user_create_locationInput" required>
                                    @foreach (config('constants.Location') as $location => $value)
                                    <option>{{ $location }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-form-input-container">

                        {{-- <div class="_half">
                            <div><label for="salary">原価<span class="reruired-field-marker">*</span></label></div>
                            @if ($loggedUser->user_authority == 'システム管理者')
                            <div>
                                <input class="modal_input" type="number" id="user_create_salaryInput" name="salary" value="" required>
                            </div>
                            @else
                            <div>
                                <input class="modal_input" type="number" id="user_create_salaryInput" name="salary" value="" readonly>
                            </div>
                            @endif
                        </div> --}}
                        <div class="_half">
                            <div><label for="authority">権限</label><span class="reruired-field-marker">*</span></div>
                            <<div class="custom-select">
                                <select class="modal_input" id="user_create_Auth">
                                    {{-- @foreach (config('constants.Position') as $position => $value)
                                        <option>{{ $position }}</option>
                                    @endforeach --}}
                                    <option value="1" selected>一般ユーザー </option>
                                    <option value="2">一般管理者</option>
                                    <option value="3">システム管理者</option>
                                </select>
                            </div>
                            
                        </div>

                        <div class="_half">
                            <div><label>ポジション</label></div>
                            <div class="custom-select">
                                <select class="modal_input" id="user_create_positionInput">
                                    @foreach (config('constants.Position') as $position => $value)
                                        <option>{{ $position }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="modal-form-input-container">
                        <div class="_half">
                            <div><label for="admission_day">入場日<span class="reruired-field-marker">*</span></label>
                            </div>
                            <div><input class="modal_input" type="date" id="user_create_admission_dayInput" name="admission_day" required>
                            </div>
                        </div>

                        

                        <div class="_half">
                            <div><label>ユーザー権限<span class="reruired-field-marker">*</span></label></div>
                            <div class="custom-select">
                                <select class="modal_input" id="user_create_authorityInput" required>
                                    @foreach (config('constants.User_authority') as $authority => $value)
                                    <option name="user_authority">{{ $authority }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-form-input-container">

                        <div class="_half">
                            <div><label for="condition">Condition1<span class="reruired-field-marker">*</span></label></div>
                            {{-- @if ($loggedUser->user_authority == 'システム管理者') --}}
                            <div>
                                <input class="modal_input" type="text" id="user_create_condition1" name="condition" value="" required>
                            </div>
                            
                        </div>

                        <div class="_half">
                            <div><label>Condition2</label></div>
                            <div>
                                <input class="modal_input" type="text" id="user_create_condition2" name="condition" value="" required>
                            </div>
                            
                        </div>
                    </div>
                    <div class="modal-form-input-container">

                        <div class="_half">
                            <div><label for="condition">従業員の分類<span class="reruired-field-marker">*</span></label></div>
                            {{-- @if ($loggedUser->user_authority == 'システム管理者') --}}
                            <div class="custom-select">
                                <select class="modal_input" id="user_create_employeeType">
                                    
                                        <option value="1">SES</option>
                                        <option value="2">Full-Time</option>
                                        <option value="3">Part-Time</option>  
                                    
                                </select>
                            </div>
                            
                        </div>

                        <div class="_half">
                            <div><label>Locker</label></div>
                            <div>
                                <input class="modal_input" type="text" id="user_create_locker" name="locker" value="" required>
                            </div>
                            
                        </div>
                    </div>
                    <div class="modal-form-input-container _dark">

                        <div class="_third">
                            <div><label for="sales_total">給料<span class="reruired-field-marker">*</span></label></div>
                            <div><input class="modal_input" type="number" id="user_create_salary" name="sales_total" required>
                            </div>
                        </div>

                        <div class="_third">
                            <div><label for="transferred_amount">開始日<span class="reruired-field-marker">*</span></label></div>
                            <div><input class="modal_input" type="date" id="user_create_salary_startDate"
                                    name="transferred_amount" required></div>
                        </div>

                        <div class="_third">
                            <div><label for="budget">終了日</label></div>
                            <div><input class="modal_input" type="date" id="user_create_salary_endDate" name="budget" required></div>
                        </div>
                    </div>
                    <div class="modal-form-input-container">
                        <div class="_full">
                            <div><label for="name">Remarks<span class="reruired-field-marker"></span></label></div>
                            <div><input type="textarea" id="user_create_remarks" class="project_textarea" name="remarks" value=""></div>
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