// const { data } = require("jquery");
// var coll1 = document.getElementById("row1head");
// var content1 = document.getElementById("row1");
// var content2 = document.getElementById("row2");


PROJECT_CARDS = [];


function display(x) {

    $('#row' + x).toggle("3000");
    
}


//=== FETCHING PROJECT DETAILS FROM PROJECT API ===//

function fetchProjectList_AJAX() {
    $.ajax({
        type: "post",
        url: "/API/fetchProjectList",
        data: {
            _token: $('#csrf-token')[0].content,
        },
        cache: false,
        success: function (response01) {
            console.log(response01);
            if(response01["resultStatus"]["isSuccess"]) {

                $.ajax({
                    type: "post",
                    url: "/API/readProjectAssign",
                    data: {
                        _token: $('#csrf-token')[0].content,
                        projectID: 1
                    },
                    cache: false,
                    success: function (response02) {
                        console.log(response02);
                        if(response02["resultStatus"]["isSuccess"]) {
                            projectRender();

                                function projectRender() {
                                    setTimeout(function () {
                                        if (USER_LIST.length > 0 && CLIENT_LIST.length > 0) {
                                            renderProjectHTML(response01,response02);
                                        }
                                        else projectRender();
                                    }, 10)
                                }
                            
            
                        } else
                            handleAJAXResponse(response02);
                    },
                    error: function (err) {
                        handleAJAXError(err);
                    }
                });

                

            } else
                handleAJAXResponse(response01);
        },
        error: function (err) {
            handleAJAXError(err);
        }
    });
}

function getOrderStatusHTML(data) {
    switch (data) {
        case 'A': return "<li><div class='order-tag _red'>A</div></li>";
        case 'B': return "<li><div class='order-tag _orange'>B</div></li>";
        case 'C': return "<li><div class='order-tag _orange'>C</div></li>";
        case 'Z': return "<li><div class='order-tag _gray'>Z</div></li>";
        case '●': return "<li><div class='order-tag _green'>○</div></li>";
        default: return "<li></li>";
    }
}

function getBusinessSituationHTML(data) {
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

function getDevelopmentStageHTML(data) {
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

//=== RENDERING PROJECT CARD HEADER ===//

function renderProjectHTML(response01,response02) {

    var projects = document.getElementById('accordian');

    response01["resultData"]["project"].forEach((row) => {

        Object.keys(row).forEach(e => (row[e] == null) ? row[e] = "" : true);
        //=== CALCULATING NUMBER OF DAYS ===//
        var date1 = new Date(row.orderMonth);
        var date2 = new Date(row.inspectionMonth);
        
        // To calculate the time difference of two dates
        var Difference_In_Time = date2.getTime() - date1.getTime();
        
        // To calculate the no. of days between two dates
        var Difference_In_Month =Math.ceil( Difference_In_Time / (1000 * 3600 * 24*30));
        console.log(Difference_In_Month);

        var profit = (row.salesTotal - row.budget) * 100 / row.salesTotal;
        projectHtml =
            `<div class="card _project" id="project-row-${row.projectID}">
             <div class="card-header" id="row1head" onclick="display(${row.projectID})">
             <div class="display list-unstyled">
             <li>${row.projectName}</li>
             <li>${convertClient_IDToName(row.clientID)}</li>
             <li><img src="img/pro_icon.png" class="smallpic">
              <div class="user-name">${convertUser_IDToName(row.projectLeaderID)}</div>
             </li>` +
            getOrderStatusHTML(row.orderStatus) +
            getBusinessSituationHTML(row.businessSituation) +
            getDevelopmentStageHTML(row.developmentStage) +
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
            renderEmptyAssignAccordion(row.projectID,Difference_In_Month,row.orderMonth,convertUser_IDToName(row.projectLeaderID)) +
            `</div>
             </div>`;
        $('#accordian').append(projectHtml);
        
    });

    PROJECT_CARDS = document.querySelectorAll('._project.card');
    // console.log(PROJECT_CARDS);

}

function printHeader(x,orderMonth){
    var print='';
    for(i=0;i<x;i++){
        var date=new Date(orderMonth);
        orderMonth=date.toLocaleDateString();
        print+=`<th>`+orderMonth+`</th>`;
        date=new Date(orderMonth);
        date.setMonth(date.getMonth() + 1);
        orderMonth=date.toLocaleDateString();

    }
    return print;
}
function printTotal(x){
    var print='';
    for(i=0;i<x;i++){
        print+=` <td>3.00</td>`;
    }
    return print;
}
function printBody(x){
    var print='';
    for(i=0;i<x;i++){
        print+=`<td>1.00</td>`;
    }
    return print;
}


//=== RENDERING PROJECT DETAILS TABLES ===//

function renderEmptyAssignAccordion(projectID,x,orderMonth,leader) {

    accordionHTML =

        `<div class="card-body row _accordion">
    
        <div class="table-left">
            <table>
                <tr>
                    <td>予算</td>
                    <td>71,4000　円</td>
                </tr>
                <tr>
                    <td>原価</td>
                    <td>10,0000　円</td>
                </tr>
                <tr>
                    <td>工数</td>
                    <td>10,0000　円</td>
                </tr>
                <tr>
                    <td>粗利</td>
                    <td>1000　円</td>
                </tr>
                <tr>
                    <td>率</td>
                    <td>75.4　%</td>
                </tr>
                <tr>
                    <td>期間</td>
                    <td>2001-2004</td>
                </tr>
            </table>
        </div>
        <div class="project-rhs">
            <div class="add-minus-holder editMode">
                <button class="btn round-btn primary _plus" onclick="addRow(${projectID})"><span
                        class="fa fa-plus"></span></button>
                <button class="btn round-btn danger _minus"><span class="fa fa-minus"></span></button>
            </div>
            <div class="table-right row">
                <table class="table-fix">
                    <tr>
                        <th class="mishti-orange">メンバー</th>
                        <th class="mishti-orange">工数合計</th>
    
                    </tr>
                    <tr class="row-total">
                        <td>3</td>
                        <td>54.0</td>
                    </tr>
                    <tr class="editMode-input">
                        <td><img src="img/pro_icon.png">${leader}</td>
                        <td>18.0</td>
    
                    </tr>
                    <tr class="editMode-input">
                        <td><img src="img/pro_icon.png">社員</td>
                        <td>18.0</td>
                    </tr>
                    <tr class="editMode-input">
                        <td><img src="img/pro_icon.png">社員</td>
                        <td>18.0</td>
                    </tr>
                </table>
                <div class="table-des-container">`+
                    `<table class="table-des">
                        <tr>`+
                            
                            printHeader(x,orderMonth)+
    
                        `</tr>
                        <tr class="row-total">`+
                            printTotal(x)
    
                        +`</tr>
                        <tr class="editMode-input">`+
                            printBody(x)

                        +`</tr>
                        <tr class="editMode-input">`+
                            printBody(x)

                        +`</tr>
                        <tr class="editMode-input">`+
                            printBody(x)

                        +`</tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="action">
            <ul class="list-unstyled">
                <li class="list show"><button class="btn round-btn pencil-btn" onclick="editModeOn(${projectID})"><span
                            style="font-size: 11px; margin:6px;width:auto" class="fa fa-pencil"></span></button></li>
                <div class="editMode">
                    <li class="list"><button class="btn round-btn danger"><span class="fa fa-trash"></span></button></li>
                    <li class="list"><button class="btn round-btn success midori"><span class="fa fa-undo"></span></button>
                    </li>
                    <li class="list"><button class="btn round-btn primary"><span class="fa fa-save"
                                onclick="editModeOff(${projectID})"></span></button></li>
                </div>
            </ul>
        </div>
    </div>`;

    return accordionHTML;
}

document.addEventListener("DOMContentLoaded", () => { fetchProjectList_AJAX() });


pos = $('.userlist-nav a li');

pos.off("click");
pos.on("click", function () {
    event.preventDefault();

    clickedItem = $($(this)[0]).html();
    // console.log(clickedItem);


    switch (clickedItem) {
        case "全て":
            for (let i = 0; i < PROJECT_CARDS.length; i++) {
                showCard(PROJECT_CARDS[i])
            }
            return;
        case "A": case "B": case "C": case "○": case "Z":
            showHideProjectHandler("order-tag", clickedItem);
            return;
        case "見積": case "受注": case "検収": case "完了":
            showHideProjectHandler("business-tag", clickedItem);
            return;
        case "要件": case "設計": case "実装": case "テスト": case "開発完了":
            showHideProjectHandler("development-tag", clickedItem);
            return;
    }


    function showHideProjectHandler(domType, itemName) {
        for (let i = 0; i < PROJECT_CARDS.length; i++) {

            text = $(PROJECT_CARDS[i]).find("." + domType).html();
            console.log(text);

            if (text == null) {
                hideCard(PROJECT_CARDS[i])
                continue;
            }

            if (text.includes(itemName)) {
                showCard(PROJECT_CARDS[i])
            }
            else {
                hideCard(PROJECT_CARDS[i])
            }

        }
    }

});


function filterProject(e) {
    e.preventDefault();
    console.log(e.target.innerText);
    switch (e.target.innerText) {
        case "全て":
            {
                for (let i = 0; i < item.length; i++) {
                    showCard(staffList[i])
                }
                break;
            }
        case "PM":
            {
                for (let i = 0; i < item.length; i++) {
                    if (item[i].innerText == "PM") {
                        showCard(staffList[i])
                    }
                    else {
                        hideCard(staffList[i])
                    }
                }
                break;
            }
        case "SE":
            {
                for (let i = 0; i < item.length; i++) {
                    if (item[i].innerText == "SE") {
                        showCard(staffList[i])
                    }
                    else {
                        hideCard(staffList[i])
                    }
                }
                break;
            }
        case "PG":
            {
                for (let i = 0; i < item.length; i++) {
                    if (item[i].innerText == "PG") {
                        showCard(staffList[i])
                    }
                    else {
                        hideCard(staffList[i])
                    }
                }
                break;
            }
        case "PL":
            {
                for (let i = 0; i < item.length; i++) {
                    if (item[i].innerText == "PL") {
                        showCard(staffList[i])
                        console.log(staffList[i]);
                    }
                    else {
                        hideCard(staffList[i])
                    }
                }
                break;
            }
    }
}


//===TURNING ON EDIT-MODE===//

function editModeOn(x) {
    
    $( '#project-row-' + x +' .editMode').each(function( index ) {
        $( this ).show("slow");
        $('.pencil-btn').eq(x-1).hide();
    });

    //==FETCHING ALL EDITING EDITING FIELDS OF BLUE TABLE==//
    var $dataTable= $('.table-des').eq(x-1).find('.editMode-input');
    //==ADDING EDITING FIELDS TO BLUE TABLE==//
    $dataTable.each(function(i){
        $(this).children('td').each(function( index ){
            $(this).html("<input type=\"text\" class=\"data-cell\" name=\"data-cell\" value=\"1.00\">");
        });
    });


    //==FETCHING ALL EDITING EDITING FIELDS OF ORANGE TABLE==//
    var $dataTable2= $('.table-fix').eq(x-1).find('.editMode-input');
    //==ADDING EDITING FIELDS TO ORANGE TABLE==//
    $dataTable2.each(function(i){
        $(this).children('td').each(function( index ){
            $(this).html("<input type=\"number\" name=\"pro_member\" class=\"data-cell-fixed\" required=\"\" value=\"0\">");
        });
    });


}

//===TURNING OFF EDIT-MODE===//

function editModeOff(x) {


    //===DISAPPEARING EDITING BUTTONS===//
    
    $('.editMode').each(function(index,element){
        $(element).hide("200");
        $('.pencil-btn').eq(x-1).show();
    });

    var details, user_details;
    //=== STORING DETAILS OF RIGHTMOST_BLUE TABLE===//
    details = $('.data-cell').map(function () {
        return {
            val: $(this).val(),
        };
    }).get();

    //==FETCHING ALL EDITING EDITING FIELDS OF BLUE TABLE==//

    
    var $dataTable = $('.table-des').eq(x - 1).find('.editMode-input ');

    let k = 0;
    //===DISAPPEARING EDITING FIELDS OF BLUE TABLE===//
    $dataTable.each(function(i){
        $(this).children('td').each(function( index ){
            $(this).html(details[k].val);
                k++;
        });
    });
    k = 0;

    //=== STORING DETAILS OF ORANGE-FIXED TABLE===//
    user_details = $('.data-cell-fixed').map(function () {
        return {
            val: $(this).val(),
        };
    }).get();
    

    //==FETCHING ALL EDITING EDITING FIELDS OF ORANGE TABLE==//
    
    var $dataTable2 = $('.table-fix').eq(x - 1).find('.editMode-input');
    

    //===DISAPPEARING EDITING FIELDS OF ORANGE TABLE===//
    
    $dataTable2.each(function(i){
        $(this).children('td').each(function( index ){
            if (index % 2 == 0)
                $(this).html('<img src="img/pro_icon.png">' + user_details[k].val);
            else
                $(this).html(user_details[k].val);    
            k++;
        });
    });
    k = 0;


}

//===ADDING ROWS on CLICKING ADD BUTTON===//

function addRow(x) {
    $('.table-fix tbody')[x - 1].innerHTML += `<tr class="editMode-input">
                                                <td><input type="number" name="pro_member" class="data-cell-fixed" required="" value="0"></td>
                                                <td><input type="number" name="pro_member" class="data-cell-fixed" required="" value="0"></td>
                                            </tr>`;
    $('.table-des tbody')[x - 1].innerHTML += `<tr class="editMode-input">
                                            <td><input type=\"text\" class=\"data-cell\" name=\"data-cell\" value=\"0.00\"></td>
                                            <td><input type=\"text\" class=\"data-cell\" name=\"data-cell\" value=\"0.00\"></td>
                                            <td><input type=\"text\" class=\"data-cell\" name=\"data-cell\" value=\"0.00\"></td>
                                            <td><input type=\"text\" class=\"data-cell\" name=\"data-cell\" value=\"0.00\"></td>
                                            <td><input type=\"text\" class=\"data-cell\" name=\"data-cell\" value=\"0.00\"></td>
                                            <td><input type=\"text\" class=\"data-cell\" name=\"data-cell\" value=\"0.00\"></td>
                                            <td><input type=\"text\" class=\"data-cell\" name=\"data-cell\" value=\"0.00\"></td>
                                            <td><input type=\"text\" class=\"data-cell\" name=\"data-cell\" value=\"0.00\"></td>
                                            <td><input type=\"text\" class=\"data-cell\" name=\"data-cell\" value=\"0.00\"></td>
                                            <td><input type=\"text\" class=\"data-cell\" name=\"data-cell\" value=\"0.00\"></td>
                                            <td><input type=\"text\" class=\"data-cell\" name=\"data-cell\" value=\"0.00\"></td>
                                            <td><input type=\"text\" class=\"data-cell\" name=\"data-cell\" value=\"0.00\"></td>
                                            <td><input type=\"text\" class=\"data-cell\" name=\"data-cell\" value=\"0.00\"></td>
                                            <td><input type=\"text\" class=\"data-cell\" name=\"data-cell\" value=\"0.00\"></td>
                                            <td><input type=\"text\" class=\"data-cell\" name=\"data-cell\" value=\"0.00\"></td>
                                            <td><input type=\"text\" class=\"data-cell\" name=\"data-cell\" value=\"0.00\"></td>
                                            <td><input type=\"text\" class=\"data-cell\" name=\"data-cell\" value=\"0.00\"></td>
                                            <td><input type=\"text\" class=\"data-cell\" name=\"data-cell\" value=\"0.00\"></td>
                                        </tr>`;

}