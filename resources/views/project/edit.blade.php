<div class="modal-container" id="project-edit-modal">

    <div class="modal-title primary">
        <span class="form-ht">プロジェクト編集</span>
        <span class="fa fa-chevron-up close" onclick="closeModal('project-edit-modal')"></span>
    </div>

    <div class="modal-form-container _project">
        <form id="edit_form" action="" method="">
            @csrf

            <div class="row">
                <div class="column left">
                    <div>
                        <img src="{{ asset('img/project_dp.png') }}" class="dp _project" alt="display photo">
                    </div>

                    <div>
                        <button type="submit" onclick="updateProject()">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i>
                            更新
                        </button>
                    </div>

                    <div>
                        <button type="submit" class="cancel" onclick="closeModal('project-edit-modal')">
                            <i class="fa fa-times" aria-hidden="true"></i> 戻る
                        </button>
                    </div>

                    @if ($loggedInUser->user_authority == ('システム管理者'))
                    <div onclick="deleteProject()">
                        <a class="button delete-button" id="deleteButton"> <i class="fa fa-trash-o"
                                aria-hidden="true"></i>
                            削除</a>
                    </div>
                    @endif
                </div>


                <div class="column right _project">

                    <input type="hidden" id="id" value="">

                    <div class="modal-form-input-container">
                        <div class="_full">
                            <div><label for="name">案件名<span class="reruired-field-marker">*</span></label></div>
                            <div><input class="modal_input" type="text" id="project_edit_name_Input" name="name" required></div>
                        </div>
                    </div>

                    <div class="modal-form-input-container _dark">
                        <div class="_half">
                            <div><label for="client_id">顧客<span class="reruired-field-marker">*</span></label></div>
                            <div><input class="modal_input" type="number" id="project_edit_clientID_Input" name="client_id" required>
                            </div>
                        </div>
                        <div class="_half">
                            <div><label for="manager_id">担当<span class="reruired-field-marker">*</span></label></div>
                            <div><input class="modal_input" type="number" id="project_edit_managerID_Input" name="manager_id" required>
                            </div>
                        </div>
                    </div>

                    <div class="modal-form-input-container">
                        <div class="_third">
                            <div><label>見込</label></div>
                            <div class="custom-select">
                                <select class="modal_input" id="project_edit_order_status_Input" required>
                                    @foreach (config('constants.Order_Status') as $status => $value)
                                    <option>{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="_third">
                            <div><label>営業状況</label></div>
                            <div class="custom-select">
                                <select class="modal_input" id="project_edit_business_situation_Input" required>
                                    @foreach (config('constants.Business_situation') as $situation => $value)
                                    <option>{{ $situation }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="_third">
                            <div><label for="development_stage">作業工程</label></div>
                            <div class="custom-select">
                                <select class="modal_input" id="project_edit_development_stage_Input" required>
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
                            <div><input class="modal_input" type="number" id="project_edit_sales_total_Input" name="sales_total" required>
                            </div>
                        </div>

                        <div class="_third">
                            <div><label for="transferred_amount">振込金額<span class="reruired-field-marker">*</span></label></div>
                            <div><input class="modal_input" type="number" id="project_edit_transferred_amount_Input"
                                    name="transferred_amount" required></div>
                        </div>

                        <div class="_third">
                            <div><label for="budget">予算<span class="reruired-field-marker">*</span></label></div>
                            <div><input class="modal_input" type="number" id="project_edit_budget_Input" name="budget" required></div>
                        </div>
                    </div>

                    <div class="modal-form-input-container">
                        <div class="_half">
                            <div><label for="order_month">受注月<span class="reruired-field-marker">*</span></label></div>
                            <div><input class="modal_input" type="date" id="project_edit_order_month_Input" name="order_month"
                                    required></div>
                        </div>

                        <div class="_half">
                            <div><label for="inspection_month">検収月</label></div>
                            <div><input class="modal_input" type="date" id="project_edit_inspection_month_Input" name="inspection_month"
                                    required></div>
                        </div>
                    </div>
                    <div class="modal-form-input-container">

                        <div class="_half">
                            <div><label for="condition">Estimate ID<span class="reruired-field-marker">*</span></label></div>
                            {{-- @if ($loggedUser->user_authority == 'システム管理者') --}}
                            <div>
                                <input class="modal_input" type="text" id="user_edit_condition1" name="condition" value="" required>
                            </div>
                            
                        </div>

                        <div class="_half">
                            <div><label>Working Process</label></div>
                            <div>
                                <input class="modal_input" type="text" id="user_edit_condition2" name="condition" value="" required>
                            </div>
                            
                        </div>
                    </div>
                    <div class="modal-form-input-container">

                        <div class="_half">
                            <div><label for="condition">Department Sales<span class="reruired-field-marker">*</span></label></div>
                            {{-- @if ($loggedUser->user_authority == 'システム管理者') --}}
                            <div class="custom-select">
                                <select class="modal_input" id="user_edit_employeeType">
                                    
                                        <option value="1">SES</option>
                                        <option value="2">Full-Time</option>
                                        <option value="3">Part-Time</option>  
                                    
                                </select>
                            </div>
                            
                        </div>

                        <div class="_half">
                            <div><label>Cost of Sales</label></div>
                            <div>
                                <input class="modal_input" type="text" id="user_edit_locker" name="locker" value="" required>
                            </div>
                            
                        </div>
                    </div>
                    <div class="modal-form-input-container">
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
$(function() {
    convertToSearchableDropDown("project_edit_managerID_Input", "USER");
    convertToSearchableDropDown("project_edit_clientID_Input", "CLIENT");
})

function projectEditModalHandler(projectID) {
    event.preventDefault();
    event.stopPropagation();
    clearModalData('project-edit-modal');
    showModal('project-edit-modal');

    getProjectData(projectID);
}

function getProjectEditFormData() {
    return {
        projectID: $('#id').val(),
        projectName: $('#project_edit_name_Input').val(),
        clientID: $('#project_edit_clientID_Input').val(),
        projectLeaderID: $('#project_edit_managerID_Input').val(),
        orderStatus: $("#project_edit_order_status_Input").val(),
        businessSituation: $('#project_edit_business_situation_Input').val(),
        developmentStage: $("#project_edit_development_stage_Input").val(),
        orderMonth: $('#project_edit_order_month_Input').val(),
        inspectionMonth: $('#project_edit_inspection_month_Input').val(),
        salesTotal: $('#project_edit_sales_total_Input').val(),
        transferredAmount: $('#project_edit_transferred_amount_Input').val(),
        budget: $('#project_edit_budget_Input').val(),
        _token: $('input[name=_token]').val()
    };
}

function handleAJAXResponse(response) {

    if (response["resultStatus"]["isSuccess"])
        updateProjectTable();

    else if (response["resultStatus"]["errorMessage"] === "UNAUTHORIZED_ACTION")
        $('#message').html("You are not authorized to make this change");

    else
        $('#message').html("Unhandled Status: " + response["resultStatus"]["errorMessage"]);
}



function updateProjectTable(updatedData) {
    // console.log(updatedData);

    // console.log("UDPATE Project TABLE")

    let row = $("#project-row-" + updatedData.id);

    row.find(".project-name").html(updatedData.project_name);
    row.find(".project-clientID").html(updatedData.client_id);
    row.find(".project-managerID").html(updatedData.manager_id);
    row.find(".project-orderMonth").html(updatedData.order_month);
    row.find(".project-inspectionMonth").html(updatedData.inspection_month);
    row.find(".project-orderStatus").html(updatedData.order_status);
    row.find(".project-businessSituation").html(updatedData.business_situation);
    row.find(".project-developmentStage").html(updatedData.development_stage);
    row.find(".project-salesTotal").html(updatedData.sales_total);
    row.find(".project-transferredAmount").html(updatedData.transferred_amount);

    /*row.find(".user-location").html(updatedData.locationText);

    positionDom = row.find(".pos");
    positionDom.html(updatedData.positionText);
    positionDom.removeClass();
    positionDom.addClass("pos");
    positionDom.addClass("pos-" + updatedData.positionText); */

}

function updateProjectEditModalData(data) {

    for (let i = 0; i < data.length; i++) {
        if (data[i] == null)
            data[i] = "";
    }

    $("#id").val(data.projectID)
    $("#project_edit_name_Input").val(data.projectName)
    $("#project_edit_clientID_Input").val(data.clientID)
    $("#project_edit_managerID_Input").val(data.projectLeaderID)
    $("#project_edit_order_month_Input").val(data.orderMonth)
    $("#project_edit_inspection_month_Input").val(data.inspectionMonth)
    $("#project_edit_order_status_Input").val(data.orderStatus)
    $("#project_edit_business_situation_Input").val(data.businessSituation)
    $("#project_edit_development_stage_Input").val(data.developmentStage)
    $("#project_edit_sales_total_Input").val(data.salesTotal)
    $("#project_edit_transferred_amount_Input").val(data.transferredAmount)
    $("#project_edit_budget_Input").val(data.budget)
}

function getProjectData(projectID) {
    $.ajax({
        type: "post",
        url: "/API/readProjectDetails",
        data: {
            projectID: projectID,
            _token: $('input[name=_token]').val()
        },
        cache: false,
        success: function(response) {
            if (response["resultStatus"]["isSuccess"]) {
                // console.log(response)
                updateProjectEditModalData(response["resultData"]);
            } else
                handleAJAXResponse(response);
        },
        error: function(err) {
            handleAJAXError(err);
        }
    });
}

function updateProject() {
    event.preventDefault();

    modalData = getProjectEditFormData();
    $.ajax({
        type: "post",
        url: "/API/upsertProjectDetails",
        data: modalData,
        cache: false,
        success: function(response) {
            if (response["resultStatus"]["isSuccess"]) {
                updateProjectTable(modalData);
                closeModal('project-edit-modal');
            } else
                handleAJAXResponse(response);
        },
        error: function(err) {
            handleAJAXError(err);
            updateProjectEditModalData(modalData);
        }
    });
}



function deleteProject() {
    event.preventDefault();
    projectId = $('#id').val();
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
                deleteComfirmed( projectId );
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        })
}

function  deleteComfirmed( projectId ){
    $.ajax({
        type: "post",
        url: "/API/deleteProject",
        data: {
            id: $('#id').val(),
            _token: $('input[name=_token]').val()
        },
        cache: false,
        success: function(response) {
            if (response["resultStatus"]["isSuccess"])
                $("#user-row-" + projectId).remove();
            else
                handleAJAXResponse(response);
            closeModal('project-edit-modal');
        },
        error: function(err) {
            handleAJAXError(err);
        }
    });
}
</script>