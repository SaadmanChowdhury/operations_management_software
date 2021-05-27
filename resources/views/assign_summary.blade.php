@include("header")

{{-- ///====PAGE TITLE --}}
<div class="page-title">
    <span class="fa fa-home"></span>
    アサインサマリー

    <input type="hidden" id="page-name" value="assign_summary">
    <input type="hidden" id="initial-preference" value="{{ $initialPreference }}">
</div>

{{-- ///====REGISTER BUTTON====/// --}}
{{-- <div id="client-list" class="btn-holder float-right">
    <a href="" class="register-btn btn-orange"><span class="fa fa-plus"></span> 新 規 追 加</a>
</div> --}}

<div class="d-flex">

    <div class="row row-content">
        <div class="assign-summary-scroll">
            <div class="assignSummary-responsive-scroll">
                <ul class="userlist-nav center list-unstyled">
                    <a href="">
                        <li> 全て</li>
                    </a>
                    <a href="">
                        <li> PM</li>
                    </a>
                    <a href="">
                        <li> PL</li>
                    </a>
                    <a href="">
                        <li> SE</li>
                    </a>
                    <a href="">
                        <li> PG</li>
                    </a>
                </ul>
                <ul class="userlist-nav center list-unstyled" style="margin-left: 30px;">
                    <a href="">
                        <li> 無し
                        </li>
                    </a>
                    <a href="">
                        <li> 限界</li>
                    </a>
                    <a href="">
                        <li> 未だ</li>
                    </a>
                </ul>

                <ul class="userlist-nav center list-unstyled" style="float: right; ">
                    <a href="" onclick="alert('Adjust font size');">
                        <li class="fa fa-arrows-alt"> </li>
                    </a>
                </ul>



                <hr />
            </div>

            {{-- ///====ASSIGN-SUMMARY-TABLE HEADER====///
            --}}
            <div style="">
                <div id="table-nav" class=" _assign mild-yellow text-medium">

                    <div class="assign-header-sub-row mild-yellow ">
                        <div class="text-center text-lg d-flex text-medium" style="align-items: center">
                            <script>
                            $assign_year = 2020;
                            </script>
                            <span class="fa fa-caret-left" onclick="year_dec($assign_year)"></span>
                            <p id="assign_year">2020</p>
                            <span class="fa fa-caret-right" onclick="year_inc($assign_year)"></span>
                        </div>
                    </div>
                    <div class="d-flex assign-header-sub-row mild-yellow text-center list-unstyled">
                        <div class="wrapper d-flex text-medium">
                            <li>名前</li>
                            <li>プロジェクト</li>
                            <li>1</li>
                            <li>2</li>
                            <li>3</li>
                            <li>4</li>
                            <li>5</li>
                            <li>6</li>
                            <li>7</li>
                            <li>8</li>
                            <li>9</li>
                            <li>10</li>
                            <li>11</li>
                            <li>12</li>
                        </div>
                    </div>
                </div>


                {{-- ///====ASSIGN-SUMMARY-TABLE DETAILS====///
            --}}
                <div class="d-flex assign-summary table-header _assign list-unstyled">
                    <div id="cumulitive_values" class="wrapper text-medium d-flex text-center">
                        <li class="yellow">2.0</li>
                        <li class="yellow"> </li>
                        <li class="green">2.0</li>
                        <li class="green">2.0</li>
                        <li class="green">2.0</li>
                        <li class="face-color">2.5</li>
                        <li class="green">2.0</li>
                        <li class="green">2.0</li>
                        <li class="blue">1.5</li>
                        <li class="blue">1.5</li>
                        <li class="blue">1.0</li>
                        <li class="blue">1.0</li>
                        <li class="grey">0</li>
                        <li class="grey">0</li>
                    </div>
                </div>

                <div id="assign_summary_table" class="assign-summary table-body _assign">

                    <div class="assign-user-tab">
                        <div class="d-flex assign-user-sub-row _header list-unstyled text-center"
                            onclick="assignDisplay(1)">
                            <div class="wrapper d-flex text-center">
                                <li class="d-flex text-medium align-items-center">丸田</li>
                                <li class=" text-medium">合計 </li>
                                <li class="faded-green">1.0</li>
                                <li class="faded-green">1.0</li>
                                <li class="faded-green">1.0</li>
                                <li class="faded-green">1.0</li>
                                <li class="faded-green">1.0</li>
                                <li class="faded-green">1.0</li>
                                <li class="faded-green">1.0</li>
                                <li class="faded-green">1.0</li>
                                <li class="faded-green">1.0</li>
                                <li class="faded-green">1.0</li>
                                <li class="faded-grey">0</li>
                                <li class="faded-grey">0</li>
                            </div>

                        </div>
                        <div class="assign-user-row" id="user-row-1">
                            <div class="assign-user-sub-row">
                                <div class="wrapper d-flex text-center">
                                    <li class="d-flex align-items-center"></li>
                                    <li class="flex-3">東電プロジェクト </li>
                                    <li class="faded-yellow">1.0</li>
                                    <li class="faded-yellow">1.0</li>
                                    <li class="faded-yellow">1.0</li>
                                    <li class="faded-yellow">1.0</li>
                                    <li class="faded-yellow">1.0</li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                </div>
                            </div>
                            <div class="assign-user-sub-row">
                                <div class="wrapper d-flex text-center">
                                    <li class="d-flex align-items-center"></li>
                                    <li class="flex-3"> パナソニック改修対応</li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li class="faded-yellow">1.0</li>
                                    <li class="faded-yellow">1.0</li>
                                    <li class="faded-yellow">1.0</li>
                                    <li class="faded-yellow">1.0</li>
                                    <li class="faded-yellow">1.0</li>
                                    <li></li>
                                    <li></li>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="assign-user-tab">
                        <div class="d-flex assign-user-sub-row _header list-unstyled text-center"
                            onclick="assignDisplay(2)">
                            <div class="wrapper d-flex text-center">
                                <li class="d-flex text-medium align-items-center">富永</li>
                                <li class=" text-medium">合計 </li>
                                <li class="faded-green">1.0</li>
                                <li class="faded-green">1.0</li>
                                <li class="faded-green">1.0</li>
                                <li class="faded-face-color">1.5</li>
                                <li class="faded-green">1.0</li>
                                <li class="faded-green">1.0</li>
                                <li class="faded-blue">0.5</li>
                                <li class="faded-blue">0.5</li>
                                <li class="faded-grey">0</li>
                                <li class="faded-grey">0</li>
                                <li class="faded-grey">0</li>
                                <li class="faded-grey">0</li>
                            </div>

                        </div>
                        <div class="assign-user-row" id="user-row-2">
                            <div class="assign-user-sub-row">
                                <div class="wrapper d-flex text-center">
                                    <li class="d-flex align-items-center"></li>
                                    <li>ぴあアプリ対応 </li>
                                    <li class="faded-yellow">1.0</li>
                                    <li class="faded-yellow">1.0</li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                </div>
                            </div>
                            <div class="assign-user-sub-row">
                                <div class="wrapper d-flex text-center">
                                    <li class="d-flex align-items-center"></li>
                                    <li> ぴあアプリ対応</li>
                                    <li></li>
                                    <li></li>
                                    <li class="faded-yellow">0.5</li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                </div>
                            </div>
                            <div class="assign-user-sub-row">
                                <div class="wrapper d-flex text-center">
                                    <li class="d-flex align-items-center"></li>
                                    <li> iPhoneアプリ対応</li>
                                    <li></li>
                                    <li></li>
                                    <li class="faded-yellow">0.5</li>
                                    <li class="faded-yellow">0.5</li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                </div>
                            </div>
                            <div class="assign-user-sub-row">
                                <div class="wrapper d-flex text-center">
                                    <li class="d-flex align-items-center"></li>
                                    <li> ぴあアプリ対応</li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li class="faded-yellow">0.5</li>
                                    <li class="faded-yellow">0.5</li>
                                    <li class="faded-yellow">0.5</li>
                                    <li class="faded-yellow">0.5</li>
                                    <li class="faded-yellow">0.5</li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                </div>
                            </div>
                            <div class="assign-user-sub-row">
                                <div class="wrapper d-flex text-center">
                                    <li class="d-flex align-items-center"></li>
                                    <li> iPhoneアプリ対応</li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li class="faded-yellow">0.5</li>
                                    <li class="faded-yellow">0.5</li>
                                    <li class="faded-yellow">0.5</li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- <div class="assign-user-tab">
                    <div class="assign-user-sub-row _header">

                    </div>
                    <div class="assign-user-sub-row">

                    </div>
                    <div class="assign-user-sub-row">

                    </div>
                    
                </div>

                <div class="assign-user-tab">
                    <div class="assign-user-sub-row _header">

                    </div>
                    <div class="assign-user-sub-row">

                    </div>
                    <div class="assign-user-sub-row">

                    </div>
                </div>
                <div class="assign-user-tab">
                    <div class="assign-user-sub-row _header">

                    </div>
                    <div class="assign-user-sub-row">

                    </div>
                    <div class="assign-user-sub-row">

                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>




<style>
.tooltip {
    position: relative;
    display: inline-block;
    border-bottom: 1px dotted black;
}

.tooltip .tooltiptext {

    margin-bottom: 4em;
    visibility: hidden;
    width: 120px;
    background-color: black;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;

    /* Position the tooltip */
    position: absolute;
    z-index: 90009;
}

.tooltip:hover .tooltiptext {
    visibility: visible;
}
</style>


<script>
var users = [

    {
        userName: "user name 1",

        projects: [

            {
                projectName: "project name 1",
                assign: [

                    {
                        year: 2020,
                        month: 1,
                        assignValue: 0.5
                    },
                    {
                        year: 2020,
                        month: 2,
                        assignValue: 1.0
                    },
                    {
                        year: 2020,
                        month: 3,
                        assignValue: 1.0
                    }


                ]
            },

            {
                projectName: "project name 2",
                assign: [

                    {
                        year: 2020,
                        month: 2,
                        assignValue: 1.0
                    },
                    {
                        year: 2020,
                        month: 3,
                        assignValue: 1.0
                    }


                ]
            }

        ]

    },

    {
        userName: "user name 2",

        projects: [



        ]

    }


];




var categoryViewMode="all";
//az atleast one ois zero
//ago atleast one is greater than one
//alo atleast one is less than one




function atleastOneAssignIsZero(htmlDomRowListContainer){
  
  var lists = htmlDomRowListContainer.getElementsByTagName("li");

  for (let i = 0; i < lists.length; i++) {
      if(!isNaN(lists[i].innerText))
      if(lists[i].innerText==0)
          return true;
  }

  return false;

}



function calcCumSumOnInstantaneousRows(instantaneousLiveRows){

    var sumRow=["","",
        0,0,0,0,0,0,
        0,0,0,0,0,0];

    for (let i = 0; i < instantaneousLiveRows.length; i++) {
          var lists=instantaneousLiveRows[i].getElementsByTagName("li");
            for (let j = 2; j < lists.length; j++) {
                sumRow[j]=  parseFloat(sumRow[j])+ parseFloat(lists[j].innerText);
                sumRow[j]= sumRow[j].toFixed(2);
                
            }
    }

   // console.log(sumRow);

    return sumRow;
}


function showAssignedUserByPosition(position){

var instantaneousLiveRows =[]; 

var rows= document.querySelectorAll("#assign_summary_table > div > div.d-flex.assign-user-sub-row._header.list-unstyled.text-center");

var all=false;
if(position=="ALL"){
   all=true;
}

for (let i = 0; i < rows.length; i++) {
   if(all || (rows[i].getAttribute("data-position")==position) ){
    showCard(rows[i].parentElement);
    instantaneousLiveRows.push(rows[i]);
   }
   else{
    hideCard(rows[i].parentElement);
   }
}

var r = new AssignSummrayRenderer(null, new Array(12).fill(instantaneousLiveRows.length));
r.renderCumulitiveValueForAllUser(calcCumSumOnInstantaneousRows(instantaneousLiveRows));
r.inflatePopupForManMonths();

}


function showAssignsWhereAssignHasAtleastOneZero(){

    var instantaneousLiveRows =[]; 

    var rows= document.querySelectorAll("#assign_summary_table > div > div.d-flex.assign-user-sub-row._header.list-unstyled.text-center");
    
   
    for (let i = 0; i < rows.length; i++) {
       if(atleastOneAssignIsZero(rows[i])){
        showCard(rows[i].parentElement);
        instantaneousLiveRows.push(rows[i]);
       }
       else{
        hideCard(rows[i].parentElement);
       }
    }

    var r = new AssignSummrayRenderer(null, new Array(12).fill(instantaneousLiveRows.length));
    r.renderCumulitiveValueForAllUser(calcCumSumOnInstantaneousRows(instantaneousLiveRows));
    r.inflatePopupForManMonths();

}
  
function atleastOneAssignIsGreaterThanOne(htmlDomRowListContainer){
  
  var lists = htmlDomRowListContainer.getElementsByTagName("li");

  for (let i = 0; i < lists.length; i++) {
      if(!isNaN(lists[i].innerText))
      if(lists[i].innerText>1)
          return true;
  }

  return false;

}

function showAssignsWhereAssignHasAtleastOneIsGreaterThanOne(){
    var year = document.getElementById('assign_year').innerHTML;

    var r = new AssignSummrayRenderer(null,getManMonthByYear());
    var instantaneousLiveRows =[]; 

var rows= document.querySelectorAll("#assign_summary_table > div > div.d-flex.assign-user-sub-row._header.list-unstyled.text-center");

for (let i = 0; i < rows.length; i++) {
   if(atleastOneAssignIsGreaterThanOne(rows[i])){
    showCard(rows[i].parentElement);
    instantaneousLiveRows.push(rows[i]);
   }
   else{
    
    hideCard(rows[i].parentElement);
   }
}

    var r = new AssignSummrayRenderer(null, new Array(12).fill(instantaneousLiveRows.length));
    r.renderCumulitiveValueForAllUser(calcCumSumOnInstantaneousRows(instantaneousLiveRows));
    r.inflatePopupForManMonths();

}

function atleastOneAssignIsLessThanOne(htmlDomRowListContainer){
  
  var lists = htmlDomRowListContainer.getElementsByTagName("li");

  for (let i = 0; i < lists.length; i++) {
      if(!isNaN(lists[i].innerText))
      if(lists[i].innerText>0 && lists[i].innerText<1)
          return true;
  }

  return false;

}

function showAssignsWhereAssignHasAtleastOneIsLessThanOne(){

    var year = document.getElementById('assign_year').innerHTML;

    var r = new AssignSummrayRenderer(null,getManMonthByYear());
    var instantaneousLiveRows =[]; 

    var rows= document.querySelectorAll("#assign_summary_table > div > div.d-flex.assign-user-sub-row._header.list-unstyled.text-center");

    for (let i = 0; i < rows.length; i++) {
    if(atleastOneAssignIsLessThanOne(rows[i])){
        showCard(rows[i].parentElement);
        instantaneousLiveRows.push(rows[i]);
        
    }
    else{
        hideCard(rows[i].parentElement);
    }
    }

    var r = new AssignSummrayRenderer(null, new Array(12).fill(instantaneousLiveRows.length));
    r.renderCumulitiveValueForAllUser(calcCumSumOnInstantaneousRows(instantaneousLiveRows));
    r.inflatePopupForManMonths();

}

class AssignSummrayRenderer {

    constructor(users , man_months) {
        this.users = users;
        this.cumSumAllUser = new Array(12).fill(0);
        this.man_mon = man_months;

    }

    calcCumSumPerUser(array_all) {
        var cumSum = [];

        for (let index = 0; index < 12; index++) {
            cumSum[index] = 0;
        }

        for (let index = 0; index < array_all.length; index++) {
            for (let j = 1; j < 13; j++) {
                cumSum[j - 1] += array_all[index][j];
            }
        }
        return cumSum;
    }


    makeSubRowListInner(val) {
        var list = `<li class="faded-yellow">${val}</li>`;

        if (!isNaN(val)) {

            if (val == 0) {
                list = `<li></li>`;
            } else if (val > 0) {
                list = `<li class="faded-yellow">${val}</li>`
            }
        } else {
            list = `<li>${val}</li>`;
        }

        return list;
    }

    makeSubRow(row, subsRows) {
        var all_lists = "";

        // console.log(subsRows)

        for (var j = 0; j < 13; j++) {
            all_lists += this.makeSubRowListInner(subsRows[row][j]);
        }

        var subRow = ` <div class="assign-user-sub-row">
                            <div class="wrapper d-flex text-center">
                                <li class="d-flex align-items-center"></li>
                                ` + all_lists + `
                            </div>
                        </div>`;
        return subRow;
    }
    makeSubRowList(rowId, subsRows) {

        var subRowsString = ``;

        for (let index = 0; index < subsRows.length; index++) {

            subRowsString += this.makeSubRow(index, subsRows);

        }

        var fullRow = ` <div class="assign-user-row" id="user-row-${rowId}">` +
            subRowsString +
            `</div>`;

        return fullRow;
    }

    round(n) {
      var h = (n * 100) % 10;
      return h >= 7
             ? n + (10 - h) * .01
             : n;
    }

    makeSummaryRowList(val) {



        //console.log(val)

        
        val=this.round(val).toFixed(2);

        var list = `<li class="faded-green">エラー</li>`;

        if (!isNaN(val)) {

            if (val <= 0) {
                list = ` <li class="faded-grey">${val}</li>`;
            } else if (val > 0 && val < 1) {
                list = ` <li class="faded-blue">${val}</li>`;
            } else if (val == 1) {
                list = ` <li class="faded-green">${val}</li>`;
            } else if (val > 1) {
                list = ` <li class="faded-face-color">${val}</li>`;
            }

        } else {

            list = ` <li class=" text-medium">${val}</li>`
        }

        return list;

    }

    makeUserSummaryRow(name, rowId, position,  arr, subsRows) {

        var all_work_weights = "";
        var arrl = arr.length;

        for (let index = 0; index < arrl; index++) {
            all_work_weights += this.makeSummaryRowList(arr[index]);
        }

        var c = `<div class="assign-user-tab">
                    <div data-position="${position}" class="d-flex assign-user-sub-row _header list-unstyled text-center" onclick="assignDisplay(${rowId})">
                        <div class="wrapper d-flex text-center">
                            <li class="d-flex text-medium align-items-center">${name}</li>
                            <li class=" text-medium">合計 </li>
                          
                            ` + all_work_weights + `
                        </div>
                    </div>
                    ` + this.makeSubRowList(rowId, subsRows) + `          
                </div>`;

        return c;
    }


    calcCumulitiveValueForAllUser(cumSum) {
        for (let index = 0; index < this.cumSumAllUser.length; index++) {
            this.cumSumAllUser[index] += cumSum[index];
        }
    }


    parseUserPro(pro) {
        //console.log(pro)
        var pro_row = [];
        pro_row[0] = pro.projectName;

        for (let i = 1; i < 13; i++) {
            pro_row[i] = 0;
        }

        for (let index = 0; index < pro.assign.length; index++) {
            for (let month = 1; month < 13; month++) {
                if (pro.assign[index].month == month) {
                    pro_row[month] = pro.assign[index].assignValue;
                }
            }
        }


        return pro_row;
    }


    calcUserProject(user, id) {
        var name = user.userName;
        var position = user.position;
        var array_all = [];


        for (let index = 0; index < user.projects.length; index++) {
            array_all.push(this.parseUserPro(user.projects[index]));
        }

        var cumSum = this.calcCumSumPerUser(array_all);

        document.getElementById("assign_summary_table").innerHTML +=
            this.makeUserSummaryRow(name, id, position, cumSum, array_all);

        this.calcCumulitiveValueForAllUser(cumSum);
    }

    inflateAllUserWithProjects() {
        document.getElementById("assign_summary_table").innerHTML = "";
        for (let index = 0; index < this.users.length; index++) {
            this.calcUserProject(this.users[index], index);
        }
    }





    checkValidNumber(num){
        if(!isNaN(num) && num>0){
            return true;
        }
        return false;
    }

    makeListOfCumulitiveSum(cumCell, index) {

        var sinCellList = `<li class="yellow tooltip">${cumCell}</li>`;

        if(index==0 || index==1)
         return sinCellList;

        else if (index > 1) {

            if(this.man_mon[(index-2)]==0){
                sinCellList = `<li class="grey tooltip">${cumCell}</li>`;

            }
            else if ( cumCell<this.man_mon[(index-2)]){

                sinCellList = `<li class="blue tooltip">${cumCell}</li>`;
            }

            else if ( cumCell==this.man_mon[(index-2)]){

                sinCellList = `<li class="green tooltip">${cumCell}</li>`;
            }

            else if ( cumCell>this.man_mon[(index-2)]){

                sinCellList = `<li class="face-color tooltip">${cumCell}</li>`;
            }
        //     var colorWeight = 0;
            
        //     if( this.checkValidNumber(cumCell)  &&  this.checkValidNumber( this.man_mon[(index-2)]) )
        //      colorWeight =cumCell / this.man_mon[(index-2)];
        //    // console.log(cumCell, index ,this.man_mon[(index-2)], colorWeight);


        //     if (cumCell > 0) {

        //         if (colorWeight < 0) {
        //             sinCellList = `<li class="grey tooltip">${cumCell}</li>`;
        //         } else if (colorWeight > 0 && colorWeight < 1)
        //             sinCellList = `<li class="blue tooltip">${cumCell}</li>`;

        //         else if (colorWeight == 1)
        //             sinCellList = `<li class="green tooltip">${cumCell}</li>`;
        //         else if (colorWeight > 1)
        //             sinCellList = `<li class="face-color tooltip">${cumCell}</li>`;

        //     } else {

        //         sinCellList = `<li class="grey tooltip">${cumCell}</li>`;
        //     }


        } 


        return sinCellList;
    }



    makeAllListOfCumulitiveSum(cumCells) {

        var all = "";
        for (let index = 0; index < cumCells.length; index++) {
            all += this.makeListOfCumulitiveSum(cumCells[index], index);
        }
        return all;
    }

    renderCumulitiveValueForAllUser(arrCumSum) {

        var cumulitive_values_div = document.getElementById("cumulitive_values");

        cumulitive_values_div.innerHTML = this.makeAllListOfCumulitiveSum(arrCumSum);

    }



    showCumulitiveValueForAllUsers() {
        this.cumSumAllUser.unshift("");
        this.cumSumAllUser.unshift("");
        this.renderCumulitiveValueForAllUser(this.cumSumAllUser);
    }


    

    
     removePopup(parent, index) {
        document.getElementById("popup" + index).remove();;
    }


     createPopup(parent, index , usersPerMonth) {

        var span = document.getElementById("popup" + index);

        // console.log(span);
        if (span == null)

        {

            span = document.createElement("span");
            span.classList.add("tooltiptext");
            span.id="popup" + index;
            span.innerHTML = usersPerMonth;

            parent.appendChild(span);
        }

    }



    inflatePopupForManMonths(){
        var all_list = document.getElementById("cumulitive_values").getElementsByTagName("li");
            for (let index = 2; index < all_list.length; index++) {

                var _self=this;
                all_list[index].onmouseover = function() {
                    _self.createPopup(all_list[index], index - 2 , _self.man_mon[index - 2]);
                }

            }
    }

    render() {

        //the sequence is important 
        this.inflateAllUserWithProjects();
        this.showCumulitiveValueForAllUsers();
        this.inflatePopupForManMonths();
    }


}






function getManMonthByYear(aYear) {

    var active_users_per_month= [0,0,0,0,0,0,
    0,0,0,0,0,0];

    $.ajax({
        type: "post",
        async:false,
        url: "/API/activeUserCount",
        data: {
            year: aYear,
            _token: $('input[name=_token]').val()
        },
        cache: false,
        success: function(response) {
            if (response["resultStatus"]["isSuccess"]) {


             active_users_per_month= response["resultData"]["userCount"];

            } else
                handleAJAXResponse(response);
        },
        error: function(err) {
            handleAJAXError(err);
        }
    });

    return active_users_per_month;
}


function getUserData(aYear) {
    $.ajax({
        type: "post",
        url: "/API/assignSummary",
        data: {
            year: aYear,
            _token: $('input[name=_token]').val()
        },
        cache: false,
        success: function(response) {
            if (response["resultStatus"]["isSuccess"]) {

                var x = new AssignSummrayRenderer(response["resultData"]["user"] ,
                getManMonthByYear(aYear)
                );
                x.render();

                

            } else
                handleAJAXResponse(response);
        },
        error: function(err) {
            handleAJAXError(err);
        }
    });
}



function addAssignCategoryListeners(){

    var categories = document.querySelectorAll("body > div.page-container > div.d-flex > div > div > div:nth-child(1) > ul:nth-child(2) > a ");
    //console.log(categories);
    if(categories.length==3){
            categories[0].addEventListener("click",function eventsForCategories(e){

                       e.preventDefault();
                       showAssignsWhereAssignHasAtleastOneZero();
                       

                } );


                categories[1].addEventListener("click",function eventsForCategories(e){

                            e.preventDefault();
                            showAssignsWhereAssignHasAtleastOneIsGreaterThanOne();
                            

                } );

                categories[2].addEventListener("click",function eventsForCategories(e){

                            e.preventDefault();
                            showAssignsWhereAssignHasAtleastOneIsLessThanOne();

                } );

       
    }
}

function addAssignCategoryListenersByPosition(){
    var posBtns = document.querySelectorAll("body > div.page-container > div.d-flex > div > div > div:nth-child(1) > ul:nth-child(1) > a");
    
    var options = ["ALL" , "PM" , "PL" , "SE" , "PG"]

    for (let i = 0; i < posBtns.length; i++) {
        posBtns[i].addEventListener("click",function eventsForCategories(e){
                e.preventDefault();
                showAssignedUserByPosition(options[i]);
            } );
        }

}

function onYearChanged(year) {



    getUserData(year);


}

var year = document.getElementById('assign_year').innerHTML;
onYearChanged(year);
addAssignCategoryListeners();
addAssignCategoryListenersByPosition();

</script>

@include("footer")