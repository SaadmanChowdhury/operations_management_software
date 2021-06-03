<div class="modal-container" id="project-edit-modal">

    <div class="modal-title primary">
        <span class="form-ht">案件編集</span>
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
                            <div><label for="projectCode">案件コード<span class="reruired-field-marker">*</span></label></div>
                            <div><input class="modal_input" type="text" id="project_edit_projectCode" name="projectCode" required></div>
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
                            <div><input type="textarea" id="project_edit_remarks" class="project_textarea" name="remarks" value=""></div>
                        </div>
                    </div>

                </div>

            </div>

        </form>
    </div>
</div>


<script>


var estimateStatus="less";
var resetEditHTML=document.getElementById('project-edit-modal').innerHTML;
function renderEstimateRow(){

    var html= `<div class="row center">
                                
                <input type="hidden" name="estimateID" id="project_edit_estimateID" value="">

                <div class="_third">
                    <div><label for="estimateCode">Estimate Code</label></div>
                    <div class="row">
                        <button class="delete">-</button>
                        <div><input class="modal_input" type="text" id="project_edit_estimateCode" name="estimateCode"></div>
                    </div>
                </div>

                <div class="_third">
                    <div><label for="estimateStatus">Estimate Status</label></div>
                    <div class="custom-select">
                            <select class="modal_input" name="estimateStatus">`+
                                @foreach (config('constants.Estimate_status_id') as $status => $value)
                                    @if($value==1)
                                        `<option selected value={{ $value }}>{{ $status }}</option>`+
                                    @else
                                        `<option value={{ $value }}>{{ $status }}</option>`+
                                    @endif
                                @endforeach
                            `</select>
                    </div>
                </div>

                <div class="_third">
                    <div><label for="estimateCost">Estimate Cost</label></div>
                    <div><input class="modal_input" type="number" id="project_edit_estimateCost" name="estimateCost"></div>
                </div>
            </div>`;
            return html;

}
function addEstimateRowListener()
{
    
    document.getElementById('estimate_Add').onclick=function(e){
        
            e.preventDefault();
           jQuery('#project-edit-estimationInfo span').append(renderEstimateRow());                
            projectEdit_deleteRowActionListener();
        }
        
        
}


function toggleEstimateText(compositeEstimate)
{
    
    console.log(compositeEstimate);
    
    if (estimateStatus == "less") {
        estimateStatus = "more";
        showEstimation();
        //addEstimateRowListener();
        document.getElementById("toggleButton").innerText = "See Less";
        
    } 
    else if (estimateStatus == "more") {
        estimateStatus = "less";
        setTimeout(
            hideEstimation(),100);
        //addEstimateRowListener();
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

function hideEstimation(){
    console.log("in hideSection");
    
    var inputsRow= document.querySelectorAll("#project-edit-estimationInfo > span > .hideable");
    console.log(inputsRow,inputsRow.length);
    for (let index = inputsRow.length-1; index >=-0; index--) {
        inputsRow[index].style.display="none";    
        console.log(inputsRow[index].style.display);
        console.log("hey");    
    }
}
function showEstimation(){
    var inputs= jQuery("#project-edit-estimationInfo > span > .hideable");
    for (let index = 0; index < inputs.length; index++) {
        inputs[index].style.display="flex";        
    }
}


function renderEstimateSection(compositeEstimate){
    
    var estimateSectionHTML=`
                        <span>
                            <div style="font-size:20px; margin-left:12px">
                                Estimation Info
                            </div>
                            <button class="modal_addBtn" id="estimate_Add">+</button>`;
                            // estimateSectionHTML+=showMoreEstimation(compositeEstimate);
                            for (let index = compositeEstimate.length-1; index >=0; index--) {
                                if(index==compositeEstimate.length-1)
                                {
                                    estimateSectionHTML+=`<div class="row center">
                                                        
                                                        <input type="hidden" name="estimateID">

                                                        <div class="_third">
                                                            <div><label for="estimateCode">Estimate Code</label></div>
                                                            <div class="row">
                                                                <button class="delete">-</button>
                                                                <div><input class="modal_input" type="text" name="estimateCode"></div>
                                                            </div>
                                                        </div>

                                                        <div class="_third">
                                                            <div><label for="estimateStatus">Estimate Status</label></div>
                                                            <!--<div><input class="modal_input" type="text" name="estimateStatus"></div>-->
                                                            <div class="custom-select">
                                                                <select class="modal_input" name="estimateStatus">`;
                                                                    @foreach (config('constants.Estimate_status_id') as $status => $value)
                                                                    
                                                                        estimateSectionHTML+=`<option value={{ $value }}>{{ $status }}</option>`;
                                                                    
                                                                    @endforeach
                                                                estimateSectionHTML+=`</select>
                                                            </div>
                                                            
                                                            
                                                        </div>

                                                        <div class="_third">
                                                            <div><label for="estimateCost">Estimate Cost</label></div>
                                                            <div><input class="modal_input" type="number" name="estimateCost" value=${compositeEstimate[index].estimateCost}></div>
                                                        </div>
                                                    </div>`;

                                }
                                else{

                                    estimateSectionHTML+=`<div class="row center hideable">
                                                        
                                                        <input type="hidden" name="estimateID" value=${compositeEstimate[index].estimateID}>

                                                        <div class="_third">
                                                            <div><label for="estimateCode">Estimate Code</label></div>
                                                            <div class="row">
                                                                <button class="delete">-</button>
                                                                <div><input class="modal_input" type="text" name="estimateCode" value="${compositeEstimate[index].estimateCode}"></div>
                                                            </div>
                                                        </div>

                                                        <div class="_third">
                                                            <div><label for="estimateStatus">Estimate Status</label></div>
                                                            <!--<div><input class="modal_input" type="text" name="estimateStatus" value=${compositeEstimate[index].estimateStatus}></div>-->
                                                            <div class="custom-select">
                                                                <select class="modal_input" name="estimateStatus">`;
                                                                    @foreach (config('constants.Estimate_status_id') as $status => $value)
                                                                    @if($value==1)
                                                                    estimateSectionHTML+=`<option selected value={{ $value }}>{{ $status }}</option>`;
                                                                    @else
                                                                        estimateSectionHTML+=`<option value={{ $value }}>{{ $status }}</option>`;
                                                                    @endif
                                                                    @endforeach
                                                                estimateSectionHTML+=`</select>
                                                            </div>
                                                            
                                                            
                                                        </div>

                                                        <div class="_third">
                                                            <div><label for="estimateCost">Estimate Cost</label></div>
                                                            <div><input class="modal_input" type="number" name="estimateCost" value=${compositeEstimate[index].estimateCost}></div>
                                                        </div>
                                                    </div>`;

                                }
                                
                                
                            }
                            
                            if(estimateStatus=="less"){
                                
                                console.log("less working");
                                setTimeout(() => {
                                    hideEstimation();
                                }, 200);
                               
                            }
                            else{
                                
                                showEstimation();
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

function estimateFormatting(array_Estimate){
    var formattedEstimate=[];
    console.log(array_Estimate);
    for (let index = 0; index <array_Estimate.length; ) {
        console.log(array_Estimate[index]);
        var smallArr={
            estimateID:null,
            estimateStatus:null,
            estimateCost:null,
            estimateCode:null

        };
        for(let j=0;j<4;j++){
            var arrayValue=array_Estimate[index].split('=');
            
            if(j==0){
                if(arrayValue[1]==""){

                }
                else{
                    var arrayValueTobePushed=parseInt(arrayValue[1]);
                    smallArr.estimateID=arrayValueTobePushed;

                }                
                index++;

            }
            else if(j==1)
            {
                
                var arrayValueTobePushed=arrayValue[1];
                smallArr.estimateCode=arrayValueTobePushed;
                index++;
                
            }
            else if(j==2){
                var arrayValueTobePushed=parseInt(arrayValue[1]);
                smallArr.estimateStatus=arrayValueTobePushed;
                index++;
                
            }
            else{

                
                var arrayValueTobePushed=arrayValue[1];
                smallArr.estimateCost=arrayValueTobePushed;
                index++;
                
                

            }
            
            
        }
        formattedEstimate.push(smallArr);
    }
    console.log(formattedEstimate);
    return formattedEstimate;
}

function projectEditModalHandler(projectID) {
    event.preventDefault();
    event.stopPropagation();
    //clearModalData('project-edit-modal');
    document.getElementById('project-edit-modal').innerHTML=resetEditHTML;
    estimateStatus="less";
    showModal('project-edit-modal');

    getProjectData(projectID);

}

function getProjectEditFormData() {
    return {
        token: $('input[name=_token]').val(),
        projectID:$('#id').val(),
        projectCode:$('#project_edit_projectCode').val(),
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
        salesDepartment:$('#project_edit_salesDept').val(),
        costOfSales:$('#project_edit_salesCost').val(),
        remarks:$('#project_edit_remarks').val(),
        estimate:estimateFormatting($('#project-edit-estimationInfo input,#project-edit-estimationInfo select').serialize().split('&')),
        
        favChecked:$('#projectEdit-favFlag').prop("checked"),
        activeChecked:$('#projectEdit-activeFlag').prop("checked")
    };
}

function handleAJAXResponse(response) {

    // if (response["resultStatus"]["isSuccess"])
    //     updateProjectTable();

    //else
     if (response["resultStatus"]["errorMessage"] === "UNAUTHORIZED_ACTION")
        $('#message').html("You are not authorized to make this change");

    else
        $('#message').html("Unhandled Status: " + response["resultStatus"]["errorMessage"]);
}


function updateProjectTable(updatedData) {
    $.ajax({
        type: "post",
        url: "/API/readProjectDetails",
        data: {
            projectID: updatedData.projectID,
            _token: $('input[name=_token]').val()
        },
        cache: false,
        success: function(response) {
            if (response["resultStatus"]["isSuccess"]) {
                
                let row = $("#project-row-" + updatedData.projectID);
                row.replaceWith( new ProjectListRenderer().renderHTMLProjectList(response["resultData"]));
            } else
                handleAJAXResponse(response);
        },
        error: function(err) {
            handleAJAXError(err);
        }
    }); 
}

function updateProjectEditModalData(data) {

    for (let i = 0; i < data.length; i++) {
        if (data[i] == null)
            data[i] = "";
    }

    renderEstimateSection(project.estimate);
    addEstimateRowListener();
    projectEdit_deleteRowActionListener();
    $("#id").val(data.projectID)
    $("#project_edit_projectCode").val(project.projectCode)
    $("#project_edit_name_Input").val(data.projectName)
    $("#project_edit_clientID_Input").val(data.clientID)
    $("#project_edit_managerID_Input").val(data.projectLeaderID)
    $("#project_edit_order_month_Input").val(data.orderMonth)
    $("#project_edit_inspection_month_Input").val(data.inspectionMonth)
    $("#project_edit_order_status_Input").val(data.orderStatus)
    $("#project_edit_business_situation_Input").val(data.businessSituation)
    $("#project_edit_development_stage_Input").val(data.developmentStage)
    $("#project_edit_sales_total_Input").val(data.salesTotal)
    $("#project_edit_transferred_amount_Input").val(project.transferredAmount)
    $("#project_edit_budget_Input").val(data.budget)
    $("#project_edit_remarks").val(project.remarks)
    $("#project_edit_salesDept").val(project.salesDepartment)
    $("#project_edit_salesCost").val(project.costOfSales)
    var selects=$("#project-edit-estimationInfo > span > .center");
    console.log(selects,selects.length);
    var latest=project.estimate.length-1;
    for (let index = 0; index < selects.length; index++) {
        console.log(selects[index].querySelectorAll("input,select"));
        
        var inputs=selects[index].querySelectorAll("input,select");
        for (let j = 0; j < inputs.length; j++) {
            //console.log(inputs[j].value);
            if(j==0)
            {
                inputs[j].value=project.estimate[latest].estimateID;
            }
            else if(j==1)
                inputs[j].value=project.estimate[latest].estimateCode;
            else if(j==2)
                inputs[j].value=project.estimate[latest].estimateStatus;
            else
                inputs[j].value=project.estimate[latest].estimateCost;
            
        }
        latest--;
        
    }
    $(function() {
        convertToSearchableDropDown("project_edit_managerID_Input", "USER");
        convertToSearchableDropDown("project_edit_clientID_Input", "CLIENT");
    })

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
                 console.log(response)
                updateProjectEditModalData(response["resultData"]);

                project_edit_order_month_Input = new Date (document.getElementById("project_edit_order_month_Input").value);
                project_edit_inspection_month_Input = new Date (document.getElementById("project_edit_inspection_month_Input").value);
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
                $("#project-row-" + projectId).remove();
            else
                handleAJAXResponse(response);
            closeModal('project-edit-modal');
        },
        error: function(err) {
            handleAJAXError(err);
        }
    });
}



var project={
    projectID:1,
    projectCode: "PIVOT123",
    projectName:"PIVOT FENRI",
    clientID:1,
    projectLeaderID:3,
    orderStatus: 0,
    businessSituation:1,
    developmentStage:2,
    orderMonth:"2012-12-12",
    inspectionMonth:"2021-1-23",
    isFavorite:true,
    isActive:true,
    salesTotal:123459,
    salesDepartment:"Marketing",
    costOfSales:12345,
    transferredAmount:12344,
    budget:23445,
    grossProfit:20344,
    profitPercentage:20,
    remarks:"good good",
    estimate:[
        {
            estimateID:1,
            estimateCode:"EST1234",
            estimateStatus:1,
            estimateCost:12345
        },
        {
            estimateID:2,
            estimateCode:"EST5678",
            estimateStatus:2,
            estimateCost:12345
        }
    ]
};
</script>