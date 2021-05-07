


//=== READING PROJECT DETAILS OF EACH PROJECT FROM API ===//
function readProjectAssign_AJAX(projectID) {
    var response='';
    $.ajax({
        type: "post",
        url: "/API/readProjectAssign",
        data: {
            _token: $('#csrf-token')[0].content,
            projectID: projectID
    
        },
        async:false,
        cache: true,
        success: function (response02) {
            
            if(response02["resultStatus"]["isSuccess"]) {
                response=response02;
                
            
            } else
                handleAJAXResponse(response);
        },
        error: function (err) {
            handleAJAXError(err);
        }
    });

    return response;
}

//=== SENDING PROJECT DETAILS TO ASSIGN API ===//
function updateAssignData_AJAX(assignData,projectID,diff,orderMonth,leader) {
    $.ajax({
        type: "post",
        url: "/API/upsertAssign",
        data: {
            _token: $('#csrf-token')[0].content,
            assignments:assignData
        },
        cache: false,
        success: function (response01) {
            
            if(response01["resultStatus"]["isSuccess"]) {

                
                updateDisplay(projectID,diff,orderMonth,leader);               

            } else
                handleAJAXResponse(response01);
        },
        error: function (err) {
            handleAJAXError(err);
        }
    });
}





document.addEventListener("DOMContentLoaded", () => { 
    
    var obj= new ProjectListRenderer();
    obj.fetchProjectList_AJAX() 
});

class ProjectListRenderer{
    constructor(){

    }

        //=== CALCULATING PROJECT DURATION ===//

    calcMonthDiff(orderMonth,inspectionMonth){
        
        var date1 = new Date(orderMonth);
        var date2 = new Date(inspectionMonth);
        
        // To calculate the time difference of two dates
        var Difference_In_Time = date2.getTime() - date1.getTime();
        
        // To calculate the no. of days between two dates
        var Difference_In_Month =Math.ceil( Difference_In_Time / (1000 * 3600 * 24*30));
        return Difference_In_Month;
    }

    //=== CALCULATING PROJECT PROFIT ===//
    calcProfit(salesTotal,budget){
        var profit = (salesTotal - budget) * 100 / salesTotal;
        return profit;
    }


    getOrderStatusHTML(data) {
        switch (data) {
            case 'A': return "<li><div class='order-tag _red'>A</div></li>";
            case 'B': return "<li><div class='order-tag _orange'>B</div></li>";
            case 'C': return "<li><div class='order-tag _orange'>C</div></li>";
            case 'Z': return "<li><div class='order-tag _gray'>Z</div></li>";
            case '●': return "<li><div class='order-tag _green'>○</div></li>";
            default: return "<li></li>";
        }
    }

    getBusinessSituationHTML(data) {
        switch (data) {
            case '見積前': return "<li><div class='business-tag _green'>● 見積前</div></li>";
            case '見積中': return "<li><div class='business-tag _green'>● 見積中</div></li>";
            case '見積済': return "<li><div class='business-tag _green'>● 見積済</div></li>";
            case '受注': return "<li><div class='business-tag _green'>● 受注</div></li>";
            case '検収中': return "<li><div class='business-tag _green'>● 検収中</div></li>";
            case '完了': return "<li><div class='business-tag _green'>● 完了</div></li>";
            default: return "<li></li>";
        }
    }

    getDevelopmentStageHTML(data) {
        switch (data) {
            case '受注前着手': return "<li><div class='development-tag _blue'>受注前着手</div></li>";
            case '要件': return "<li><div class='development-tag _blue'>要件定義</div></li>";
            case '設計': return "<li><div class='development-tag _blue'>設計</div></li>";
            case '実装': return "<li><div class='development-tag _blue'>実装</div></li>";
            case 'テスト': return "<li><div class='development-tag _blue'>テスト</div></li>";
            case '開発完了': return "<li><div class='development-tag _blue'>開発完了</div></li>";
            default: return "<li></li>";
        }
    }

    renderHTMLProjectList(project){
        //var monthDiff=this.calcMonthDiff(project.orderMonth,project.inspectionMonth);
        //var leader= convertUser_IDToName(project.projectLeaderID);
        var profit = this.calcProfit(project.salesTotal,project.budget);
        var projectHtml =
        `<div class="card _project" id="project-row-${project.projectID}">
        <div class="card-header" id="row1head" onclick="display(${project.projectID})">
        <div class="display list-unstyled">
        <li>${project.projectName}</li>
        <li>${convertClient_IDToName(project.clientID)}</li>
        <li><img src="img/pro_icon.png" class="smallpic">
        <div class="user-name">${convertUser_IDToName(project.projectLeaderID)}</div>
        </li>` +
        this.getOrderStatusHTML(project.orderStatus) +
        this.getBusinessSituationHTML(project.businessSituation) +
        this.getDevelopmentStageHTML(project.developmentStage) +
        `<li>${project.orderMonth}</li>
        <li>${project.inspectionMonth}</li>
        <li class="right-align">${project.salesTotal + " 円"}</li>
        <li class="right-align">${project.budget + " 円"}</li>
        <li>${profit}%</li>
        <li>
        <div class="edit" onclick="projectEditModalHandler(${project.projectID})">
        <span style="font-size: 11px; margin:6px;width:auto" class="fa fa-pencil"></span>編集
        </div>
        </li>
        </div>
        </div>

        <div class="collapse show" id="row${project.projectID}">` +
        `</div>
        </div>`;
        return projectHtml;
    }
    
    renderProjectList(response01) {

        //var projects = document.getElementById('accordian');

        response01["resultData"]["project"].forEach((project) => {

            Object.keys(project).forEach(e => (project[e] == null) ? project[e] = "" : true);
        
            var projectHtml = this.renderHTMLProjectList(project);
            $('#accordian').append(projectHtml);
            
        });

        //PROJECT_CARDS = document.querySelectorAll('._project.card');
        
    }
    //=== FETCHING PROJECT DETAILS FROM PROJECT API ===//

    fetchProjectList_AJAX() {

        var renderClass=this;

        $.ajax({
            type: "post",
            url: "/API/fetchProjectList",
            data: {
                _token: $('#csrf-token')[0].content,
            },
            cache: false,
            success: function (response01) {
                
                if(response01["resultStatus"]["isSuccess"]) {
                    projectRender();

                    function projectRender() {
                        setTimeout(function () {
                            if (USER_LIST.length > 0 && CLIENT_LIST.length > 0) {
                                renderClass.renderProjectList(response01);
                            }
                            else projectRender();
                        }, 10)
                    }

                } else
                    handleAJAXResponse(response01);
            },
            error: function (err) {
                handleAJAXError(err);
            }
        });
    }

    
}


function display(id) {
    //numberWithCommas(project.salesTotal)
    $('#row' + id).toggle("3000");
    
    if($('#row' + id).is(':visible')){
        var response= readProjectAssign_AJAX(id); 
        var project=response["resultData"]["project"];
        renderEmptyAssignAccordion(assignData,project);
        //var simpleArray=processAssigninto2DArray(response);//-->2D Array
           

    }
    else{

    }
    
}
function getProjectDuration(project){

    var duration = project.minYear+"年"+project.minMonth+"月‐"+project.maxYear+"年"+project.maxMonth+"月";


}
function renderProjectManagementSummary(project){

    var ProjectManagementSummaryTableHTML =

    `<div class="card-body row _accordion">
    
        <div class="table-left">
            <table>
                <tr>
                    <td>予算</td>
                    <td>${project.budget}円</td>
                </tr>
                <tr>
                    <td>原価</td>
                    <td>${project.cost}円</td>
                </tr>
                <tr>
                    <td>工数</td>
                    <td>${project.member.length}</td>
                </tr>
                <tr>
                    <td>粗利</td>
                    <td>${project.profit}円</td>
                </tr>
                <tr>
                    <td>率</td>
                    <td>${project.profitPercentage}%</td>
                </tr>
                <tr>
                    <td>期間</td>
                    <td>12月</td>
                </tr>
            </table>
        </div>`;
        return ProjectManagementSummaryTableHTML;
}


function generateProjectDetailsHeader_AssignedDates(dates){
    var dateHTML=``;
    for (let index = 2; index < dates.length; index++) {
        dateHTML+=`<th>`+dates[index]+`</th>`;
        
    }
    return `<tr>${dateHTML}</tr>`;
}

function generateProjectDetailsBody_AssignedValues(assignData){
    var assignedValueHTML=``;
    for (let i = 2; i < assignData.length; i++) {
        assignedValueHTML+=`<tr class="editMode-input">`;
        for (let j = 2; j < assignData[0].length; j++) {

            assignedValueHTML+=`<td>${assignData[i][j]}</td>`;
            
        }
        assignedValueHTML+=`</tr>`;
    }
    return assignedValueHTML;
    
}
function generateProjectDetailsBody_colSum(assignData){
    var assignedValueHTML=``;
    assignedValueHTML+=`<tr class=row-total>`;
    
    for (let index = 2; index < assignData[0].length; index++) {

        assignedValueHTML+=`<td>${assignData[1][index]}</td>`;
        
    }
    assignedValueHTML+=`</tr>`;
    return assignedValueHTML;
}

function generateAssignedMembersHtML(assignData){
    var assignedMemberHTML=``;
    
    
    for (let i = 1; i < assignData.length; i++) {
        if(i==1){
            assignedMemberHTML+=`<tr class="row-total">
                                    <td>${assignData[i][0]}</td>
                                    <td>${assignData[i][1]}</td>
                                </tr>`;
        }
        else{
            assignedMemberHTML+=`<tr class=editMode-input>`;
            if(i==2){
                assignedMemberHTML+=`<td><img src="img/pro_icon.png" class="leader">${assignData[i][0]}</td>
                                        <td>${assignData[i][1]}</td>`;
            }
            else{
                assignedMemberHTML+=`<td><button class="delete editMode">-</button><img src="img/pro_icon.png">${assignData[i][0]}</td>
                                        <td>${assignData[i][1]}</td>`;
            }
            
            assignedMemberHTML+=`</tr>`;
        }
    }
    
    return assignedMemberHTML;
}


function editModeOn(assignData,x){

    $( '#project-row-' + x +' .editMode').each(function( index ) {
        this.style.display="block";
        document.getElementById("edit-"+x).style.display="none";
    });
    

    //==CONVERTING BLUE TABLE into INPUT FIELDS==//
    
    var $dataTable= $('#tableRight-'+x).find('.editMode-input');
    
    $dataTable.each(function(i){
        for(var j=2;j<assignData[0].length;j++)
        {
            if(j==2)
                $(this).html("<td><input type=\"number\" class=\"data-cell\"  min=\"0\" max=\"1\"  name=\"data-cell\"  value=\""+assignData[i+1][j]+"\"></td>");
            else
                $(this).append("<td><input type=\"number\" class=\"data-cell\" min=\"0\" max=\"1\"  name=\"data-cell\" value=\""+assignData[i+1][j]+"\"></td>");
        }
    });


    //==CONVERTING ORANGE TABLE into INPUT FIELDS==//

    var $dataTable2= $('#tableLeft-'+x).find('.editMode-input');
    $dataTable2.each(function(i){
        $(this).children('td').each(function( index ){
            
            if(index%2==0 && i!=0){
                
                var string=`<button class="delete editMode">-</button> <select class=\"data-cell-fixed\" required>`;
                
                   for(var j=1;j<=12;j++)
                   {
                       string+=`<option value=${j}>${convertUser_IDToName(j)}</option>`;
                    //  if(members[i].memberID==j)
                    //     string+=`<option value=${j} selected>${convertUser_IDToName(j)}</option>`;
                    //  else
                    //     string+=`<option value=${j}>${convertUser_IDToName(j)}</option>`;
                   }
                   string+=`</select>`;
                   $(this).html(string);
            }
        });
    });

    var buttons= document.getElementById("project-row-"+x).querySelectorAll("div > div.project-rhs > div.table-right.row > table > tbody > tr > td:nth-child(1) > button");

   for (let index = 0; index < buttons.length; index++) {
       
       buttons[index].classList.remove("editMode");
       
   }

}

function callActionListeners(projectID){
    document.getElementById("edit-"+projectID).onclick=function(){
        editModeOn(assignData,projectID);
    }
}

function getPojectLeaderAssignArrayIndex(mainTableArray, projectLeaderID){
    for (let i = 2; i < mainTableArray.length; i++) {
        console.log(mainTableArray[i][0],projectLeaderID);
        if(mainTableArray[i][0]==projectLeaderID){
            return i;
        }
    }
}
function putProjectLeaderAlwaysTop(mainTableArray, projectLeaderID){
    var ledaerIndex = getPojectLeaderAssignArrayIndex(mainTableArray,projectLeaderID);

    var tmpRow=mainTableArray[2];
    
    mainTableArray[2]=mainTableArray[ledaerIndex];
    mainTableArray[ledaerIndex]=tmpRow;
    console.log(ledaerIndex);
    return mainTableArray;
}
function convertToArrayAssign(assign, memberID){
    var assignArray= new Array(assign.length+2);
    for (let i = 0; i < assign.length; i++) {

        if(i==0){
            assignArray[i]=memberID;
        }
        assignArray[i+2]=assign[i].value;
    }

    return assignArray;
}
function convertToSimple2DArray(project){
    var members =project.member;
    var projectLeaderID= project.projectLeaderID;
    console.log(members.length);
    var mainTableArray= new Array(members.length+2).fill(0);
    console.log(mainTableArray);
    for (let i = 0; i < members.length; i++) {
        var assigns =members[i].assign;
        mainTableArray[i+2]=convertToArrayAssign(assigns, members[i].memberID);
    }
    console.log(mainTableArray);
    mainTableArray= putProjectLeaderAlwaysTop(mainTableArray, projectLeaderID);
}
//=== RENDERING PROJECT DETAILS TABLES ===//

function renderEmptyAssignAccordion(assignData,project) {
    var dates=assignData[0];
    console.log(dates);
    console.log(project);
    var diff=3;
    var projectID=project.projectID;
    convertToSimple2DArray(project);
    accordionHTML =

        renderProjectManagementSummary(project) +
        `<div class="project-rhs">
            <div class="add-minus-holder editMode">
                <button class="btn round-btn primary _plus" onclick="addRow(${projectID},${diff})"><span
                        class="fa fa-plus"></span></button>
                
            </div>
            <div class="table-right row" id="table-right-${projectID}">
                <table class="table-fix" id="tableLeft-${projectID}">
                    <tbody>
                        <tr>
                            <th class="mishti-orange">メンバー</th>
                            <th class="mishti-orange">工数合計</th>
                        </tr>`
                        +generateAssignedMembersHtML(assignData)+
                    `</tbody>
                </table>
                    <div class="table-des-container">
                        <table class="table-des" id="tableRight-${projectID}">
                            `+generateProjectDetailsHeader_AssignedDates(dates)
                            +generateProjectDetailsBody_colSum(assignData)
                            +generateProjectDetailsBody_AssignedValues(assignData)+
                            
                        `</table>
                    </div>
            </div>
        </div>
        <div class="action">
            <ul class="list-unstyled">
                <li class="list show"><button class="btn round-btn pencil-btn" id="edit-${projectID}"><span
                            style="font-size: 11px; margin:6px;width:auto" class="fa fa-pencil"></span></button></li>
                <div class="editMode">
                    <li class="list"><button id="trash-${projectID}" class="btn round-btn danger"><span class="fa fa-trash"></span></button></li>
                    <li class="list"><button id="reset-${projectID}" class="btn round-btn success midori"><span class="fa fa-undo"></span></button>
                    </li>
                    <li class="list"><button class="btn round-btn primary"><span class="fa fa-save"
                                id="save-${projectID}"></span></button></li>
                </div>
            </ul>
        </div>
    </div>`;       
                
        var projects = document.getElementById('row'+projectID);
        projects.innerHTML=accordionHTML;
        callActionListeners(projectID);
    
}


//===ADDING ROWS on CLICKING ADD BUTTON===//

function addRow(projectID,diff) {
    
    var string=`<td><button class="delete">-</button> <select class=\"data-cell-fixed\" required>`;
                   for(var j=1;j<=30;j++)
                   {
                       if(j==1)
                            string+=`<option value=${j} selected>${convertUser_IDToName(j)}</option>`;
                        else
                            string+=`<option value=${j} >${convertUser_IDToName(j)}</option>`;
                   }
                   string+=`</select></td>`;
                   
                   
    document.querySelector("#tableLeft-"+projectID+" > tbody").innerHTML += `<tr class="editMode-input">
                                                `+string+`
                                                <td>0</td>
                                            </tr>`;
        string=``;
    
    // var length=temp_cacheAssign.length;
    // temp_cacheAssign[length]=new Array(diff);
    
    for (let index = 0; index < diff; index++) {
        string+=`<td><input type=\"number\" class=\"data-cell\" name=\"data-cell\" min=\"0\" max=\"1\" value=\"0\"></td>`;
        //temp_cacheAssign[length][index]=0;
        
    }
    document.querySelector("#tableRight-"+projectID+" > tbody").innerHTML += `<tr class="editMode-input">
                                            `+string +`</tr>`;
    
    //deleteRowActionListener(x);

}

var assignData= [[0,0,'2020/10','2020/11','2020/12'],
                 [4,4.0,3.0,3.0,3.0],
                 ['leader',18.0,1,1,1],
                 ['member',18.0,1,1,1],
                 ['member',18.0,1,1,1],
                 ['member',18.0,1,1,1]
                ];