<div class="modal-container" id="user-edit-modal">
    
    <div class="modal-title mild-midori">
        <span class="form-ht">ユーザー編集</span>
        <span class="fa fa-chevron-up close" onclick="closeModal('user-edit-modal')"></span>
    </div>

    <div class="modal-form-container _user">
        <form id="edit_form" action="" method="">
            @csrf

            <div class="row">
                <div class="column left">
                    <div>
                        <img src="{{ asset('img/user_dp.png') }}" class="dp _user" alt="display photo">
                    </div>
                    <div>

                        <span>アクティブ</span>
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div class="fav">
                        <span>お気に入り</span>
                        <label class="switch">
                            <input type="checkbox" id="favFlag" checked>
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
                        <button type="submit" class="cancel" onclick="closeModal('user-edit-modal')">
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

                <div class="column right _user" id="column-right-user">
                    <input type="hidden" id="id" value="">


                    <div class="modal-form-input-container">
                        <div class="_half">
                            <div><label for="userid">ユーザーコード<span class="reruired-field-marker">*</span></label></div>
                            <div><input class="modal_input" type="text" id="user_edit_userID" name="userid" value=""></div>
                        </div>
                        
                    </div>
                    <div class="modal-form-input-container">
                        
                        <div class="_half">
                            <div><label for="name">名前<span class="reruired-field-marker">*</span></label></div>
                            <div><input class="modal_input" type="text" id="user_edit_nameInput" name="name" value="" required></div>
                        </div>
                        <div class="_half">
                            <div><label for="userGender">性</label></div>
                            <div class="custom-select">
                                <select class="modal_input" id="user_edit_Gender">
                                    
                                        <option value="1">女性</option>
                                        <option value="2">男性</option>
                                         
                                    
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-form-input-container">
                        <div class="_half">
                            <div><label for="email">メールアドレス<span class="reruired-field-marker">*</span></label></div>
                            <div><input class="modal_input" type="email" id="user_edit_emailInput" name="email" value=""></div>
                        </div>

                        <div class="_half">
                            <div><label for="password">パスワード</label></div>
                            <div><input class="modal_input" type="password" id="user_edit_passwordInput" name="password"></div>
                        </div>
                    </div>

                    <div class="modal-form-input-container">
                        <div class="_half">
                            <div><label for="tel">電話番号<span class="reruired-field-marker">*</span></label></div>
                            <div><input class="modal_input" type="text" id="user_edit_telInput" name="tel" value=""></div>
                        </div>

                        <div class="_half">
                            <div><label>職場</label></div>
                            <div class="custom-select">
                                <select class="modal_input" id="user_edit_locationInput">
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
                                <div><label for="authority">権限</label></div>
                                <div class="custom-select">
                                    <select class="modal_input" id="user_edit_authorityInput">
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
                                <select class="modal_input" id="user_edit_positionInput">
                                    @foreach (config('constants.Position') as $position => $value)
                                        <option>{{ $position }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-form-input-container _dark flex-col" id="entryInfo">
                        
                        
                    </div>
                    <div class="modal-form-input-container">

                        <div class="_half">
                            <div><label for="emergency">緊急連絡</label></div>
                            
                            <div>
                                <input class="modal_input" type="text" id="user_edit_emergency" name="emergency" value="" required>
                            </div>
                            
                        </div>
                    </div>
                    <div class="modal-form-input-container">

                        <div class="_half">
                            <div><label for="condition">Condition1</label></div>
                            {{-- @if ($loggedUser->user_authority == 'システム管理者') --}}
                            <div>
                                <input class="modal_input" type="text" id="user_edit_condition1" name="condition" value="" required>
                            </div>
                            
                        </div>

                        <div class="_half">
                            <div><label>Condition2</label></div>
                            <div>
                                <input class="modal_input" type="text" id="user_edit_condition2" name="condition" value="" required>
                            </div>
                            
                        </div>
                    </div>
                    <div class="modal-form-input-container">

                        <div class="_half">
                            <div><label for="condition">従業員の分類<span class="reruired-field-marker">*</span></label></div>
                            {{-- @if ($loggedUser->user_authority == 'システム管理者') --}}
                            <div class="custom-select">
                                <select class="modal_input" id="user_edit_employeeType">
                                    
                                        <option value="2">Full-Time</option>
                                        <option value="3">Part-Time</option>
                                        <option value="1">SES</option>  
                                    
                                </select>
                            </div>
                            
                        </div>

                        <div class="_half">
                            <div><label>Locker</label></div>
                            <div>
                                <input class="modal_input" type="text" id="user_edit_locker" name="locker" value="" required>
                            </div>
                            
                        </div>
                    </div>
                    
                    

                </div>
            </div>

        </form>
    </div>
</div>


<script>

var user_editUserID;
//var count=1;
function deleteRowActionListener() {

    // var i = 0;
    document.getElementById("user-edit-Salary").querySelectorAll(".delete").forEach(function (obj, index) {
        obj.addEventListener("click", function (event) {

                this.parentNode.parentNode.parentNode.remove();
                deleteRowActionListener();
            
        });
    });
}

function entryInfoDeleteRowActionListener() {


document.getElementById("entryInfo").querySelectorAll(".delete").forEach(function (obj, index) {
        obj.addEventListener("click", function (event) {

                this.parentNode.parentNode.parentNode.remove();
                entryInfoDeleteRowActionListener();
            
            });
        });
}

function renderSalarySection(salaryLength){

    var salarySectionHTML=`<div class="modal-form-input-container _dark flex-col" id="user-edit-Salary">
                        <span>
                            <div style="font-size:20px; margin-left:12px">
                                給料情報
                            </div>
                            <button class="modal_addBtn" id="salary_Add">+</button>`;
                            for (let index = 0; index < salaryLength; index++) {
                                salarySectionHTML+=`<div class="row center" id="salary-row-1">
                                
                                <div>
                                    <div><label for="salary">給料<span class="reruired-field-marker">*</span></label></div>
                                    <div class="row">
                                        <button class="delete">-</button>
                                        <input class="modal_input" type="number" name="salary" required>
                                    </div>
                                </div>
                                

                                <div>
                                    <div><label for="salary_startDate">開始日<span class="reruired-field-marker">*</span></label></div>
                                    <div><input class="modal_input" type="date"
                                            name="salary_startDate" required></div>
                                </div>

                                <div>
                                    <div><label for="salary_endDate">終了日</label></div>
                                    <div><input class="modal_input" type="date" name="salary_endDate" required></div>
                                </div>
                            </div>`;
                                
                            }
                    salarySectionHTML+=`</span>
                    </div>`;
    var remarkHTMLString= `<div class="modal-form-input-container" id='user-edit-remark'>
                        <div class="_full">
                            <div><label for="name">Remarks<span class="reruired-field-marker"></span></label></div>
                            <div><input type="textarea" id="user_edit_remarks" class="project_textarea" name="remarks" value=""></div>
                        </div>
                    </div>`;
    string=salarySectionHTML+remarkHTMLString;
    //console.log(string2);
    document.getElementById('column-right-user').innerHTML+=string;
    deleteRowActionListener();
}

function addSalaryRowListener()
{
    var selects = document.querySelector("#user-edit-Salary").getElementsByTagName("input");

    console.log("hello from the other world");
    for (let i = 0; i < selects.length; i++) {
        console.log(selects[i]);

        selects[i].addEventListener("change", function () {
            console.log(this.value);
            selects[i].setAttribute("value", selects[i].value);
        });
    }
    document.getElementById('salary_Add').onclick=function(){
        
        
        document.getElementById('user-edit-Salary').innerHTML+=`<div class="row center">
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
                            
                            
                            addSalaryRowListener();
                            deleteRowActionListener();
        }
        
        
}

function addEntryInfoRowListener(){
    document.getElementById('entryInfo_Add').onclick=function(){
        
        document.getElementById('entryInfo').innerHTML+=`<div class="row center">
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
                            addEntryInfoRowListener();
                            entryInfoDeleteRowActionListener();
        }
}

function renderEntryInfoSection(entryInfoLength){

    var entryInfoHTML=` <span>
                            <div style="font-size:20px; margin-left:12px">
                                入社情報
                            </div>
                            <button class="modal_addBtn" id="entryInfo_Add">+</button>`;
                        for (let index = 0; index < entryInfoLength; index++) {
                            
                            entryInfoHTML+=`<div class="row center">
                                
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
                            
                        }    
                            
                        entryInfoHTML+=`</span>`;
    
    jQuery('#entryInfo').append(entryInfoHTML);
    
}


var resetEditHTML=document.getElementById('user-edit-modal').innerHTML;

function userEditModalHandler(userID) {
    event.preventDefault();
    user_editUserID=userID;
    document.getElementById('user-edit-modal').innerHTML=resetEditHTML;
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
        unit_price: $('#user-edit-Salary input').serialize(),
        user_authority: $('#user_edit_authorityInput').val(),
        _token: $('input[name=_token]').val(),
        favChecked:$('#favFlag').prop("checked")
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
    console.log(err.responseText);
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

    var length=3;
    renderEntryInfoSection(length);
    renderSalarySection(length);
    addSalaryRowListener();
    deleteRowActionListener();
    addEntryInfoRowListener();
    entryInfoDeleteRowActionListener();

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
                //return response["resultData"];
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
    console.log(modalData);

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
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085D6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            deleteUserComfirmation(userId);
            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            )
        }
    })
}

function deleteUserComfirmation(userId) {
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

function updateFavorites_AJAXcall(itemID,checked){
    $.ajax({
        type: "post",
        url: "/API/updateFavoriteStatus",
        data: {
            _token: $('input[name=_token]').val(),
            itemID: user_editUserID,
            itemType: config('constants.Table.user'),
            favoriteStatus:checked
        },
        cache: false,
        success: function(response) {
            if (response["resultStatus"]["isSuccess"])

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