<div class="modal-container" id="project-create-modal">

    <div class="modal-title primary">
        <span class="form-ht">クライアント登録</span>
        <span class="fa fa-chevron-up close" onclick="closeModal('project-create-modal')"></span>
    </div>

    <div class="modal-form-container _project">
        <form id="reg_form" action="" method="">
            @csrf

            <div class="row">

                <div class="column left">
                    <div>
                        <img src="{{ asset('img/project_dp.png') }}" class="dp _project" alt="display photo">
                    </div>
                    <div>
                        <span>アクティブ</span>
                        <label class="switch">
                            <input type="checkbox" id="projectReg-activeFlag" checked>
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div class="fav">
                        <span>お気に入り</span>
                        <label class="switch">
                            <input type="checkbox" id="projectReg-favFlag" checked>
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div>
                        <button type="submit" onclick="createProject()"><i class="fa fa-floppy-o" aria-hidden="true"></i>
                            登録</button>
                    </div>

                    {{-- <div>
                        <button type="submit" class="heart">
                            <i class="fa fa-heart" aria-hidden="true"></i> お気に入り
                        </button>
                    </div> --}}

                    <div>
                        <button type="submit" class="cancel" onclick="closeModal('project-create-modal')"><i class="fa fa-times" aria-hidden="true"></i> 戻る</button>
                    </div>
                </div>

                <div class="column right _project">

                    <div class="modal-form-input-container">
                        <div class="_half">
                            <div><label for="projectID">案件コード<span class="reruired-field-marker">*</span></label></div>
                            <div><input class="modal_input" type="text" id="project_create_projectID" name="projectID" required></div>
                        </div>
                        <div class="_half">
                            <div><label for="name">案件名<span class="reruired-field-marker">*</span></label></div>
                            <div><input class="modal_input" type="text" id="project_create_name_Input" name="name" required></div>
                        </div>
                    </div>

                    <div class="modal-form-input-container _dark">
                        <div class="_half">
                            <div><label for="client_id">顧客<span class="reruired-field-marker">*</span></label></div>
                            <div><input class="modal_input" type="number" id="project_create_clientID_Input" name="client_id" required>
                            </div>
                        </div>
                        <div class="_half">
                            <div><label for="manager_id">担当</label></div>
                            <div><input class="modal_input" type="number" id="project_create_managerID_Input" name="manager_id">
                            </div>
                        </div>
                    </div>

                    <div class="modal-form-input-container">
                        <div class="_third">
                            <div><label>見込</label></div>
                            <div class="custom-select">
                                <select class="modal_input" id="project_create_order_status_Input">
                                    @foreach (config('constants.Order_Status') as $status => $value)
                                    <option>{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="_third">
                            <div><label>営業状況</label></div>
                            <div class="custom-select">
                                <select class="modal_input" id="project_create_business_situation_Input">
                                    @foreach (config('constants.Business_situation') as $situation => $value)
                                    <option>{{ $situation }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="_third">
                            <div><label for="development_stage">作業工程</label></div>
                            <div class="custom-select">
                                <select class="modal_input" id="project_create_development_stage_Input">
                                    @foreach (config('constants.Development_stage') as $stage => $value)
                                    <option>{{ $stage }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-form-input-container _dark">

                        <div class="_third">
                            <div><label for="sales_total">売上高<span class="reruired-field-marker">*</span></label></div>
                            <div><input class="modal_input" type="number" id="project_create_sales_total_Input" name="sales_total" required>
                            </div>
                        </div>

                        <div class="_third">
                            <div><label for="transferred_amount">振込金額<span class="reruired-field-marker">*</span></label></div>
                            <div><input class="modal_input" type="number" id="project_create_transferred_amount_Input"
                                    name="transferred_amount" required></div>
                        </div>

                        <div class="_third">
                            <div><label for="budget">予算<span class="reruired-field-marker">*</span></label></div>
                            <div><input class="modal_input" type="number" id="project_create_budget_Input" name="budget" required></div>
                        </div>
                    </div>

                    <div class="modal-form-input-container">
                        <div class="_half">
                            <div><label for="order_month">受注月</label></div>
                            <div><input class="modal_input" type="date" id="project_create_order_month_Input" name="inspection_month"></div>
                        </div>

                        <div class="_half">
                            <div><label for="inspection_month">検収月</label></div>
                            <div><input class="modal_input" type="date" id="project_create_inspection_month_Input" name="inspection_month"></div>
                        </div>
                    </div>
                    <div class="modal-form-input-container">

                        <div class="_half">
                            <div><label for="salesDept">Department Sales</label></div>
                            {{-- @if ($loggedUser->user_authority == 'システム管理者') --}}
                            <div>
                                <input class="modal_input" type="text" id="project_create_salesDept" name="salesDept" value="">
                            </div>
                            
                        </div>

                        <div class="_half">
                            <div><label for="salesCost">Cost of Sales</label></div>
                            <div>
                                <input class="modal_input" type="text" id="project_create_salesCost" name="salesCost" value="">
                            </div>
                            
                        </div>
                    </div>
                    <div class="modal-form-input-container _dark">
                        <input type="hidden" name="estimateID" id="project_create_estimateID" value="">

                        <div class="_third">
                            <div><label for="estimateCode">Estimate Code<span class="reruired-field-marker">*</span></label></div>
                            <div><input class="modal_input" type="text" id="project_create_estimateCode" name="estimateCode" required>
                            </div>
                        </div>

                        <div class="_third">
                            <div><label for="estimateStatus">Estimate Status<span class="reruired-field-marker">*</span></label></div>
                            <div><input class="modal_input" type="number" id="project_create_estimateStatus"
                                    name="estimateStatus" required></div>
                        </div>

                        <div class="_third">
                            <div><label for="estimateCost">Estimate Cost<span class="reruired-field-marker">*</span></label></div>
                            <div><input class="modal_input" type="number" id="project_create_estimateCost" name="estimateCost" required></div>
                        </div>
                    </div>
                    <div class="modal-form-input-container">
                        <div class="_full">
                            <div><label for="name">Remarks<span class="reruired-field-marker"></span></label></div>
                            <div><input type="textarea" id="project_create_remarks" class="project_textarea" name="remarks" value=""></div>
                        </div>
                    </div>

                </div>

            </div>
            <div id="message"></div>

        </form>
    </div>
</div>



<script>
$(function() {
    convertToSearchableDropDown("project_create_managerID_Input", "USER");
    convertToSearchableDropDown("project_create_clientID_Input", "CLIENT");
})
var resetCreateHTML=document.getElementById('project-create-modal').innerHTML;
function resetHTML(){
    document.getElementById('project-create-modal').innerHTML=resetCreateHTML;
}
function ProjectRegisterModalHandler() {

    event.preventDefault();
    resetHTML();
    convertToSearchableDropDown("project_create_managerID_Input", "USER");
    convertToSearchableDropDown("project_create_clientID_Input", "CLIENT");
    showModal('project-create-modal');
}

function getProjectRegFormData() {
    return {
        projectName: $('#project_create_name_Input').val(),
        clientID: $('#project_create_clientID_Input').val(),
        projectLeaderID: $('#project_create_managerID_Input').val(),
        orderMonth: $('#project_create_order_month_Input').val(),
        inspectionMonth: $('#project_create_inspection_month_Input').val(),
        orderStatus: $('#project_create_order_status_Input').val(),
        businessSituation: $('#project_create_business_situation_Input').val(),
        developmentStage: $('#project_create_development_stage_Input').val(),
        salesTotal: $('#project_create_sales_total_Input').val(),
        transferredAmount: $('#project_create_transferred_amount_Input').val(),
        budget: $('#project_create_budget_Input').val(),
        _token: $('input[name=_token]').val(),
        favChecked:$('#projectReg-favFlag').prop("checked"),
        activeChecked:$('#projectReg-activeFlag').prop("checked")
    };
}


function handleAJAXResponse(response) {
    if (response["resultStatus"]["isSuccess"])
        $('#message').html("Operation Successful");
    else if (response["resultStatus"]["errorMessage"] === "UNAUTHORIZED_ACTION")
        $('#message').html("You are not authorized to make this change");
    else
        $('#message').html("Unhandled Status: " + response["resultStatus"]["errorMessage"]);
}



function createProject() {
    event.preventDefault();
    modalData = getProjectRegFormData();

    $.ajax({
        type: "post",
        url: "/API/createProject",
        data: modalData,
        cache: false,
        success: function(response) {
            if (response["resultStatus"]["isSuccess"]) {
                // updateProjectTable(modalData);
                closeModal('project-create-modal');
            } else
                handleAJAXResponse(response);
        },
        error: function(err) {
            handleAJAXError(err);
            
        }
    });
}
</script>