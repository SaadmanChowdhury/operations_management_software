


//=== READING PROJECT DETAILS OF EACH PROJECT FROM API ===//
function readProjectAssign_AJAX(projectID) {
    var response='';
    $.ajax({
        type: "post",
        url: "/API/readProjectAssign",
        data: {
            _token: $('#csrf-token')[0].content,
            projectID: id
    
        },
        async:false,
        cache: false,
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
    
    var obj= new ProjectSummaryListRenderer();
    obj.fetchProjectList_AJAX() 
});

class ProjectSummaryListRenderer{
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

    renderHTMLProjectSummary(project){
        var monthDiff=this.calcMonthDiff(project.orderMonth,project.inspectionMonth);
        var leader= convertUser_IDToName(project.projectLeaderID);
        var profit = this.calcProfit(project.salesTotal,project.budget);
        var projectHtml =
        `<div class="card _project" id="project-row-${project.projectID}">
        <div class="card-header" id="row1head" onclick="display(${project.projectID},${monthDiff},'${project.orderMonth}','${leader}')">
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
        <li class="right-align">${numberWithCommas(project.salesTotal) + " 円"}</li>
        <li class="right-align">${numberWithCommas(project.budget) + " 円"}</li>
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
    
    renderProjectSummary(response01) {

        //var projects = document.getElementById('accordian');

        response01["resultData"]["project"].forEach((project) => {

            Object.keys(project).forEach(e => (project[e] == null) ? project[e] = "" : true);
        
            var projectHtml = this.renderHTMLProjectSummary(project);
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
                                renderClass.renderProjectSummary(response01);
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


function display(id,diff,order,leader) {

    $('#row' + id).toggle("3000");
    var response= readProjectAssign_AJAX(id); 
    var simmpleArray=processAssigninto2DArray(response);//-->2D Array
    renderEmptyAssignAccordion(simpleArray, response[project]);   
    
}
function getProjectDuration(project){

    var duration = project.minYear+"年"+project.minMonth+"月‐"+project.maxYear+"年"+project.maxMonth+"月";


}
function renderProjectManagementSummary(response02){

    var ProjectManagementSummaryTableHTML =

    `<div class="card-body row _accordion">
    
        <div class="table-left">
            <table>
                <tr>
                    <td>予算</td>
                    <td>${response02["resultData"]["project"].budget}円</td>
                </tr>
                <tr>
                    <td>原価</td>
                    <td>${response02["resultData"]["project"].cost}円</td>
                </tr>
                <tr>
                    <td>工数</td>
                    <td>${response02["resultData"]["project"].member.length}</td>
                </tr>
                <tr>
                    <td>粗利</td>
                    <td>${response02["resultData"]["project"].profit}円</td>
                </tr>
                <tr>
                    <td>率</td>
                    <td>${response02["resultData"]["project"].profitPercentage}%</td>
                </tr>
                <tr>
                    <td>期間</td>
                    <td>${diff}月</td>
                </tr>
            </table>
        </div>`;
        return ProjectManagementSummaryTableHTML;
}


function generateDateString(){

}

function generateBodyString(){

}

//=== RENDERING PROJECT DETAILS TABLES ===//

function renderEmptyAssignAccordion(projectID) {
    var dates=assignData[0];
    console.log(dates);
    var response= readProjectAssign_AJAX(projectID);
    console.log(response);
    accordionHTML =

        //renderProjectManagementSummary(response) +
        `<div class="project-rhs">
            <div class="add-minus-holder editMode">
                <button class="btn round-btn primary _plus" onclick="addRow(${projectID},12)"><span
                        class="fa fa-plus"></span></button>
                
            </div>
            <div class="table-right row" id="table-right-${projectID}">
                <table class="table-fix" id="tableLeft-${projectID}">
                    <tr>
                        <th class="mishti-orange">メンバー</th>
                        <th class="mishti-orange">工数合計</th>
    
                    </tr>
                    
                    <tr class="row-total">
                            <td>3</td>
                            <td>54.0</td>
                     </tr>
                    <tr class="editMode-input">
                                    
                        <td><img src="img/pro_icon.png" class="leader">Leader</td>
                        <td>18.0</td>
                    </tr>
                    <tr class="editMode-input">
                        
                        <td><button class="delete editMode">-</button><img src="img/pro_icon.png">社員</td>
                        <td>18.0</td>
                    </tr>
                    <tr class="editMode-input">
                        
                        <td><button class="delete editMode">-</button><img src="img/pro_icon.png">社員</td>
                        <td>18.0</td>
                    </tr>
                    <tr class="editMode-input">
                        
                        <td><button class="delete editMode">-</button><img src="img/pro_icon.png">社員</td>
                        <td>18.0</td>
                    </tr>
                </table>
                <div class="table-des-container">
                    <table class="table-des" id="tableRight-${projectID}">
                        <tr>
                            
                        <th>2020/01</th>
                        <th>2020/02</th>
                        <th>2020/03</th>
                        <th>2020/04</th>
                        <th>2020/05</th>
                        <th>2020/06</th>
                        <th>2020/07</th>
                        <th>2020/08</th>
                        <th>2020/09</th>
                        <th>2020/10</th>
                        <th>2020/11</th>
                        <th style="background-color:#ffbf0b;color:black">2020/12</th>
                        <th>2021/01</th>
                        <th>2022/02</th>
                        <th>2021/03</th>
                        <th>2022/04</th>
                        <th>2021/05</th>
                        <th>2022/06</th>
                    </tr>
                    <tr class="row-total">
                            <td>3.00</td>
                            <td>3.00</td>
                            <td>3.00</td>
                            <td>3.00</td>
                            <td>3.0</td>
                            <td>3.0</td>
                            <td>3.0</td>
                            <td>3.0</td>
                            <td>3.0</td>
                            <td>3.0</td>
                            <td>3.0</td>
                            <td>3.0</td>
                            <td>3.0</td>
                            <td>3.0</td>
                            <td>3.0</td>
                            <td>3.0</td>
                            <td>3.0</td>
                            <td>3.0</td>
                        </tr>
                        <tr class="editMode-input">
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>

                        </tr>
                        <tr class="editMode-input">
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>

                        </tr>
                        <tr class="editMode-input">
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>

                        </tr>
                        <tr class="editMode-input">
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>
                                <td>1.00</td>

                        </tr>
                    </table>
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
    
}


var assignData= [[0,0,'2020/10','2020/11','2020/12'],
                 [3,54.0,3.0,3.0,3.0],
                 ['leader',18.0,1,1,1],
                 ['member',18.0,1,1,1],
                 ['member',18.0,1,1,1],
                 ['member',18.0,1,1,1]
                ];