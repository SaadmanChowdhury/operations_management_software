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
                        <button type="submit" onclick="createUser()"><i class="fa fa-floppy-o" aria-hidden="true"></i>
                            登録</button>
                    </div>
                    

                    <div>
                        <button type="submit" class="cancel" onclick="closeModal('user-create-modal')">
                            <i class="fa fa-times" aria-hidden="true"></i> 戻る
                        </button>
                    </div>

                    
                </div>

                <div class="column right _user">
                    {{-- <input type="hidden" id="id" value=""> --}}


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
                            <div><label for="password">パスワード<span class="reruired-field-marker">*</span></label></div>
                            <div><input class="modal_input" type="password" id="user_create_passwordInput" name="password" required></div>
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

                        
                        @if($loggedUser->user_authority!='一般ユーザー')
                            <div class="_half">
                                <div><label for="authority">権限<span class="reruired-field-marker">*</span></label></div>
                                <div class="custom-select">
                                    <select class="modal_input" id="user_create_authorityInput" required>
                                        @if ($loggedUser->user_authority == 'システム管理者')
                                            <option value="1" selected>一般ユーザー </option>
                                            <option value="2">一般管理者</option>
                                            <option value="3">システム管理者</option>
                                        @elseif ($loggedUser->user_authority == '一般管理者')
                                            <option value="1" selected>一般ユーザー </option>
                                            <option value="2">一般管理者</option>
                                        
                                        @endif
                                    </select>
                                </div>
                                
                            </div>
                        @endif

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
                        
                        
                    <div class="modal-form-input-container _dark flex-col" id="user-create-entryInfo">
                        <span>
                            <div style="font-size:20px; margin-left:12px">
                                入社情報
                            </div>
                            <button class="modal_addBtn" id="user-create-entryInfo_Add">+</button>
                            <div class="row center">
                                
                                <div>
                                    <div><label for="user_admissionDay">開始日<span class="reruired-field-marker">*</span></label></div>
                                    <div class="row">
                                        <button class="delete">-</button>
                                        <div><input class="modal_input" type="date" name="user_admissionDay" required></div>
                                    </div>
                                </div>

                                <div>
                                    <div><label for="user_resignationDay">終了日</label></div>
                                    <div><input class="modal_input" type="date" name="user_resignationDay" required></div>
                                </div>
                            </div>
                        </span>
                        
                        
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
                    <div class="modal-form-input-container _dark flex-col" id="user-create-Salary">

                        
                        <span><div style="font-size:20px; margin-left:12px">給料情報</div>
                            <button class="modal_addBtn" id="user-create-salary_Add">+</button>
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

function createUser_deleteRowActionListener() {

// var i = 0;
document.getElementById("user-create-Salary").querySelectorAll(".delete").forEach(function (obj, index) {
    obj.addEventListener("click", function (event) {

            this.parentNode.parentNode.parentNode.remove();
            createUser_deleteRowActionListener();
        
    });
});
}
function createUser_addSalaryRowListener()
{
    document.getElementById('user-create-salary_Add').onclick=function(){
        
        document.getElementById('user-create-Salary').innerHTML+=`<div class="row center">
                                <div>
                                    <div><label for="sales_total">給料<span class="reruired-field-marker">*</span></label></div>
                                    <div class="row">
                                        <button class="delete">-</button>
                                        <input class="modal_input" type="number" name="salary" required>
                                    </div>

                                </div>

                                <div>
                                    <div><label for="salary_startDate">開始日<span class="reruired-field-marker">*</span></label></div>
                                    <div><input class="modal_input" type="date" name="salary_startDate" required></div>
                                </div>

                                <div>
                                    <div><label for="salary_endDate">終了日</label></div>
                                    <div><input class="modal_input" type="date" name="salary_endDate" required></div>
                                </div>
                            </div>`;
                            createUser_addSalaryRowListener();
                            createUser_deleteRowActionListener();
        }
        
}
function createUser_addEntryInfoRowListener(){
    document.getElementById('user-create-entryInfo_Add').onclick=function(){
        
        document.getElementById('user-create-entryInfo').innerHTML+=`<div class="row center">
                                <div>
                                    <div><label for="user_admissionDay">開始日<span class="reruired-field-marker">*</span></label></div>
                                    <div class="row">
                                        <button class="delete">-</button>
                                        <div><input class="modal_input" type="date" name="user_admissionDay" required></div>
                                    </div>
                                </div>

                                <div>
                                    <div><label for="user_resignationDay">終了日</label></div>
                                    <div><input class="modal_input" type="date" name="user_resignationDay" required></div>
                                </div>
                            </div>`;
                            createUser_addEntryInfoRowListener();
                            createUser_entryInfoDeleteRowActionListener();
        }
}

function createUser_entryInfoDeleteRowActionListener() {


    document.getElementById("user-create-entryInfo").querySelectorAll(".delete").forEach(function (obj, index) {
        obj.addEventListener("click", function (event) {

                this.parentNode.parentNode.parentNode.remove();
                createUser_entryInfoDeleteRowActionListener();
            
            });
        });
}

var resetCreateHTML=document.getElementById('user-create-modal').innerHTML;
function userRegisterModalHandler() {
    event.preventDefault();
    document.getElementById('user-create-modal').innerHTML=resetCreateHTML;
    showModal('user-create-modal');
    createUser_addSalaryRowListener();
    createUser_deleteRowActionListener();
    createUser_addEntryInfoRowListener();
    createUser_entryInfoDeleteRowActionListener();
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