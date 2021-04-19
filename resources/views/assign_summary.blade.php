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
        <div class="content-width">
            <div style="min-width: 1200px">
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
            <div style="min-width: 1200px">
                <div id="table-nav" class=" _assign mild-yellow text-medium">

                    <div class="assign-header-sub-row mild-yellow ">
                        <div class="wrapper text-center text-lg d-flex text-medium" style="align-items: center">
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



var man_mon = [2, 2, 2, 2, 2, 2,
    2, 2, 2, 2, 2, 2
];






class AssignSummrayRenderer {

    constructor(users) {
        this.users = users;
        this.cumSumAllUser = new Array(12).fill(0);

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


    makeSummaryRowList(val) {



        console.log(val)

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

    makeUserSummaryRow(name, rowId, arr, subsRows) {

        var all_work_weights = "";
        var arrl = arr.length;

        for (let index = 0; index < arrl; index++) {
            all_work_weights += this.makeSummaryRowList(arr[index]);
        }

        var c = `<div class="assign-user-tab">
                    <div class="d-flex assign-user-sub-row _header list-unstyled text-center" onclick="assignDisplay(${rowId})">
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
        console.log(pro)
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
        var array_all = [];

        for (let index = 0; index < user.projects.length; index++) {
            array_all.push(this.parseUserPro(user.projects[index]));
        }

        var cumSum = this.calcCumSumPerUser(array_all);

        document.getElementById("assign_summary_table").innerHTML +=
            this.makeUserSummaryRow(name, id, cumSum, array_all);

        this.calcCumulitiveValueForAllUser(cumSum);
    }

    inflateAllUserWithProjects() {
        document.getElementById("assign_summary_table").innerHTML = "";
        for (let index = 0; index < this.users.length; index++) {
            this.calcUserProject(this.users[index], index);
        }
    }



    makeListOfCumulitiveSum(cumCell, index) {

        var sinCellList = `<li class="yellow tooltip">${cumCell}</li>`;

        if (index > 1) {


            var colorWeight = cumCell / man_mon[(index)];

            console.log("----")
            console.log(colorWeight);


            if (cumCell > 0) {

                if (colorWeight < 0) {
                    sinCellList = `<li class="grey tooltip">${cumCell}</li>`;
                } else if (colorWeight > 0 && colorWeight < 1)
                    sinCellList = `<li class="blue tooltip">${cumCell}</li>`;

                else if (colorWeight == 1)
                    sinCellList = `<li class="green tooltip">${cumCell}</li>`;
                else if (colorWeight > 1)
                    sinCellList = `<li class="face-color tooltip">${cumCell}</li>`;

            } else {

                sinCellList = `<li class="grey tooltip">${cumCell}</li>`;
            }


        } else {

            sinCellList = `<li class="yellow tooltip">${cumCell}</li>`;
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
        this.cumSumAllUser.unshift("Max");
        this.renderCumulitiveValueForAllUser(this.cumSumAllUser);
    }


    render() {

        //the sequence is important 
        this.inflateAllUserWithProjects();
        this.showCumulitiveValueForAllUsers();
    }


}


function createPopup(parent, index) {

    var span = document.getElementById("popup" + index);

    // console.log(span);
    if (span == null)

    {

        span = document.createElement("span");
        span.classList.add("tooltiptext");

        span.innerHTML = man_mon[index];

        parent.appendChild(span);
    }




}


function removePopup(parent, index) {

    document.getElementById("popup" + index).remove();;


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


                var x = new AssignSummrayRenderer(response["resultData"]["user"]);
                x.render();

            } else
                handleAJAXResponse(response);
        },
        error: function(err) {
            handleAJAXError(err);
        }
    });
}

function onYearChanged(year) {



    getUserData(year);

    var all_list = document.getElementById("cumulitive_values").getElementsByTagName("li");
    for (let index = 2; index < all_list.length; index++) {

        all_list[index].onmouseover = function() {
            createPopup(this, index - 2);
        }

    }

}

var year = document.getElementById('assign_year').innerHTML;
onYearChanged(year);
</script>

@include("footer")