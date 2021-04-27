// const { data } = require("jquery");
// var coll1 = document.getElementById("row1head");
// var content1 = document.getElementById("row1");
// var content2 = document.getElementById("row2");

// const { assign } = require("lodash");

//const { assign } = require("lodash");


PROJECT_CARDS = [];


function display(id,diff,order,leader) {

$('#row' + id).toggle("3000");    
$.ajax({
    type: "post",
    url: "/API/readProjectAssign",
    data: {
        _token: $('#csrf-token')[0].content,
        projectID: id

    },
    cache: false,
    success: function (response02) {
        console.log(response02);
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
                projectRender();

                function projectRender() {
                    setTimeout(function () {
                        if (USER_LIST.length > 0 && CLIENT_LIST.length > 0) {
                            renderProjectHTML(response01);
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

function renderProjectHTML(response01) {

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
        //console.log(Difference_In_Month);
        var leader= convertUser_IDToName(row.projectLeaderID);
        var profit = (row.salesTotal - row.budget) * 100 / row.salesTotal;
        projectHtml =
            `<div class="card _project" id="project-row-${row.projectID}">
             <div class="card-header" id="row1head" onclick="display(${row.projectID},${Difference_In_Month},'${row.orderMonth}','${leader}')">
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
            `</div>
             </div>`;
        $('#accordian').append(projectHtml);
        
    });

    PROJECT_CARDS = document.querySelectorAll('._project.card');
    
}

function printHeader(x,orderMonth){
    console.log(orderMonth);
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
function printTotal(x,totalWorkMonth){
    var print='';
    for(i=0;i<x;i++){
        print+=` <td>${totalWorkMonth[i]}</td>`;
    }
    return print;
}



function printBody(diff,assign,index){
    console.log(assign);
    var print='';
    
    for(var i=0;i<diff;i++){
        print+=`<td>${assign[index][i]}</td>`;
    }
    return print;
}

function objectToArray(obj){
    var array=[];
    var i=0;
    obj.forEach((row) => {
            array.push(row);           
    });

    return array;
}
//=== RENDERING PROJECT DETAILS TABLES ===//
var assign;
var assignObj;

var cache_assign=[];
var temp_cacheAssign=[];
function renderEmptyAssignAccordion(projectID,diff,orderMonth,leader,response02) {
    
    
    var x=response02["resultData"]["project"]["member"].length+1;
    var members=objectToArray(response02["resultData"]["project"]["member"]);
    
    assign = new Array(x);
    assignObj=new Array(x);
    for (var i = 0; i < assign.length; i++) {
        assign[i] = new Array(diff);
        assignObj[i]=new Array(diff);
    }
   
    for(var i=0;i<x;i++)
    {
        
        for(var j=0;j<diff;j++)
        {
            
            
            assign[i][j]=0;
            assignObj[i][j]={};
            assignObj[i][j]['projectID']=projectID;
            if(i==0){
                date=new Date(orderMonth);
                // orderMonth=date.toLocaleDateString();
                if(j!=0)
                    date.setMonth(date.getMonth() + 1);
                    
                orderMonth=date.toLocaleDateString();
                assign[i][j]= date;
                assignObj[i][j]['month']=date.getMonth()+1;
                assignObj[i][j]['year']=date.getFullYear();
                //console.log(orderMonth);
            }
           
            else{

                assignObj[i][j]['memberID']=members[i-1].memberID;

                assignObj[i][j]['month']=assignObj[0][j]['month'];
                assignObj[i][j]['year']=assignObj[0][j]['year'];

                var flag=0;
                console.log(members[i-1].assign);
                members[i-1].assign.forEach((value,index)=>{
                    //console.log(members[i-1].memberID,value);
                    //console.log(value.month, assign[0][j].getMonth()+1);
                    if(assign[0][j].getMonth()+1==value.month){
                        assign[i][j]=value.value;
                        assignObj[i][j]['assignID']=value.assignID;
                        assignObj[i][j]['value']=value.value;
                        flag=1;
                        
                    }        
                });
                if(!flag){
                    assign[i][j]=0;
                    assignObj[i][j]['assignID']=null;
                    assignObj[i][j]['value']=0;
                }                
            }
            
            
        }

        cache_assign[projectID]=assign;
        
    }
    temp_cacheAssign=[...cache_assign];
    temp_cacheAssign=temp_cacheAssign[1];
    //console.log(cache_assign===temp_cacheAssign);

    var totalWorkMonth=[];
    var sumWork=0;
    for(var i=0;i<diff;i++)
    {
        var sum=0;
        for(var j=1;j<x;j++)
        {
            sum+=assign[j][i];
        }
        sumWork+=sum;
        totalWorkMonth.push(sum);
    }
    console.log(totalWorkMonth);
    console.log(assign);
    console.log(assignObj);

    accordionHTML =

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
        </div>
        <div class="project-rhs">
            <div class="add-minus-holder editMode">
                <button class="btn round-btn primary _plus" onclick="addRow(${projectID},${diff})"><span
                        class="fa fa-plus"></span></button>
                
            </div>
            <div class="table-right row" id="table-right-${projectID}">
                <table class="table-fix" id="tableLeft-${projectID}">
                    <tr>
                        <th class="mishti-orange">メンバー</th>
                        <th class="mishti-orange">工数合計</th>
    
                    </tr>
                    <tr class="row-total">
                        <td>${x-1}</td>
                        <td>${sumWork}</td>
                    </tr>`;
           
                    
                    response02["resultData"]["project"]["member"].forEach((row) => {
                        Object.keys(row).forEach(e => (row[e] == null) ? row[e] = "" : true);
                        console.log(row["assign"]);
                        var sum=0;
                        row["assign"].forEach((assign)=>{
                                sum+=parseFloat(assign.value);
                        });
                        if(leader==convertUser_IDToName(row.memberID)){
                            accordionHTML+=
                                `<tr class="editMode-input">
                                    
                                    <td><img src="img/pro_icon.png">${convertUser_IDToName(row.memberID)}</td>
                                    <td>${sum}</td>
                                </tr>`
                        }
                        else{
                            accordionHTML+=
                                    `<tr class="editMode-input">
                                        
                                        <td><button class="delete editMode">-</button><img src="img/pro_icon.png">${convertUser_IDToName(row.memberID)}</td>
                                        <td>${sum}</td>
                                    </tr>`
                        }
                    });
                    accordionHTML+=
                    `</table>
                    <div class="table-des-container">`+
                    `<table class="table-des" id="tableRight-${projectID}">
                        <tr>`+
                            
                            printHeader(diff,assign[0][0])+
    
                        `</tr>
                        <tr class="row-total">`+
                            printTotal(diff,totalWorkMonth)
    
                        +`</tr>`;
                        var index=1;
                        response02["resultData"]["project"]["member"].forEach((row) => {

                            Object.keys(row).forEach(e => (row[e] == null) ? row[e] = "" : true);
                            
                                console.log(row);
                                accordionHTML+=
                                `<tr class="editMode-input">`+
                                    printBody(diff,assign,index)
                                +`</tr>`;
                                index++;
                        });
                        
                        accordionHTML+=
                    `</table>
                </div>
            </div>
        </div>
        <div class="action">
            <ul class="list-unstyled">
                <li class="list show"><button class="btn round-btn pencil-btn" onclick="editModeOn(${projectID})"><span
                            style="font-size: 11px; margin:6px;width:auto" class="fa fa-pencil"></span></button></li>
                <div class="editMode">
                    <li class="list"><button id="trash-${projectID}" class="btn round-btn danger"><span class="fa fa-trash"></span></button></li>
                    <li class="list"><button id="reset-${projectID}" class="btn round-btn success midori"><span class="fa fa-undo"></span></button>
                    </li>
                    <li class="list"><button class="btn round-btn primary"><span class="fa fa-save"
                                onclick="editModeOff(${projectID})"></span></button></li>
                </div>
            </ul>
        </div>
    </div>`;
    
    if($('#row'+projectID).html()=="")
        $('#row'+projectID).append(accordionHTML);
    document.getElementById('reset-'+projectID).onclick=function(){

        document.getElementById('row'+projectID).innerHTML="";        
        renderEmptyAssignAccordion(projectID,diff,assign[0][0],leader,response02);
        editModeOn(projectID);
    }; 
    
    document.getElementById('trash-'+projectID).onclick=function(){

        document.getElementById('row'+projectID).innerHTML="";        
        renderEmptyAssignAccordion(projectID,diff,assign[0][0],leader,response02);
        
    };        
    
    
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
    
    assign=cache_assign[x];
    console.log( assign[0].length);
    
    $( '#project-row-' + x +' .editMode').each(function( index ) {
        this.style.display="block";
        $('.pencil-btn').eq(x-1).hide();
    });
    

    //==FETCHING ALL EDITING FIELDS OF BLUE TABLE==//
    var $dataTable= $('.table-des').eq(x-1).find('.editMode-input');
    //$dataTable.innerHTML=``;
    //==ADDING EDITING FIELDS TO BLUE TABLE==//
    
    $dataTable.each(function(i){
        for(var j=0;j<assign[0].length;j++)
        {
            if(j==0)
                $(this).html("<td><input type=\"number\" class=\"data-cell\" name=\"data-cell\" value=\""+assign[i+1][j]+"\"></td>");
            else
                $(this).append("<td><input type=\"number\" class=\"data-cell\" name=\"data-cell\" value=\""+assign[i+1][j]+"\"></td>");
        }
    });


    //==FETCHING ALL EDITING EDITING FIELDS OF ORANGE TABLE==//
    var $dataTable2= $('.table-fix').eq(x-1).find('.editMode-input');
    //==ADDING EDITING FIELDS TO ORANGE TABLE==//
    $dataTable2.each(function(i){
        $(this).children('td').each(function( index ){
            //console.log(index);
            if(index%2==0 && i!=0){
                
                var string=`<button class="delete editMode">-</button> <select class=\"data-cell-fixed\" required>`;
                   for(var j=0;j<12;j++)
                   {
                     string+=`<option>${convertUser_IDToName(j)}</option>`;
                   }
                   string+=`</select>`;
                   //$(this).html("<input type=\"number\" name=\"pro_member\" class=\"data-cell-fixed\" required=\"\" value=\"0\">");
                   $(this).html(string);
            }
        });
    });

    var buttons= document.getElementById("project-row-"+x).querySelectorAll("div > div.project-rhs > div.table-right.row > table > tbody > tr > td:nth-child(1) > button");

   for (let index = 0; index < buttons.length; index++) {
       
       buttons[index].classList.remove("editMode");
       
   }

   deleteRowActionListener(x);

}


function deleteRowActionListener(x){

    var i=0;  
    document.getElementById("project-row-"+x).querySelectorAll(".delete").forEach(function(obj,index){ 
        obj.addEventListener("click", function(event){
            
             if(i==0){
                document.getElementById("tableLeft-"+x).deleteRow(index+3);
                document.getElementById("tableRight-"+x).deleteRow(index+3);
                 i++;

                deleteRowActionListener(x);
             } 
        });
    });
}

//===TURNING OFF EDIT-MODE===//

function editModeOff(x) {


    //===DISAPPEARING EDITING BUTTONS===//
    
    $('.editMode').each(function(index,element){
        //$(element).hide("200");
        // this.classList.add("editMode");
        this.style.display="none";
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
    // user_details = $('.data-cell-fixed').map(function () {
    //     return {
    //         val: $(this).val(),
    //     };
    // }).get();
    

    //==FETCHING ALL EDITING EDITING FIELDS OF ORANGE TABLE==//
    
    var $dataTable2 = $('.table-fix').eq(x - 1).find('.editMode-input');
    

    //===DISAPPEARING EDITING FIELDS OF ORANGE TABLE===//
    
    // $dataTable2.each(function(i){
    //     $(this).children('td').each(function( index ){
    //         if (index % 2 == 0)
    //             $(this).html('<img src="img/pro_icon.png">' + user_details[k].val);
    //         else
    //             $(this).html(user_details[k].val);    
    //         k++;
    //     });
    // });
    // k = 0;
    var buttons= document.getElementById("project-row-"+x).querySelectorAll("div > div.project-rhs > div.table-right.row > table > tbody > tr > td:nth-child(1) > button");

    for (let index = 0; index < buttons.length; index++) {
        //const element = buttons[index];
 
        console.log(buttons[index])
        buttons[index].classList.add("editMode");
        buttons[index].style.display="none";
        //$(buttons[index]).show();
    }
    
 


}

//===ADDING ROWS on CLICKING ADD BUTTON===//

function addRow(x,diff) {
    
    var string=`<td><button class="delete">-</button> <select class=\"data-cell-fixed\" required>`;
                   for(var j=0;j<12;j++)
                   {
                     string+=`<option>${convertUser_IDToName(j)}</option>`;
                   }
                   string+=`</select></td>`;
    $('.table-fix tbody')[x - 1].innerHTML += `<tr class="editMode-input">
                                                `+string+`
                                                <td>0</td>
                                            </tr>`;
    string=``;
    console.log(temp_cacheAssign.length);
    var length=temp_cacheAssign.length;
    temp_cacheAssign[length]=new Array(diff);
    console.log(temp_cacheAssign);
    for (let index = 0; index < diff; index++) {
        string+=`<td><input type=\"text\" class=\"data-cell\" name=\"data-cell\" value=\"0\"></td>`;
        temp_cacheAssign[length][index]=0;
        
    }
    $('.table-des tbody')[x - 1].innerHTML += `<tr class="editMode-input">
                                            `+string +`</tr>`;
    console.log(temp_cacheAssign);

}
function resetActionListener(x){

    assign=cache_assign[x];
    console.log( "hi");
    
    $( '#project-row-' + x +' .editMode').each(function( index ) {
        this.style.display="block";
        $('.pencil-btn').eq(x-1).hide();
    });
    

    //==FETCHING ALL EDITING FIELDS OF BLUE TABLE==//
    var $dataTable= $('.table-des').eq(x-1).find('.editMode-input');
    //==ADDING EDITING FIELDS TO BLUE TABLE==//
    
    $dataTable.each(function(i){
        for(var j=0;j<assign[0].length;j++)
        {
            if(j==0)
                $(this).html("<td><input type=\"text\" class=\"data-cell\" name=\"data-cell\" value=\""+assign[i+1][j]+"\"></td>");
            else
                $(this).append("<td><input type=\"text\" class=\"data-cell\" name=\"data-cell\" value=\""+assign[i+1][j]+"\"></td>");
        }
    });


    //==FETCHING ALL EDITING EDITING FIELDS OF ORANGE TABLE==//
    var $dataTable2= $('.table-fix').eq(x-1).find('.editMode-input');
    //==ADDING EDITING FIELDS TO ORANGE TABLE==//
    $dataTable2.each(function(i){
        $(this).children('td').each(function( index ){
            //console.log(index);
            if(index%2==0 && i!=0){
                
                var string=`<button class="delete editMode">-</button> <select class=\"data-cell-fixed\" required>`;
                   for(var j=0;j<12;j++)
                   {
                     string+=`<option>${convertUser_IDToName(j)}</option>`;
                   }
                   string+=`</select>`;
                   //$(this).html("<input type=\"number\" name=\"pro_member\" class=\"data-cell-fixed\" required=\"\" value=\"0\">");
                   $(this).html(string);
            }
        });
    });

    var buttons= document.getElementById("project-row-"+x).querySelectorAll("div > div.project-rhs > div.table-right.row > table > tbody > tr > td:nth-child(1) > button");

   for (let index = 0; index < buttons.length; index++) {
       
       buttons[index].classList.remove("editMode");
       
   }


}

function trashActionListener(x){
    editModeOn(x);
    editModeOff(x);
}






