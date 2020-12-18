var coll1 = document.getElementById("row1head");
var content1 = document.getElementById("row1");
var content2 = document.getElementById("row2");


function display(x) {

    var row = document.getElementById('row' + x);
    console.log(row.style.display);

    if (row.style.display === "block") {
        row.style.display = "none";
    } else {

        row.style.display = "block";

    }
}

function fetchProjectList_AJAX() {
    $.ajax({
        type: "get",
        url: "/API/fetchProjectList",
        data: {
            _token: $('#csrf-token')[0].content,
        },
        cache: false,
        success: function (response) {
            if (response["resultStatus"]["isSuccess"]) {
                renderProjectHTML(response);
            } else
                handleAJAXResponse(response);
        },
        error: function (err) {
            handleAJAXError(err);
        }
    });
}

function getOrderStatusHTML(data) {
    switch (data) {
        case 0: return "<li><div class='order-tag _red'>A</div></li>";
        case 1: return "<li><div class='order-tag _orange'>B</div></li>";
        case 2: return "<li><div class='order-tag _orange'>C</div></li>";
        case 3: return "<li><div class='order-tag _gray'>Z</div></li>";
        case 4: return "<li><div class='order-tag _green'>○</div></li>";
        default: return "<li></li>";
    }
}

function getBusinessSituationHTML(data) {
    switch (data) {
        case 0: return "<li><div class='business-tag _green'>● 見積前</div></li>";
        case 1: return "<li><div class='business-tag _green'>● 見積中</div></li>";
        case 2: return "<li><div class='business-tag _green'>● 見積済</div></li>";
        case 3: return "<li><div class='business-tag _green'>● 受注</div></li>";
        case 4: return "<li><div class='business-tag _green'>● 検収中</div></li>";
        case 5: return "<li><div class='business-tag _green'>● 完了</div></li>";
        default: return "<li></li>";
    }
}

function getDevelopmentStageHTML(data) {
    switch (data) {
        case 0: return "<li><div class='development-tag _blue'>受注前着手</div></li>";
        case 1: return "<li><div class='development-tag _blue'>要件定義</div></li>";
        case 2: return "<li><div class='development-tag _blue'>設計・製造</div></li>";
        case 3: return "<li><div class='development-tag _blue'>検収中</div></li>";
        case 4: return "<li><div class='development-tag _blue'>完了</div></li>";
        default: return "<li></li>";
    }
}

function renderProjectHTML(response) {

    var projects = document.getElementById('accordian');

    response["resultData"]["project"].forEach((row) => {

        Object.keys(row).forEach(e => (row[e] == null) ? row[e] = "" : true);

        var profit = (row.salesTotal - row.budget) * 100 / row.salesTotal;
        projectHtml =
            `<div class="card _project" id="project-row-">` +
            `<div class="card-header" id="row1head" onclick="display(${row.projectID})">` +
            `<div class="display list-unstyled">` +
            `<li>${row.projectName}</li>` +
            `<li>${row.clientID}</li>` +
            `<li><img src="img/pro_icon.png" class="smallpic">` +
            `<div class="user-name">${row.projectLeaderID}</div>` +
            `</li>` +
            getOrderStatusHTML(row.orderStatus) +
            getBusinessSituationHTML(row.businessSituation) +
            getDevelopmentStageHTML(row.developmentStage) +
            `<li>${row.orderMonth}</li>` +
            `<li>${row.inspectionMonth}</li>` +
            `<li>${row.salesTotal}</li>` +
            `<li>${row.budget}</li>` +
            `<li>${profit}%</li>` +
            `<li>` +
            `<div class="edit" onclick="projectEditModalHandler(${row.projectID})">` +
            `<span style="font-size: 11px; margin:6px;width:auto" class="fa fa-pencil"></span>編集` +
            `</div>` +
            `</li>` +
            `</div>` +
            `</div>` +

            `<div class="collapse show" id="row${row.projectID}">` +
            renderEmptyAssignAccordion() +
            `</div>` +
            `</div>`;
        projects.innerHTML += projectHtml;
    });

}

function renderEmptyAssignAccordion() {

    accordionHTML =

        `<div class="card-body row _accordion">` +

        `<div class="table-left">` +
        `<table>` +
        `<tr>
                        <td>予算</td>
                        <td>71,4000　円</td>
                    </tr>`+
        `<tr>
                        <td>原価</td>
                        <td>10,0000　円</td>
                    </tr>`+
        `<tr>
                        <td>工数</td>
                        <td>10,0000　円</td>
                    </tr>`+
        `<tr>
                        <td>粗利</td>
                        <td>1000　円</td>
                    </tr>`+
        `<tr>
                        <td>率</td>
                        <td>75.4　%</td>
                    </tr>`+
        `<tr>
                        <td>期間</td>
                        <td>2001-2004</td>
                    </tr>`+
        `</table>` +
        `</div>` +
        ` <div class="project-rhs">` +
        `<div class="add-minus-holder">
                    <button class="btn round-btn danger _minus"><span
                            class="fa fa-minus"></span></button>
                    <button class="btn round-btn primary _plus"><span
                            class="fa fa-plus"></span></button>
                </div>`+

        `<div class="table-right row">` +
        `<table class="table-fix">` +
        `<tr>
                            <th class="mishti-orange">メンバー</th>
                            <th class="mishti-orange">工数合計</th>

                        </tr>`+
        `<tr class="row-total">
                            <td>5</td>
                            <td>none</td>
                        </tr>`+
        `<tr>
                            <td><img src="img/pro_icon.png">ソフィア</td>
                            <td>none</td>

                        </tr>`+
        `<tr>
                            <td><img src="img/pro_icon.png">ソフィア</td>
                            <td>none</td>
                        </tr>`+
        `<tr>
                            <td><img src="img/pro_icon.png">ソフィア</td>
                            <td>none</td>
                        </tr>`+
        `</table>` +
        `<div class="table-des-container">` +
        `<table class="table-des">` +
        `<tr>` +
        `<th>2020/01</th>
                                <th>2020/02</th>
                                <th>2020/03</th>
                                <th>2020/04</th>
                                <th>2020/05</th>
                                <th>2020/06</th>
                                <th>2020/07</th>
                                <th>2020/08</th>
                                <th>2020/09</th>
                                <th>2020/10</th>
                                <th style="background-color:#ffbf0b;color:black">2020/11</th>
                                <th>2020/12</th>`+
        `</tr>` +
        `<tr class="row-total">` +
        `<td>1.00</td>
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
                                <td>1.00</td>`+

        `</tr>` +
        `<tr>
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

                            </tr>`+
        `<tr>
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

                            </tr>`+
        `<tr>
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

                            </tr>`+

        `</table>` +
        `</div>` +
        `</div>` +
        `</div>` +
        `<div class="action">` +
        `<ul class="list-unstyled">
                    <li class="list"><button class="btn round-btn danger"><span
                                class="fa fa-trash"></span></button></li>
                    <li class="list"><button class="btn round-btn success midori"><span
                                class="fa fa-undo"></span></button></li>
                    <li class="list"><button class="btn round-btn primary"><span
                                class="fa fa-save"></span></button></li>
                </ul>`+
        `</div>` +
        `</div>`;

    return accordionHTML;
}

document.addEventListener("DOMContentLoaded", () => { fetchProjectList_AJAX() });