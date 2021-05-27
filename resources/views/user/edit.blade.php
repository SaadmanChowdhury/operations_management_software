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
                            <input type="checkbox" id="userEdit-activeFlag">
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div class="fav">
                        <span>お気に入り</span>
                        <label class="switch">
                            <input type="checkbox" id="userEdit-favFlag" checked>
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
                                            @foreach (config('constants.User_authority') as $user_auth => $value)
                                                <option>{{ $user_auth }}</option>
                                            @endforeach
                                            {{-- <option value="1" selected>一般ユーザー </option>
                                            <option value="2">一般管理者</option>
                                            <option value="3">システム管理者</option> --}}
                                        @elseif ($loggedUser->user_authority == '一般管理者')
                                            @foreach (config('constants.User_authority') as $user_auth => $value)
                                                @if ($user_auth!='システム管理者')
                                                    <option>{{ $user_auth }}</option>                                                    
                                                @else
                                                    
                                                @endif
                                                
                                            @endforeach
                                            {{-- <option value="1" selected>一般ユーザー </option>
                                            <option value="2">一般管理者</option> --}}
                                        
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
                    <div class="modal-form-input-container">

                        <div class="_half">
                            <div><label for="emergency">緊急連絡</label></div>
                            
                            <div>
                                <input class="modal_input" type="text" id="user_edit_emergency" name="emergency" value="" required>
                            </div>
                            
                        </div>
                    </div>
                    
                    <div class="modal-form-input-container _dark flex-col" id="entryInfo">
                        
                        
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
                                    
                                        <option value="1">Full-Time</option>
                                        <option value="2">Part-Time</option>
                                        <option value="3">SES</option>  
                                    
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
                    <div class="modal-form-input-container" id="affiliationInfo">
                        <div class="_half">
                            <div><label for="affiliationID">affiliation ID</label></div>
                            
                            <div>
                                <input class="modal_input" type="text" id="affiliationID" name="affiliationID" value="">
                            </div>
                            
                        </div>
                        
                    </div>
                    <div class="modal-form-input-container _dark flex-col" id="user-edit-Salary">
                        
                        
                    </div>
                    <div class="modal-form-input-container" id='user-edit-remark'>
                        <div class="_full">
                            <div><label for="name">Remarks<span class="reruired-field-marker"></span></label></div>
                            <div><input type="textarea" id="user_edit_remarks" class="project_textarea" name="remarks" value=""></div>
                        </div>
                    </div>
                    
                    
                    

                </div>
            </div>

        </form>
    </div>
</div>


<script>
var salaryStatus = "less";
var entryStatus = "less";
function toggleSalaryText(compositeSalary)
{
    //var text="Here is some text that I want added to the HTML file";
    console.log(compositeSalary);
    
    if (salaryStatus == "less") {
        salaryStatus = "more";
        document.getElementById("user-edit-Salary").innerHTML="";
        //document.getElementById("user-edit-remark").remove();
        // setTimeout(() => {
        //     renderSalarySection(compositeSalary);
        // }, 2000);
        renderSalarySection(compositeSalary);
        
        addSalaryRowListener()
        document.getElementById("toggleButton").innerText = "See Less";
        
    } 
    else if (salaryStatus == "more") {
        salaryStatus = "less";
        document.getElementById("user-edit-Salary").innerHTML="";
        //document.getElementById("user-edit-remark").remove();
        setTimeout(
            renderSalarySection(compositeSalary),2000

        ),
        addSalaryRowListener();
        document.getElementById("toggleButton").innerText = "See More";
        
    }
}


function showMoreSalary(compositeSalary){
    var salarySectionHTML=``;
    for (let index = compositeSalary.length-1; index >=0; index--) {
        salarySectionHTML+=`<div class="row center" id="salary-row-1">
                                
                                <div>
                                    <div><label for="salary">給料<span class="reruired-field-marker">*</span></label></div>
                                    <input type="hidden" name="salaryID" value="${compositeSalary[index].salaryID}">
                                    <div class="row">
                                        <button class="delete">-</button>

                                        <input class="modal_input" type="number" name="salary" required value=${compositeSalary[index].salaryAmount}>
                                    </div>
                                </div>
                                

                                <div>
                                    <div><label for="salary_startDate">開始日<span class="reruired-field-marker">*</span></label></div>
                                    <div><input class="modal_input" type="date"
                                            name="salary_startDate" required value=${compositeSalary[index].startDate}></div>
                                </div>

                                <div>
                                    <div><label for="salary_endDate">終了日</label></div>
                                    <div><input class="modal_input" type="date" name="salary_endDate" required value=${compositeSalary[index].endDate}></div>
                                </div>
                            </div>`;
        
    }
    return salarySectionHTML;
}
function showLessSalary(compositeSalary){
    var salarySectionHTML=``;
    for (let index = compositeSalary.length-1; index >=0; index--) {
        
        if(index==compositeSalary.length-1)
        {
            salarySectionHTML+=`<div class="row center">
                                
                                <div>
                                    <div><label for="salary">給料<span class="reruired-field-marker">*</span></label></div>
                                    <input type="hidden" name="salaryID" value="${compositeSalary[index].salaryID}">
                                    <div class="row">
                                        <button class="delete">-</button>

                                        <input class="modal_input" type="number" name="salary" required value=${compositeSalary[index].salaryAmount}>
                                    </div>
                                </div>
                                

                                <div>
                                    <div><label for="salary_startDate">開始日<span class="reruired-field-marker">*</span></label></div>
                                    <div><input class="modal_input" type="date"
                                            name="salary_startDate" required value=${compositeSalary[index].startDate}></div>
                                </div>

                                <div>
                                    <div><label for="salary_endDate">終了日</label></div>
                                    <div><input class="modal_input" type="date" name="salary_endDate" required value=${compositeSalary[index].endDate}></div>
                                </div>
                            </div>`;
                        }
                else{
                    salarySectionHTML+=`<div class="row center">
                                
                                <div>
                                    <div><label class="hide" for="salary">給料<span class="hide reruired-field-marker">*</span></label></div>
                                    <input type="hidden" name="salaryID" value="${compositeSalary[index].salaryID}">
                                    <div class="row">
                                        

                                        <input class="hide modal_input" type="hidden" name="salary" required value=${compositeSalary[index].salaryAmount}>
                                    </div>
                                </div>
                                

                                <div>
                                    <div><label class="hide" for="salary_startDate">開始日<span class="hide reruired-field-marker">*</span></label></div>
                                    <div><input class="hide modal_input" type="hidden"
                                            name="salary_startDate" required value=${compositeSalary[index].startDate}></div>
                                </div>

                                <div>
                                    <div><label class="hide" for="salary_endDate">終了日</label></div>
                                    <div><input class="hide modal_input" type="hidden" name="salary_endDate" required value=${compositeSalary[index].endDate}></div>
                                </div>
                            </div>`;
                }
        
    }
    return salarySectionHTML;
        
}

function toggleEntryText(entryInfoData)
{
    //var text="Here is some text that I want added to the HTML file";
    console.log(entryInfoData);
    
    if (entryStatus == "less") {
        entryStatus = "more";
        document.getElementById("entryInfo").innerHTML="";
        renderEntryInfoSection(entryInfoData);
        addEntryInfoRowListener()
        document.getElementById("entryToggleButton").innerText = "See Less";
        
    } 
    else if (entryStatus == "more") {
        entryStatus = "less";
        document.getElementById("entryInfo").innerHTML="";
        renderEntryInfoSection(entryInfoData);
        addEntryInfoRowListener()
        document.getElementById("entryToggleButton").innerText = "See More";
        
    }
}


function showMoreEntry(entryInfoData){
    var entryInfoHTML=``;
    for (let index = 0; index < entryInfoData.length; index++) {
        entryInfoHTML+=`<div class="row center">
                                
                                <div>
                                    <div><label for="user_admissionDay">開始日<span class="reruired-field-marker">*</span></label></div>
                                    <input type="hidden" name="employmentID" value="${entryInfoData[index].employmentID}">
                                    <div class="row">
                                        <button class="delete">-</button>
                                        <div><input class="modal_input" type="date" name="user_admissionDay" value=${entryInfoData[index].startDate} required></div>
                                    </div>
                                </div>

                                <div>
                                    <div><label for="user_resignationDay">終了日</label></div>
                                    <div><input class="modal_input" type="date" name="user_resignationDay" value=${entryInfoData[index].endDate} required></div>
                                </div>
                            </div>`;
        
    }
    return entryInfoHTML;
}
function showLessEntry(entryInfoData){
    var entryInfoHTML=``;
    for (let index = entryInfoData.length-1; index >=0; index--) {
        
        if(index==entryInfoData.length-1)
        {
            entryInfoHTML+=`<div class="row center">
                                    
                                    <div>
                                        <div><label for="user_admissionDay">開始日<span class="reruired-field-marker">*</span></label></div>
                                        <input type="hidden" name="employmentID" value="${entryInfoData[index].employmentID}">
                                        <div class="row">
                                            <button class="delete">-</button>
                                            <div><input class="modal_input" type="date" name="user_admissionDay" value=${entryInfoData[index].startDate} required></div>
                                        </div>
                                    </div>

                                    <div>
                                        <div><label for="user_resignationDay">終了日</label></div>
                                        <div><input class="modal_input" type="date" name="user_resignationDay" value=${entryInfoData[index].endDate} required></div>
                                    </div>
                                </div>`;
        }
        else{
            entryInfoHTML+=`<div class="row center">
                                    
                                    <div>
                                        
                                        <input type="hidden" name="employmentID" value="${entryInfoData[index].employmentID}">
                                        
                                            
                                        <div><input class="modal_input" type="hidden" name="user_admissionDay" value=${entryInfoData[index].startDate} required></div>
                                        
                                    </div>

                                    <div>
                                        
                                        <div><input class="modal_input" type="hidden" name="user_resignationDay" value=${entryInfoData[index].endDate} required></div>
                                    </div>
                                </div>`;
        }
        
    }
    return entryInfoHTML;
        
}

var user_editUserID;

function deleteRowActionListener() {

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


function renderSalarySection(compositeSalary){
    // <div class="modal-form-input-container _dark flex-col" id="user-edit-Salary">
    var salarySectionHTML=`
                        <span>
                            <div style="font-size:20px; margin-left:12px">
                                給料情報
                            </div>
                            <button class="modal_addBtn" id="salary_Add">+</button>`;
                            if(salaryStatus=="less"){
                                salarySectionHTML+=showLessSalary(compositeSalary);
                            }
                            else{
                                salarySectionHTML+=showMoreSalary(compositeSalary);
                            }
                            
                    salarySectionHTML+=`</span>
                    <a id="toggleButton" href="javascript:void(0);">See More</a>
                    `;
    // var remarkHTMLString= `<div class="modal-form-input-container" id='user-edit-remark'>
    //                     <div class="_full">
    //                         <div><label for="name">Remarks<span class="reruired-field-marker"></span></label></div>
    //                         <div><input type="textarea" id="user_edit_remarks" class="project_textarea" name="remarks" value=""></div>
    //                     </div>
    //                 </div>`;
    // string=salarySectionHTML+remarkHTMLString;
    //console.log(string2);
    var loggedInUser=jQuery("#user-authority").val();
    if(loggedInUser!='一般ユーザー')
    {
        document.getElementById('user-edit-Salary').innerHTML=salarySectionHTML;
        deleteRowActionListener();
    }

    document.getElementById("toggleButton").onclick= function(){
        toggleSalaryText(compositeSalary);
    }
}

function addSalaryRowListener()
{
    var selects = document.querySelector("#user-edit-Salary").getElementsByTagName("input");

    //console.log("hello from the other world");
    for (let i = 0; i < selects.length; i++) {
        console.log(selects[i]);

        selects[i].addEventListener("change", function () {
            console.log(this.value);
            selects[i].setAttribute("value", selects[i].value);
        });
    }
    document.getElementById('salary_Add').onclick=function(){
        
        
        document.querySelector('#user-edit-Salary span').innerHTML+=`<div class="row center">
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
        
        document.querySelector('#entryInfo span').innerHTML+=`<div class="row center">
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

function renderEntryInfoSection(entryInfoData){
    console.log(entryInfoData);
    var entryInfoHTML=` <span>
                            <div style="font-size:20px; margin-left:12px">
                                入社情報
                            </div>
                            <button class="modal_addBtn" id="entryInfo_Add">+</button>`;
                            if(entryStatus=="less"){
                                entryInfoHTML+=showLessEntry(entryInfoData);
                            }
                            else{
                                entryInfoHTML+=showMoreEntry(entryInfoData);
                            }
                            
                            
                        entryInfoHTML+=`</span>
                        <a id="entryToggleButton" href="javascript:void(0);">See More</a>`;
    
    jQuery('#entryInfo').append(entryInfoHTML);
    setTimeout(() => {
        
        document.getElementById("entryToggleButton").onclick= function(){
            console.log("hi");
            toggleEntryText(entryInfoData);
        }
    }, 1000);
    
    
}


var resetEditHTML=document.getElementById('user-edit-modal').innerHTML;

function userEditModalHandler(userID) {
    event.preventDefault();
    user_editUserID=userID;
    document.getElementById('user-edit-modal').innerHTML=resetEditHTML;
    showModal('user-edit-modal');
    getUserData(userID);        
}

function salaryFormatting(array_Salary){
    var formattedSalary=[];
    for (let index = 0; index <array_Salary.length; ) {
        var smallArr=[];
        for(let j=0;j<4;j++){
            smallArr.push(array_Salary[index]);
            index++;
        }
        formattedSalary.push(smallArr);
    }
    console.log(formattedSalary);
    return formattedSalary;
}
function entryInfoFormatting(array_entry){
    var formattedEntryInfo=[];
    console.log(array_entry);
    for (let index = 0; index <array_entry.length; ) {
        var smallArr=[];
        for(let j=0;j<3;j++){
            smallArr.push(array_entry[index]);
            index++;
        }
        formattedEntryInfo.push(smallArr);
    }
    console.log(formattedEntryInfo);
    return formattedEntryInfo;
}

function getEditFormData() {
    return {
        userCode: $('#user_edit_userID').val(),
        name: $('#user_edit_nameInput').val(),
        email: $('#user_edit_emailInput').val(),
        password: $('#user_edit_passwordInput').val(),
        tel: $('#user_edit_telInput').val(),
        position: $('#user_edit_positionInput').val(),
        positionText: $("#user_edit_positionInput").find(":selected").text(),
        location: $('#user_edit_locationInput').val(),
        locationText: $("#user_edit_locationInput").find(":selected").text(),
        entry_info: entryInfoFormatting($('#entryInfo input').serialize().split('&')),
        unit_price: salaryFormatting($('#user-edit-Salary input').serialize().split('&')),
        user_authority: $('#user_edit_authorityInput').val(),
        _token: $('input[name=_token]').val(),
        favChecked:$('#userEdit-favFlag').prop("checked"),
        activeChecked:$('#userEdit-activeFlag').prop("checked"),
        condition1:$('#user_edit_condition1').val(),
        condition2:$('#user_edit_condition2').val(),
        locker:$('#user_edit_locker').val(),
        remarks:$('#user_edit_remarks').val()
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

function updateUserEditModalData(userObj) {
    console.log(userObj.compositeSalary);
    console.log(userObj.compositeEmployment);
    var salaryLength=userObj.compositeSalary.length;
    var entryLength=userObj.compositeEmployment.length;
    renderEntryInfoSection(userObj.compositeEmployment);
    renderSalarySection(userObj.compositeSalary);
    addSalaryRowListener();
    deleteRowActionListener();
    addEntryInfoRowListener();
    entryInfoDeleteRowActionListener();

    for (let i = 0; i < userObj.length; i++) {
        if (data[i] == null)
            data[i] = "";
    }

    $("#user_edit_userID").val(userObj.userCode)
    $("#user_edit_nameInput").val(userObj.userName)
    $("#user_edit_emailInput").val(userObj.email)
    switch(userObj.gender){
        case '女性':
        $("#user_edit_Gender").val(1);
        break;
        case '男性':
        $("#user_edit_Gender").val(2);
        break;
        default:
        $("#user_edit_Gender").val(1);
        break;

    }
    
    $("#user_edit_telInput").val(userObj.tel)
    $("#user_edit_locationInput").val(userObj.location)
    
    switch(userObj.position){
        case 'PM':
            $("#user_edit_positionInput").val('PM');
            break;
        case 'PL':
            $("#user_edit_positionInput").val('PL')
            break;
        case 'PG':
            $("#user_edit_positionInput").val('PG')
            break;
        case 'SE':
            $("#user_edit_positionInput").val('SE')
            break;
        default:
        $("#user_edit_positionInput").val('SE')
        break;

    }
    //$("#user_edit_employeeType").val(userObj.employeeClassification)
    switch(userObj.employeeClassification){
        case 'full-time':
            $("#user_edit_employeeType").val(1);
            break;
        case 'part-time':
            $("#user_edit_employeeType").val(2);
            break;
        case 'part-time':
            $("#user_edit_employeeType").val(3);
            break;
        default:
            $("#user_edit_employeeType").val(1);
            break;

    }
    
    switch(userObj.location){
        case '宮崎':
            $("#user_edit_locationInput").val('宮崎');
            break;
        case '東京':
            $("#user_edit_locationInput").val('東京');
            break;
        case '福岡':
            $("#user_edit_locationInput").val('福岡');
            break;
        default:
            $("#user_edit_locationInput").val('宮崎');
            break;

    }
    switch(userObj.userAuthority){
        case 'システム管理者':
            $("#user_edit_authorityInput").val('システム管理者');
            break;
        case '一般管理者':
            $("#user_edit_authorityInput").val('一般管理者');
            break;
        case '一般ユーザー':
            $("#user_edit_authorityInput").val('一般ユーザー');
            break;
        default:
            $("#user_edit_authorityInput").val('システム管理者');
            break;

    }
    $("#user_edit_remarks").val(userObj.remark);
    $("#user_edit_condition1").val(userObj.condition1);
    $("#user_edit_condition2").val(userObj.condition2);
    $("#user_edit_locker").val(userObj.locker);
    $('#user_edit_emergency').val(userObj.emergencyContact);
    
    //$("#user_edit_admission_dayInput").val(userObj.admission_day)
    
   
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
                // updateUserEditModalData(response["resultData"]);
                updateUserEditModalData(userObj);
                
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

function updateFavorites_AJAXcall(checkedStatus){
    $.ajax({
        type: "post",
        url: "/API/updateFavoriteStatus",
        data: {
            _token: $('#CSRF-TOKEN').val(),
            itemID: user_editUserID,
            itemType: config('constants.Table.user'),
            favoriteStatus:checkedStatus
        },
        cache: false,
        success: function(response) {
            if (response["resultStatus"]["isSuccess"])
                console.log("success");
            else
                handleAJAXResponse(response);
                closeModal('user-edit-modal');
        },
        error: function(err) {
            handleAJAXError(err);
        }
    });

}

var userObj={
        userID:1,
        userCode: "AEP1234",
        userName: "志田",
        email: "shida@gtmi.co.jp",
        gender: "女性",
        location:'宮崎',
        tel: "123456",
        position:"SE",
        employeeClassification: "full-time",
        affiliationID: null,
        emergencyContact:"345678",
        condition1:"null",
        condition2:"null",
        locker:"12345",
        remark:"動力家",
        userAuthority:"一般管理者",
        isFavorite:true,
        isActive:false,
        compositeSalary:[
            {
                salaryID:0,
                startDate:"2012-12-20",
                endDate:"2013-10-20",
                salaryAmount:2200000
            },

            {
                salaryID:1,
                startDate:"2013-11-20",
                endDate:"2014-10-20",
                salaryAmount:2300000
            }

        ],
        
        compositeEmployment:[
            {
                employmentID:0,
                startDate:"2013-11-20",
                endDate:"2014-10-20",
                isResign:false
            },
            {
                employmentID:1,
                startDate:"2013-11-20",
                endDate:"2014-10-20",
                isResign:false
            },
            {
                employmentID:2,
                startDate:"2013-11-20",
                endDate:"2014-10-20",
                isResign:false
            }
        ]
    }

</script>