var PROJECT_CARDS = [];


////====USER-LIST AJAX====////
var users;

function fetchUserList_AJAX() {
    $.ajax({
        type: "post",
        url: "/API/fetchUserList",
        data: {
            _token: $('#csrf-token')[0].content,
        },
        cache: false,
        success: function (response) {
            if (response["resultStatus"]["isSuccess"]) {
                users = response["resultData"]["user"];
            } else
                handleAJAXResponse(response);
        },
        error: function (err) {
            handleAJAXError(err);
        }
    });
}

//=== READING PROJECT DETAILS OF EACH PROJECT FROM API AJAX===//
function readProjectAssign_AJAX(projectID) {
    var response = '';
    $.ajax({
        type: "post",
        url: "/API/readProjectAssign",
        data: {
            _token: $('#csrf-token')[0].content,
            projectID: projectID

        },
        async: false,
        cache: true,
        success: function (response02) {

            if (response02["resultStatus"]["isSuccess"]) {
                // setTimeout(function(){
                //     hideLoader(projectID)}, 1000);
                response = response02;


            } else
                handleAJAXResponse(response);
        },
        error: function (err) {
            handleAJAXError(err);
        }
    });

    return response;
}

//=== SENDING PROJECT DETAILS TO ASSIGN API AJAX===//
function updateAssignData_AJAX(assignData, projectID) {
    $.ajax({
        type: "post",
        url: "/API/upsertAssign",
        data: {
            _token: $('#csrf-token')[0].content,
            assignments: assignData
        },
        cache: false,
        success: function (response01) {

            if (response01["resultStatus"]["isSuccess"]) {

                readAndRenderProjectAssignByProjectID(projectID)

            } else
                handleAJAXResponse(response01);
        },
        error: function (err) {
            handleAJAXError(err);
            readAndRenderProjectAssignByProjectID(projectID)
        }
    });
}


function readAndRenderProjectAssignByProjectID(projectID) {
    document.getElementById('row' + projectID).innerHTML = `<div class="loader" id="loader-${projectID}"></div>`;
    var response = readProjectAssign_AJAX(projectID);
    setTimeout(function () {
        document.getElementById('row' + projectID).innerHTML = "";
        var project = response["resultData"]["project"];
        var data = convertToSimple2DArray(project);
        renderEmptyAssignAccordion(data, project);
    }, 500);

}


document.addEventListener("DOMContentLoaded", () => {

    fetchUserList_AJAX();
    var obj = new ProjectListRenderer();
    obj.fetchProjectList_AJAX()

});

class ProjectListRenderer {
    constructor() {

    }


    //=== CALCULATING PROJECT PROFIT ===//
    // calcProfit(salesTotal,budget){
    //     var profit = (salesTotal - budget) * 100 / salesTotal;
    //     return profit;
    // }


    getOrderStatusHTML(data) {
        switch (data) {
            case 'A':
                return "<li><div class='order-tag _red'>A</div></li>";
            case 'B':
                return "<li><div class='order-tag _orange'>B</div></li>";
            case 'C':
                return "<li><div class='order-tag _orange'>C</div></li>";
            case 'Z':
                return "<li><div class='order-tag _gray'>Z</div></li>";
            case '●':
                return "<li><div class='order-tag _green'>○</div></li>";
            default:
                return "<li></li>";
        }
    }

    getBusinessSituationHTML(data) {
        switch (data) {
            case '見積前':
                return "<li><div class='business-tag _green'>● 見積前</div></li>";
            case '見積中':
                return "<li><div class='business-tag _green'>● 見積中</div></li>";
            case '見積済':
                return "<li><div class='business-tag _green'>● 見積済</div></li>";
            case '受注':
                return "<li><div class='business-tag _green'>● 受注</div></li>";
            case '検収中':
                return "<li><div class='business-tag _green'>● 検収中</div></li>";
            case '完了':
                return "<li><div class='business-tag _green'>● 完了</div></li>";
            default:
                return "<li></li>";
        }
    }

    getDevelopmentStageHTML(data) {
        switch (data) {
            case '受注前着手':
                return "<li><div class='development-tag _blue'>受注前着手</div></li>";
            case '要件':
                return "<li><div class='development-tag _blue'>要件定義</div></li>";
            case '設計':
                return "<li><div class='development-tag _blue'>設計</div></li>";
            case '実装':
                return "<li><div class='development-tag _blue'>実装</div></li>";
            case 'テスト':
                return "<li><div class='development-tag _blue'>テスト</div></li>";
            case '開発完了':
                return "<li><div class='development-tag _blue'>開発完了</div></li>";
            default:
                return "<li></li>";
        }
    }

    renderHTMLProjectList(project) {

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
        <li>${project.inspectionMonth}</li>`;
        if (isProjectEditable(project.projectLeaderID)) {
            projectHtml += `<li class="right-align">${numberWithCommas(project.salesTotal) + " 円"}</li>
            <li class="right-align">${numberWithCommas(project.budget) + " 円"}</li>
            <li>${project.profitPercentage}%</li>`;

        } else {
            projectHtml += `<li class="right-align"></li>
            <li class="right-align"></li>
            <li></li>`;
        }

        projectHtml += `<li>`;
        if (isProjectEditable(project.projectLeaderID)) {
            projectHtml += `<div class="edit" onclick="projectEditModalHandler(${project.projectID})">
            <span style="font-size: 11px; margin:6px;width:auto" class="fa fa-pencil"></span>編集
            </div>`

        } else {

        }

        projectHtml += `</li>
        </div>
        </div>

        <div class="collapse show" id="row${project.projectID}">
        　` +
            `</div>
        </div>`;

        return projectHtml;
    }

    renderProjectList(response01) {

        response01["resultData"]["project"].forEach((project) => {

            Object.keys(project).forEach(e => (project[e] == null) ? project[e] = "" : true);

            var projectHtml = this.renderHTMLProjectList(project);
            $('#accordian').append(projectHtml);
            PROJECT_CARDS = document.querySelectorAll('._project.card');

        });

    }


    //=== FETCHING PROJECT DETAILS FROM PROJECT API AJAX===//

    fetchProjectList_AJAX() {

        var renderClass = this;

        $.ajax({
            type: "post",
            url: "/API/fetchProjectList",
            data: {
                _token: $('#csrf-token')[0].content,
            },
            cache: false,
            success: function (response01) {

                if (response01["resultStatus"]["isSuccess"]) {

                    if (response01["resultData"]["project"].length > 0) {
                        setTimeout(function () {
                            hideMainLoader()
                        }, 500);
                        projectRender();

                        function projectRender() {


                            setTimeout(function () {
                                if (USER_LIST.length > 0 && CLIENT_LIST.length > 0) {
                                    renderClass.renderProjectList(response01);
                                } else projectRender();

                                let preference = document.getElementById("initial-preference");
                                adjustRowHeightByState(preference, false);
                            }, 10)
                        }

                    } else {

                        showEmptyListInfromation("#accordian");
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

    $('#row' + id).toggle("3000");

    if (Math.round($('#row' + id).css("opacity")) == 0) {

        document.getElementById('row' + id).innerHTML = `<div class="loader" id="loader-${id}"></div>`;
        var response = readProjectAssign_AJAX(id);

        setTimeout(function () {
            var project = response["resultData"]["project"];
            var data = convertToSimple2DArray(project);
            renderEmptyAssignAccordion(data, project);
        }, 500);


    } else {

    }

}

function getProjectDuration(project) {

    var duration = project.minYear + "年" + project.minMonth + "月‐" + project.maxYear + "年" + project.maxMonth + "月";
    return duration;

}

function renderProjectManagementSummary(project) {

    var ProjectManagementSummaryTableHTML =

        `<div class="card-body row _accordion">
          <!--<div id="loader"></div>-->
              
        <div class="table-left">
            <table>`;
    if (isProjectEditable(project.projectLeaderID)) {
        ProjectManagementSummaryTableHTML += `
                        <tr><td>予算</td><td>${numberWithCommas(project.budget)}円</td></tr>`;

    } else {

        ProjectManagementSummaryTableHTML += ``;

    }

    if (isProjectEditable(project.projectLeaderID)) {
        ProjectManagementSummaryTableHTML += `<tr>
                        <td>原価</td><td>${numberWithCommas(project.cost)}円</td></tr>`;

    } else {

        ProjectManagementSummaryTableHTML += ``;

    }
    ProjectManagementSummaryTableHTML +=

        `        <tr>
                    <td>工数</td>
                    <td>${project.member.length}</td>
                </tr>`;
    if (isProjectEditable(project.projectLeaderID)) {
        ProjectManagementSummaryTableHTML += `
                        <tr>
                            <td>粗利</td><td>${numberWithCommas(project.profit)}円</td>
                        </tr>`;

    } else {

        ProjectManagementSummaryTableHTML += ``;

    }

    if (isProjectEditable(project.projectLeaderID)) {
        ProjectManagementSummaryTableHTML += `
                        <tr>
                            <td>率</td>
                            <td>${numberWithCommas(project.profitPercentage)}%</td>
                        </tr>`;

    } else {

        ProjectManagementSummaryTableHTML += ``;

    }
    ProjectManagementSummaryTableHTML +=

        `
                <tr>
                    <td>期間</td>
                    <td>${dateDifference(new Date(project.inspectionMonth), new Date(project.orderMonth))}</td>
                </tr>
            </table>
        </div>`;
    return ProjectManagementSummaryTableHTML;
}


function generateProjectDetailsHeader_AssignedDates(dates) {
    var dateHTML = ``;
    for (let index = 2; index < dates.length; index++) {
        dateHTML += `<th>` + dates[index].toLocaleDateString() + `</th>`;

    }
    return `<tr>${dateHTML}</tr>`;
}

function generateProjectDetailsBody_AssignedValues(assignData) {
    var assignedValueHTML = ``;
    for (let i = 2; i < assignData.length; i++) {
        assignedValueHTML += `<tr class="editMode-input">`;
        for (let j = 2; j < assignData[0].length; j++) {

            if (assignData[i][j] > 0) {
                assignedValueHTML += `<td class="faded-yellow">${assignData[i][j]}</td>`;
            } else {
                assignedValueHTML += `<td>${assignData[i][j]}</td>`;
            }


        }
        assignedValueHTML += `</tr>`;
    }
    return assignedValueHTML;

}

function generateProjectDetailsBody_colSum(assignData) {
    var assignedValueHTML = ``;
    assignedValueHTML += `<tr class=row-total>`;

    for (let index = 2; index < assignData[0].length; index++) {

        assignedValueHTML += `<td>${assignData[1][index]}</td>`;

    }
    assignedValueHTML += `</tr>`;
    return assignedValueHTML;
}

function generateAssignedMembersHtML(assignData) {
    var assignedMemberHTML = ``;


    for (let i = 1; i < assignData.length; i++) {
        if (i == 1) {
            assignedMemberHTML += `<tr class="row-total">
                                    <td>${assignData[i][0]}</td>
                                    <td>${assignData[i][1]}</td>
                                </tr>`;
        } else {
            assignedMemberHTML += `<tr class=editMode-input>`;
            if (i == 2) {
                assignedMemberHTML += `<td><img src="img/pro_icon.png" class="leader">${convertUser_IDToName(assignData[i][0])}</td>
                                        <td>${assignData[i][1]}</td>`;
            } else {
                assignedMemberHTML += `<td><button class="delete editMode">-</button><img src="img/pro_icon.png">${convertUser_IDToName(assignData[i][0])}</td>
                                        <td>${assignData[i][1]}</td>`;
            }

            assignedMemberHTML += `</tr>`;
        }
    }

    return assignedMemberHTML;
}

function getMembersID(assignData) {
    var memberList = [];
    for (let index = 2; index < assignData.length; index++) {

        memberList.push(assignData[index][0]);
    }
    return memberList;
}

function editModeOn(assignData, projectID) {

    $('#project-row-' + projectID + ' .editMode').each(function (index) {
        this.style.display = "block";
        document.getElementById("edit-" + projectID).style.display = "none";
    });


    //==CONVERTING BLUE TABLE into INPUT FIELDS==//

    var $dataTable = $('#tableRight-' + projectID).find('.editMode-input');

    $dataTable.each(function (i) {
        for (var j = 2; j < assignData[0].length; j++) {
            if (j == 2)
                $(this).html("<td><input type=\"number\" class=\"data-cell\"  min=\"0\" max=\"1\"  name=\"data-cell\"  value=\"" + assignData[i + 2][j] + "\"></td>");
            else
                $(this).append("<td><input type=\"number\" class=\"data-cell\" min=\"0\" max=\"1\"  name=\"data-cell\" value=\"" + assignData[i + 2][j] + "\"></td>");
        }
    });


    //==CONVERTING ORANGE TABLE into INPUT FIELDS==//
    var membersID = getMembersID(assignData);
    var $dataTable2 = $('#tableLeft-' + projectID).find('.editMode-input');
    $dataTable2.each(function (i) {
        $(this).children('td').each(function (index) {

            if (index % 2 == 0 && i != 0) {

                var string = `<button class="delete editMode">-</button> <select class=\"data-cell-fixed\" required>`;

                for (var j = 0; j < users.length; j++) {

                    if (membersID[i] == users[j].userID)
                        string += `<option value=${users[j].userID} selected>${convertUser_IDToName(users[j].userID)}</option>`;
                    else
                        string += `<option value=${users[j].userID}>${convertUser_IDToName(users[j].userID)}</option>`;
                }
                string += `</select>`;
                $(this).html(string);
            }
        });
    });

    var buttons = document.getElementById("project-row-" + projectID).querySelectorAll("div > div.project-rhs > div.table-right.row > table > tbody > tr > td:nth-child(1) > button");

    for (let index = 0; index < buttons.length; index++) {

        buttons[index].classList.remove("editMode");

    }

    deleteRowActionListener(projectID);
    addActionListenerForInputs(projectID);

}

function saveTableLeftInput(projectID, newAssignArray) {

    var rows = document.querySelectorAll("#tableLeft-" + projectID + " > tbody > tr > td > select");


    for (let index = 0; index < rows.length; index++) {

        newAssignArray[index + 3][0] = rows[index].value;

    }

    return newAssignArray;

}


function saveInput(projectID, assignData) {

    var rows = document.getElementById("tableRight-" + projectID).getElementsByTagName("tr");


    var newAssignArray = new Array(rows.length).fill(0);


    newAssignArray[0] = assignData[0]; // dates
    newAssignArray[1] = assignData[1];
    newAssignArray[2] = assignData[2];


    for (let index = 2; index < rows.length; index++) {
        var inputs = rows[index].getElementsByTagName("input");
        newAssignArray[index] = new Array(inputs.length + 2).fill(0);
        for (let j = 0; j < inputs.length; j++) {

            newAssignArray[index][j + 2] = inputs[j].value;
        }
    }

    newAssignArray[2][0] = assignData[2][0];


    newAssignArray = saveTableLeftInput(projectID, newAssignArray);


    assign_arr = [];

    for (let index = 2; index < newAssignArray.length; index++) {
        for (let j = 2; j < newAssignArray[index].length; j++) {

            assign_arr.push(

                {
                    assignID: null,
                    projectID: projectID,
                    memberID: newAssignArray[index][0],
                    year: newAssignArray[0][j].getFullYear(),
                    month: newAssignArray[0][j].getMonth() + 1,
                    value: newAssignArray[index][j]

                }

            );

        }
    }

    updateAssignData_AJAX(assign_arr, projectID);


}

function editModeOff(projectID, assignData) {


    //===DISAPPEARING EDITING PENCIL===//
    //#row1 > div > div.project-rhs > div.add-minus-holder.editMode
    $('#row' + projectID + ' > div > div.project-rhs > .editMode').each(function (index, element) {

        this.style.display = "none";
        document.getElementById('edit-' + projectID).style.display = "block";
    });



    //===DISAPPEARING EDITING BUTTONS===//

    var buttons = document.getElementById("project-row-" + projectID).querySelectorAll("div > div.project-rhs > div.table-right.row > table > tbody > tr > td> button");

    for (let index = 0; index < buttons.length; index++) {


        buttons[index].classList.add("editMode");
        buttons[index].style.display = "none";

    }

    saveInput(projectID, assignData);

}

function callActionListeners(projectID, assignData) {
    document.getElementById("edit-" + projectID).onclick = function () {
        editModeOn(assignData, projectID);
    }
    document.getElementById('save-' + projectID).onclick = function () {

        editModeOff(projectID, assignData);

    };

    document.getElementById('reset-' + projectID).onclick = function () {


        // resetActionCall(assignData,projectID);
        document.getElementById('row' + projectID).innerHTML = `<div class="loader" id="loader-${projectID}"></div>`;
        var response = readProjectAssign_AJAX(projectID);
        try {
            document.getElementById('row' + projectID).innerHTML = "";
            var project = response["resultData"]["project"];
            var data = convertToSimple2DArray(project);
            renderEmptyAssignAccordion(data, project);
            editModeOn(assignData, projectID);
        } catch (err) {
            console.log(err);
        }

    };

    document.getElementById('trash-' + projectID).onclick = function () {

        document.getElementById('row' + projectID).innerHTML = `<div class="loader" id="loader-${projectID}"></div>`;
        var response = readProjectAssign_AJAX(projectID);
        try {
            document.getElementById('row' + projectID).innerHTML = "";
            var project = response["resultData"]["project"];
            var data = convertToSimple2DArray(project);
            renderEmptyAssignAccordion(data, project);
        } catch (err) {
            console.log(err);
        }

    };
}

function getPojectLeaderAssignArrayIndex(mainTableArray, projectLeaderID) {
    for (let i = 2; i < mainTableArray.length; i++) {
        if (mainTableArray[i][0] == projectLeaderID) {
            return i;
        }
    }
    return mainTableArray.length;
}

function putProjectLeaderAlwaysTop(mainTableArray, projectLeaderID) {
    var leaderIndex = getPojectLeaderAssignArrayIndex(mainTableArray, projectLeaderID);
    if (leaderIndex == mainTableArray.length) {

        var length = mainTableArray.length;
        //console.log(length);
        mainTableArray.push([]);
        for (let index = 0; index < mainTableArray[0].length; index++) {
            mainTableArray[length].push(0);
            //console.log(mainTableArray[length][index]);
        }
        //console.log(mainTableArray);
        mainTableArray[length][0] = projectLeaderID;
        leaderIndex = length;
    } else {

    }
    var tmpRow = mainTableArray[2];
    mainTableArray[2] = mainTableArray[leaderIndex];
    mainTableArray[leaderIndex] = tmpRow;

    return mainTableArray;
}

function getAssignedValueByYearMonth(assign, date) {
    date = new Date(date);

    for (let index = 0; index < assign.length; index++) {

        if (assign[index].year == date.getFullYear() && assign[index].month == date.getMonth() + 1) {

            return assign[index].value;
        }
    }
    return 0;
}

function convertToArrayAssign(assign, memberID, dateArray) {

    var assignArray = new Array(dateArray.length).fill(0);
    for (let i = 0; i < dateArray.length; i++) {

        if (i == 0) {
            assignArray[i] = memberID;
        } else if (i == 1) {
            assignArray[i] = 0;
        } else {

            assignArray[i] = getAssignedValueByYearMonth(assign, dateArray[i]);

        }


    }

    return assignArray;
}

function generateMonths(orderMonth, totalMonths) {

    var dateArray = new Array(totalMonths + 2).fill(0);
    var date = new Date(orderMonth);
    for (i = 0; i < totalMonths; i++) {

        dateArray[i + 2] = new Date(date);
        date.setMonth(date.getMonth() + 1);
        date = new Date(date);
    }

    return dateArray;
}

//=== CALCULATING PROJECT DURATION ===//

function calcMonthDiff(orderMonth, inspectionMonth) {

    var date1 = new Date(orderMonth);
    var date2 = new Date(inspectionMonth);

    // To calculate the time difference of two dates
    var Difference_In_Month = (date2.getFullYear() - date1.getFullYear()) * 12;
    Difference_In_Month -= date1.getMonth();
    Difference_In_Month += date2.getMonth();

    // To calculate the no. of days between two dates
    //var Difference_In_Month = Math.ceil(Difference_In_Time / (1000 * 3600 * 24 * 30));
    //return Difference_In_Month;
    return Difference_In_Month <= 0 ? 1 : Difference_In_Month + 1;
}

function calcTotalManMonth(mainTableArray) {
    var sum = 0;
    for (let i = 2; i < mainTableArray.length; i++) {

        sum += parseFloat(parseFloat(mainTableArray[i]).toFixed(2));

    }
    mainTableArray[1] = sum;
    return mainTableArray;
}

function calcSubTotalManMonthRow(mainTableArray) {
    for (let i = 2; i < mainTableArray.length; i++) {
        var sum = 0;
        for (let j = 2; j < mainTableArray[0].length; j++) {

            sum += mainTableArray[i][j];
        }
        mainTableArray[i][1] = sum;
    }

    console.log(mainTableArray);
    return mainTableArray;
}

function calcSubTotalManMonthColumn(mainTableArray) {
    for (let i = 2; i < mainTableArray[0].length; i++) {
        var sum = 0;
        for (let j = 2; j < mainTableArray.length; j++) {

            sum += mainTableArray[j][i];
        }
        mainTableArray[1][i] = parseFloat(parseFloat(sum).toFixed(2));
    }
    return mainTableArray;
}

function convertToSimple2DArray(project) {
    var members = project.member;
    var projectLeaderID = project.projectLeaderID;
    var totalMonths = calcMonthDiff(project.orderMonth, project.inspectionMonth);
    console.log(totalMonths)
    console.log(project)

    var memberLength = 1;

    if (members.length > 0) {
        memberLength = members.length;
    }

    var mainTableArray = new Array(memberLength + 2).fill(0);

    if (members.length > 0) {
        for (let i = 0; i < members.length; i++) {

            var assigns = members[i].assign;
            if (i == 0) {
                mainTableArray[1] = new Array(totalMonths + 2).fill(0);
                mainTableArray[0] = generateMonths(project.orderMonth, totalMonths);
            }

            mainTableArray[i + 2] = convertToArrayAssign(assigns, members[i].memberID, mainTableArray[0]);
        }
        mainTableArray = putProjectLeaderAlwaysTop(mainTableArray, projectLeaderID);
        mainTableArray = calcSubTotalManMonthRow(mainTableArray);
        mainTableArray = calcSubTotalManMonthColumn(mainTableArray);
        mainTableArray[1][0] = members.length;
        mainTableArray[1] = calcTotalManMonth(mainTableArray[1]);

    } else {
        mainTableArray[0] = generateMonths(project.orderMonth, totalMonths);
        mainTableArray[1] = new Array(totalMonths + 2).fill(0);
        mainTableArray[2] = new Array(totalMonths + 2).fill(0);
        mainTableArray[2][0] = projectLeaderID;

    }




    console.log(mainTableArray);
    return mainTableArray;
}
//=== RENDERING PROJECT DETAILS TABLES ===//

function renderEmptyAssignAccordion(assignData, project) {
    var dates = assignData[0];

    var diff = calcMonthDiff(project.orderMonth, project.inspectionMonth);
    var projectID = project.projectID;

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
                        </tr>` +
        generateAssignedMembersHtML(assignData) +
        `</tbody>
                </table>
                    <div class="table-des-container">
                        <table class="table-des" id="tableRight-${projectID}">
                            ` + generateProjectDetailsHeader_AssignedDates(dates) +
        generateProjectDetailsBody_colSum(assignData) +
        generateProjectDetailsBody_AssignedValues(assignData) +

        `</table>
                    </div>
            </div>
        </div>`;
    if (isProjectEditable(project.projectLeaderID)) {
        accordionHTML += `<div class="action">
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
            </div>`
    } else {

    }
    accordionHTML += `</div>`;

    var projects = document.getElementById('row' + projectID);
    //hideLoader(projectID);
    projects.innerHTML = accordionHTML;
    if (isProjectEditable(project.projectLeaderID)) {
        callActionListeners(projectID, assignData);
    } else {

    }

}


//===ADDING ROWS on CLICKING ADD BUTTON===//

function addRow(projectID, diff) {

    addActionListenerForInputs(projectID);

    var string = `<td><button class="delete">-</button> <select class=\"data-cell-fixed\" required>`;
    for (var j = 0; j < users.length; j++) {
        //    if(j==0)
        //         string+=`<option value=${users[j].userID} selected>${convertUser_IDToName(users[j].userID)}</option>`;
        //     else
        string += `<option value=${users[j].userID} >${convertUser_IDToName(users[j].userID)}</option>`;
    }
    string += `</select></td>`;


    document.querySelector("#tableLeft-" + projectID + " > tbody").innerHTML += `<tr class="editMode-input">
                                                ` + string + `
                                                <td>0</td>
                                            </tr>`;



    var selects = document.querySelector("#tableLeft-" + projectID + " > tbody").getElementsByTagName("select");

    for (let i = 0; i < selects.length; i++) {

        selects[i].onchange = function () {
            selects[i].options[selects[i].selectedIndex].setAttribute("selected", "selected");
        }
    }
    string = ``;

    for (let index = 0; index < diff; index++) {
        string += `<td><input type=\"number\" class=\"data-cell\" name=\"data-cell\" min=\"0\" max=\"1\" value=\"0\"></td>`;


    }
    document.querySelector("#tableRight-" + projectID + " > tbody").innerHTML += `<tr class="editMode-input">
                                            ` + string + `</tr>`;




    deleteRowActionListener(projectID);
    addActionListenerForInputs(projectID);

}

function addActionListenerForInputs(projectID) {

    var selects = document.querySelector("#tableLeft-" + projectID + " > tbody").getElementsByTagName("select");

    for (let i = 0; i < selects.length; i++) {

        selects[i].onchange = function () {
            selects[i].options[selects[i].selectedIndex].setAttribute("selected", "selected");
        }
    }

    var ips = document.querySelector("#tableRight-" + projectID + " > tbody").getElementsByTagName("input");
    for (let i = 0; i < ips.length; i++) {
        ips[i].onchange = function () {
            ips[i].setAttribute("value", ips[i].value);
        }
    }
}

function deleteRowActionListener(projectID) {

    var i = 0;
    document.getElementById("project-row-" + projectID).querySelectorAll(".delete").forEach(function (obj, index) {
        obj.addEventListener("click", function (event) {

            if (i == 0) {
                document.getElementById("tableLeft-" + projectID).deleteRow(index + 3);
                document.getElementById("tableRight-" + projectID).deleteRow(index + 3);
                i++;

                deleteRowActionListener(projectID);
            }
        });
    });
}


function isProjectEditable(userId) {
    if (isSystemAdmin())
        return true;
    else if (isGeneralUser() && isCurrentUser(userId))
        return true;
    else
        return false;
}

function hideLoader(projectID) {
    console.log('called');
    document.getElementById("loader-" + projectID).style.display = "none";
    // document.getElementById("row1").style.display = "block";
}

function hideMainLoader() {
    console.log('called');
    document.getElementById("main-loader").style.display = "none";
}

////====SORTING====////

function refreshCards() {
    PROJECT_CARDS = document.querySelectorAll('._project.card');
}

pos = $('.userlist-nav a li');

pos.off("click");
pos.on("click", function () {


    event.preventDefault();

    clickedItem = $($(this)[0]).html();
    console.log(clickedItem);


    switch (clickedItem) {
        case "全て":
            refreshCards();
            for (let i = 0; i < PROJECT_CARDS.length; i++) {
                showCard(PROJECT_CARDS[i])
            }
            return;
        case "A":
        case "B":
        case "C":
        case "○":
        case "Z":
            refreshCards();
            showHideProjectHandler("order-tag", clickedItem);
            return;
        case "見積":
        case "受注":
        case "検収":
        case "完了":
            refreshCards();
            showHideProjectHandler("business-tag", clickedItem);
            return;
        case "要件":
        case "設計":
        case "実装":
        case "テスト":
        case "開発完了":
            refreshCards();
            showHideProjectHandler("development-tag", clickedItem);
            return;
    }


    function showHideProjectHandler(domType, itemName) {
        // console.log(PROJECT_CARDS);
        for (let i = 0; i < PROJECT_CARDS.length; i++) {

            text = $(PROJECT_CARDS[i]).find("." + domType).html();
            //  console.log(text);

            if (text == null) {
                hideCard(PROJECT_CARDS[i])
                continue;
            }

            if (text.includes(itemName)) {

                console.log(text, PROJECT_CARDS[i]);

                showCard(PROJECT_CARDS[i])
            } else {
                hideCard(PROJECT_CARDS[i])
            }

        }
    }

});


function filterProject(e) {
    e.preventDefault();

    switch (e.target.innerText) {
        case "全て":
            refreshCards();
            {
                for (let i = 0; i < item.length; i++) {
                    showCard(staffList[i])
                }
                break;
            }
        case "PM":
            refreshCards();
            {
                for (let i = 0; i < item.length; i++) {
                    if (item[i].innerText == "PM") {
                        showCard(staffList[i])
                    } else {
                        hideCard(staffList[i])
                    }
                }
                break;
            }
        case "SE":
            refreshCards();
            {
                for (let i = 0; i < item.length; i++) {
                    if (item[i].innerText == "SE") {
                        showCard(staffList[i])
                    } else {
                        hideCard(staffList[i])
                    }
                }
                break;
            }
        case "PG":
            refreshCards();
            {
                for (let i = 0; i < item.length; i++) {
                    if (item[i].innerText == "PG") {
                        showCard(staffList[i])
                    } else {
                        hideCard(staffList[i])
                    }
                }
                break;
            }
        case "PL":
            refreshCards();
            {
                for (let i = 0; i < item.length; i++) {
                    if (item[i].innerText == "PL") {
                        showCard(staffList[i])
                        console.log(staffList[i]);
                    } else {
                        hideCard(staffList[i])
                    }
                }
                break;
            }
    }
}



function checkEditDates() {

    var orderInput = document.getElementById("project_edit_order_month_Input");
    var inspectionInput = document.getElementById("project_edit_inspection_month_Input");

    orderInput.addEventListener("change", function () {
        if (new Date(orderInput.value) > project_edit_order_month_Input) {
            Swal.fire({
                title: 'Are you sure?',
                text: "The existing assigns before the current date might be deleted and you won't be able to revert it again",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085D6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, change it!'
            }).then((result) => {
                if (result.isConfirmed) {

                } else {
                    orderInput.value = project_edit_order_month_Input.toISOString().substring(0, 10);
                }
            })
        }
    });


    inspectionInput.addEventListener("change", function () {

        if (new Date(inspectionInput.value) < project_edit_inspection_month_Input)
            Swal.fire({
                title: 'Are you sure?',
                text: "The existing assigns after the current date might be deleted and you won't be able to revert it again",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085D6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, change it!'
            }).then((result) => {
                if (result.isConfirmed) {

                } else {
                    inspectionInput.value = project_edit_inspection_month_Input.toISOString().substring(0, 10);;
                }
            })
    });

}


checkEditDates();