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
                        <span>アクティブ</span>
                        <label class="switch">
                            <input type="checkbox" id="projectEdit-activeFlag" checked>
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div class="fav">
                        <span>お気に入り</span>
                        <label class="switch">
                            <input type="checkbox" id="projectEdit-favFlag" checked>
                            <span class="slider round"></span>
                        </label>
                    </div>

                    <div>
                        <button type="submit" onclick="updateProject()">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i>
                            更新
                        </button>
                    </div>

                    {{-- <div>
                        <button type="submit" class="heart">
                            <i class="fa fa-heart" aria-hidden="true"></i> お気に入り
                        </button>
                    </div> --}}

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
                        <div class="_half">
                            <div><label for="projectID">案件コード<span class="reruired-field-marker">*</span></label></div>
                            <div><input class="modal_input" type="text" id="project_edit_projectID" name="projectID" required></div>
                        </div>
                        <div class="_half">
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
                            <div><label for="manager_id">担当</label></div>
                            <div><input class="modal_input" type="number" id="project_edit_managerID_Input" name="manager_id">
                            </div>
                        </div>
                    </div>

                    <div class="modal-form-input-container">
                        <div class="_third">
                            <div><label>見込</label></div>
                            <div class="custom-select">
                                <select class="modal_input" id="project_edit_order_status_Input">
                                    @foreach (config('constants.Order_Status') as $status => $value)
                                    <option>{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="_third">
                            <div><label>営業状況</label></div>
                            <div class="custom-select">
                                <select class="modal_input" id="project_edit_business_situation_Input">
                                    @foreach (config('constants.Business_situation') as $situation => $value)
                                    <option>{{ $situation }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="_third">
                            <div><label for="development_stage">作業工程</label></div>
                            <div class="custom-select">
                                <select class="modal_input" id="project_edit_development_stage_Input">
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
                            <div><label for="order_month">受注月</label></div>
                            <div><input class="modal_input" type="date" id="project_edit_order_month_Input" name="order_month"></div>
                        </div>

                        <div class="_half">
                            <div><label for="inspection_month">検収月</label></div>
                            <div><input class="modal_input" type="date" id="project_edit_inspection_month_Input" name="inspection_month"></div>
                        </div>
                    </div>
                    <div class="modal-form-input-container">

                        <div class="_half">
                            <div><label for="salesDept">Department Sales</label></div>
                            {{-- @if ($loggedUser->user_authority == 'システム管理者') --}}
                            <div>
                                <input class="modal_input" type="text" id="project_edit_salesDept" name="salesDept" value="">
                            </div>
                            
                        </div>

                        <div class="_half">
                            <div><label for="salesCost">Cost of Sales</label></div>
                            <div>
                                <input class="modal_input" type="number" id="project_edit_salesCost" name="salesCost" value="">
                            </div>
                            
                        </div>
                    </div>
                    <div class="modal-form-input-container _dark flex-col" id="project-edit-estimationInfo">
                        
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

var estimateStatus="less";

function addEstimateRowListener()
{
    var selects = document.querySelector("#project-edit-estimationInfo").getElementsByTagName("input");

    for (let i = 0; i < selects.length; i++) {
        console.log(selects[i]);

        selects[i].addEventListener("change", function () {
            console.log(this.value);
            selects[i].setAttribute("value", selects[i].value);
        });
    }
    document.getElementById('estimate_Add').onclick=function(){
        
        
        document.querySelector('#project-edit-estimationInfo span').innerHTML+=`<div class="row center">
                                
                                <input type="hidden" name="estimateID" id="project_edit_estimateID" value="">

                                <div class="_third">
                                    <div><label for="estimateCode">Estimate Code</label></div>
                                    <div class="row">
                                        <button class="delete">-</button>
                                        <div><input class="modal_input" type="number" id="project_edit_estimateCode" name="estimateCode"></div>
                                    </div>
                                </div>

                                <div class="_third">
                                    <div><label for="estimateStatus">Estimate Status</label></div>
                                    <div><input class="modal_input" type="number" id="project_edit_estimateStatus"
                                            name="estimateStatus"></div>
                                </div>

                                <div class="_third">
                                    <div><label for="estimateCost">Estimate Cost</label></div>
                                    <div><input class="modal_input" type="number" id="project_edit_estimateCost" name="estimateCost"></div>
                                </div>
                            </div>`;
                            
                            
                            addEstimateRowListener();
                            projectEdit_deleteRowActionListener();
        }
        
        
}


function toggleEstimateText(compositeEstimate)
{
    
    console.log(compositeEstimate);
    
    if (estimateStatus == "less") {
        estimateStatus = "more";
        document.getElementById("project-edit-estimationInfo").innerHTML="";
        renderEstimateSection(compositeEstimate);
        
        addEstimateRowListener();
        document.getElementById("toggleButton").innerText = "See Less";
        
    } 
    else if (estimateStatus == "more") {
        estimateStatus = "less";
        document.getElementById("project-edit-estimationInfo").innerHTML="";
        //document.getElementById("user-edit-remark").remove();
        setTimeout(
            renderEstimateSection(compositeEstimate),2000

        ),
        addEstimateRowListener();
        document.getElementById("toggleButton").innerText = "See More";
        
    }
}

function projectEdit_deleteRowActionListener() {

document.getElementById("project-edit-estimationInfo").querySelectorAll(".delete").forEach(function (obj, index) {
    obj.addEventListener("click", function (event) {

            this.parentNode.parentNode.parentNode.remove();
            projectEdit_deleteRowActionListener();
        
    });
});
}
function showMoreEstimation(compositeEstimate){
    var estimateSectionHTML=``;
    for (let index = compositeEstimate.length-1; index >=0; index--) {
        estimateSectionHTML+=`<div class="row center">
                                
                                <input type="hidden" name="estimateID" id="project_edit_estimateID" value="">

                                <div class="_third">
                                    <div><label for="estimateCode">Estimate Code</label></div>
                                    <div class="row">
                                        <button class="delete">-</button>
                                        <div><input class="modal_input" type="number" id="project_edit_estimateCode" name="estimateCode"></div>
                                    </div>
                                </div>

                                <div class="_third">
                                    <div><label for="estimateStatus">Estimate Status</label></div>
                                    <div><input class="modal_input" type="number" id="project_edit_estimateStatus"
                                            name="estimateStatus"></div>
                                </div>

                                <div class="_third">
                                    <div><label for="estimateCost">Estimate Cost</label></div>
                                    <div><input class="modal_input" type="number" id="project_edit_estimateCost" name="estimateCost"></div>
                                </div>
                            </div>`;
        
    }
    return estimateSectionHTML;
}

function showLessEstimation(compositeEstimate){
    var estimateSectionHTML=``;
    for (let index = compositeEstimate.length-1; index >=0; index--) {
        
        if(index==compositeEstimate.length-1)
        {
            estimateSectionHTML+=`<div class="row center">
                                
                                    <input type="hidden" name="estimateID" id="project_edit_estimateID" value="">

                                    <div class="_third">
                                        <div><label for="estimateCode">Estimate Code</label></div>
                                        <div class="row">
                                            <button class="delete">-</button>
                                            <div><input class="modal_input" type="number" id="project_edit_estimateCode" name="estimateCode"></div>
                                        </div>
                                    </div>

                                    <div class="_third">
                                        <div><label for="estimateStatus">Estimate Status</label></div>
                                        <div><input class="modal_input" type="number" id="project_edit_estimateStatus"
                                                name="estimateStatus"></div>
                                    </div>

                                    <div class="_third">
                                        <div><label for="estimateCost">Estimate Cost</label></div>
                                        <div><input class="modal_input" type="number" id="project_edit_estimateCost" name="estimateCost"></div>
                                    </div>
                                </div>`;
                        }
                else{
                    estimateSectionHTML+=`<div class="row center">
                                
                                <input type="hidden" name="estimateID" id="project_edit_estimateID" value="">

                                <div class="_third">
                                    
                                    <div><input class="modal_input" type="hidden" id="project_edit_estimateCode" name="estimateCode">
                                    </div>
                                </div>

                                <div class="_third">
                                    
                                    <div><input class="modal_input" type="hidden" id="project_edit_estimateStatus"
                                            name="estimateStatus"></div>
                                </div>

                                <div class="_third">
                                    
                                    <div><input class="modal_input" type="hidden" id="project_edit_estimateCost" name="estimateCost"></div>
                                </div>
                            </div>`;
                                
                }
        
    }
    return estimateSectionHTML;
        
}

function renderEstimateSection(compositeEstimate){
    
    var estimateSectionHTML=`
                        <span>
                            <div style="font-size:20px; margin-left:12px">
                                Estimation Info
                            </div>
                            <button class="modal_addBtn" id="estimate_Add">+</button>`;
                            if(estimateStatus=="less"){
                                estimateSectionHTML+=showLessEstimation(compositeEstimate);
                            }
                            else{
                                estimateSectionHTML+=showMoreEstimation(compositeEstimate);
                            }
                            
                    estimateSectionHTML+=`</span>
                    <a id="toggleButton" href="javascript:void(0);">See More</a>
                    `;
    
    var loggedInUser=jQuery("#user-authority").val();
    if(loggedInUser!='一般ユーザー')
    {
        document.getElementById('project-edit-estimationInfo').innerHTML=estimateSectionHTML;
        projectEdit_deleteRowActionListener();
    }

    document.getElementById("toggleButton").onclick= function(){
        toggleEstimateText(compositeEstimate);
    }
}




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
        _token: $('input[name=_token]').val(),
        favChecked:$('#projectEdit-favFlag').prop("checked"),
        activeChecked:$('#projectEdit-activeFlag').prop("checked")
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

    renderEstimateSection(compositeEstimate);
    addEstimateRowListener();
    projectEdit_deleteRowActionListener();
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


var compositeEstimate=[
    {
        estimateID:1
    },
    {
        estimateID:1
    }
];
</script>