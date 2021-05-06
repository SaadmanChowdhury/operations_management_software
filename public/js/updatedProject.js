


//=== READING PROJECT DETAILS OF EACH PROJECT FROM API ===//
function readProjectAssign_AJAX(assignData,projectID,diff,orderMonth,leader) {
    $.ajax({
        type: "post",
        url: "/API/readProjectAssign",
        data: {
            _token: $('#csrf-token')[0].content,
            projectID: id
    
        },
        cache: false,
        success: function (response02) {
            
            if(response02["resultStatus"]["isSuccess"]) {
                
                // response02 = project details of selected project             
                    renderEmptyAssignAccordion(id,diff,order,leader,response02);
            
            } else
                handleAJAXResponse(response02);
        },
        error: function (err) {
            handleAJAXError(err);
        }
    });
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

    renderHTMLProjectSummary(row){
        var monthDiff=this.calcMonthDiff(row.orderMonth,row.inspectionMonth);
        var leader= convertUser_IDToName(row.projectLeaderID);
        var profit = this.calcProfit(row.salesTotal,row.budget);
        var projectHtml =
        `<div class="card _project" id="project-row-${row.projectID}">
        <div class="card-header" id="row1head" onclick="display(${row.projectID},${monthDiff},'${row.orderMonth}','${leader}')">
        <div class="display list-unstyled">
        <li>${row.projectName}</li>
        <li>${convertClient_IDToName(row.clientID)}</li>
        <li><img src="img/pro_icon.png" class="smallpic">
        <div class="user-name">${convertUser_IDToName(row.projectLeaderID)}</div>
        </li>` +
        this.getOrderStatusHTML(row.orderStatus) +
        this.getBusinessSituationHTML(row.businessSituation) +
        this.getDevelopmentStageHTML(row.developmentStage) +
        `<li>${row.orderMonth}</li>
        <li>${row.inspectionMonth}</li>
        <li class="right-align">${numberWithCommas(row.salesTotal) + " 円"}</li>
        <li class="right-align">${numberWithCommas(row.budget) + " 円"}</li>
        <li>${profit}%</li>
        <li>
        <div class="edit" onclick="projectEditModalHandler(${row.projectID})">
        <span style="font-size: 11px; margin:6px;width:auto" class="fa fa-pencil"></span>編集
        </div>
        </li>
        </div>
        </div>

        <div class="collapse show" id="row${row.projectID}">` +
        `</div>
        </div>`;
        return projectHtml;
    }
    
    renderProjectSummary(response01) {

        //var projects = document.getElementById('accordian');

        response01["resultData"]["project"].forEach((row) => {

            Object.keys(row).forEach(e => (row[e] == null) ? row[e] = "" : true);
        
            var projectHtml = this.renderHTMLProjectSummary(row);
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
    //readProjectAssign_AJAX();    
    
}