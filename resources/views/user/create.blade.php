<div class="modal-container" id="user-create-modal">

    <div class="modal-title mild-midori">
        <span class="form-ht">ユーザー編集</span>
        <span class="fa fa-chevron-up close" onclick="closeModal('user-create-modal')"></span>
    </div>

    <div class="modal-form-container _user">
        <form id="create_form" action="" method="">
            @csrf

            <div class="row">
                <div class="column left">
                    <div>
                        <img src="{{ asset('img/user_dp.png') }}" class="dp _user" alt="display photo">
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
                        <button type="submit" onclick="updateUser()">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                            更新
                        </button>
                    </div>
                    

                    <div>
                        <button type="submit" class="cancel" onclick="closeModal('user-create-modal')">
                            <i class="fa fa-times" aria-hidden="true"></i> 戻る
                        </button>
                    </div>

                    @if ($loggedUser->user_authority == 'システム管理者')
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
                        <div class="_half">
                            <div><label for="userid">ユーザーコード<span class="reruired-field-marker">*</span></label></div>
                            <div><input class="modal_input" type="text" id="user_create_userID" name="userid" value=""></div>
                        </div>
                        
                    </div>
                    <div class="modal-form-input-container">
                        
                        <div class="_half">
                            <div><label for="name">名前<span class="reruired-field-marker">*</span></label></div>
                            <div><input class="modal_input" type="text" id="user_create_nameInput" name="name" value="" required></div>
                        </div>
                        <div class="_half">
                            <div><label for="userGender">性</label></div>
                            <div class="custom-select">
                                <select class="modal_input" id="user_create_Gender">
                                    
                                        <option value="1">女性</option>
                                        <option value="2">男性</option>
                                         
                                    
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-form-input-container">
                        <div class="_half">
                            <div><label for="email">メールアドレス<span class="reruired-field-marker">*</span></label></div>
                            <div><input class="modal_input" type="email" id="user_create_emailInput" name="email" value=""></div>
                        </div>

                        <div class="_half">
                            <div><label for="password">パスワード</label></div>
                            <div><input class="modal_input" type="password" id="user_create_passwordInput" name="password"></div>
                        </div>
                    </div>

                    <div class="modal-form-input-container">
                        <div class="_half">
                            <div><label for="tel">電話番号<span class="reruired-field-marker">*</span></label></div>
                            <div><input class="modal_input" type="text" id="user_create_telInput" name="tel" value=""></div>
                        </div>

                        <div class="_half">
                            <div><label>職場</label></div>
                            <div class="custom-select">
                                <select class="modal_input" id="user_create_locationInput">
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
                            <div><label for="authority">権限</label></div>
                            <div class="custom-select">
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
                            @if ($loggedUser->user_authority == 'システム管理者')
                                <div>
                                    <input class="modal_input" type="date" id="user_create_admission_dayInput" name="admission_day" value="">
                                </div>
                            @else
                                <div>
                                    <input class="modal_input" type="date" id="user_create_admission_dayInput" name="admission_day" value=""
                                        readonly>
                                </div>
                            @endif
                        </div>

                        <div class="_half">
                            <div><label for="resignation_year">退職日</label></div>
                            @if ($loggedUser->user_authority == 'システム管理者')
                            <div>
                                <input class="modal_input" type="date" id="user_create_resignation_yearInput" name="resignation_year"
                                    value="">
                            </div>
                            @else
                            <div>
                                <input class="modal_input" type="date" id="user_create_resignation_yearInput" name="resignation_year" value=""
                                    readonly>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="modal-form-input-container">

                        <div class="_half">
                            <div><label for="emergency">緊急連絡</label></div>
                            {{-- @if ($loggedUser->user_authority == 'システム管理者') --}}
                            <div>
                                <input class="modal_input" type="text" id="user_create_emergency" name="emergency" value="" required>
                            </div>
                            
                        </div>
                    </div>
                    <div class="modal-form-input-container">

                        <div class="_half">
                            <div><label for="condition">Condition1</label></div>
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
                                    
                                        <option value="2">Full-Time</option>
                                        <option value="3">Part-Time</option>
                                        <option value="1">SES</option>  
                                    
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
                    <div class="modal-form-input-container _dark flex-col">

                        
                        <span><div style="font-size:20px; margin-left:12px">給料情報<div><button class="modal_addBtn">+</button>
                        <div class="row center">
                            
                            <div>
                                <div><label for="salary">給料<span class="reruired-field-marker">*</span></label></div>
                                <div class="row">
                                    <button class="delete">-</button>
                                    <input class="modal_input" type="number" name="salary" required>
                                </div>
                            </div>
                            

                            <div>
                                <div><label for="transferred_amount">開始日<span class="reruired-field-marker">*</span></label></div>
                                <div><input class="modal_input" type="date"
                                        name="transferred_amount" required></div>
                            </div>

                            <div>
                                <div><label for="budget">終了日</label></div>
                                <div><input class="modal_input" type="date" name="budget" required></div>
                            </div>
                        </div>
                        </span>
                        <div class="row center">
                            <div>
                                <div><label for="sales_total">給料<span class="reruired-field-marker">*</span></label></div>
                                <div class="row">
                                    <button class="delete">-</button>
                                    <input class="modal_input" type="number" name="salary" required>
                                </div>

                            </div>

                            <div>
                                <div><label for="transferred_amount">開始日<span class="reruired-field-marker">*</span></label></div>
                                <div><input class="modal_input" type="date" id="user_create_salary_startDate"
                                        name="transferred_amount" required></div>
                            </div>

                            <div>
                                <div><label for="budget">終了日</label></div>
                                <div><input class="modal_input" type="date" name="budget" required></div>
                            </div>
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