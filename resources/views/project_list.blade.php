@include("header")

{{-- ///====PAGE TITLE --}}
<div class="page-title">
    <span class="fa fa-newspaper-o"></span>
    案件一覧

    <input type="hidden" id="page-name" value="project_list">
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
                    <li>全て</li>
                </a>
                <a href="">
                    <li>A</li>
                </a>
                <a href="">
                    <li>B</li>
                </a>
                <a href="">
                    <li>C</li>
                </a>
                <a href="">
                    <li>○</li>
                </a>
                <a href="">
                    <li>Z</li>
                </a>
            </ul>
            <ul class="userlist-nav center list-unstyled" style="margin-left: 30px;">
                <a href="">
                    <li>見積</li>
                </a>
                <a href="">
                    <li>受注</li>
                </a>
                <a href="">
                    <li>検収</li>
                </a>
                <a href="">
                    <li>完了</li>
                </a>
            </ul>

            <ul class="userlist-nav center list-unstyled" style="margin-left: 30px;">
                <a href="">
                    <li>要件</li>
                </a>
                <a href="">
                    <li>設計</li>
                </a>
                <a href="">
                    <li>実装</li>
                </a>
                <a href="">
                    <li>テスト</li>
                </a>
                <a href="">
                    <li>開発完了</li>
                </a>
            </ul>
            <ul class="userlist-nav center list-unstyled" style="float: right;">
                <a id="toogler" href="" >
                    <li class="fa fa-list"> </li>
                </a>

                @if ($loggedInUser->user_authority == 'システム管理者')
                <a href="" onclick="ProjectRegisterModalHandler()">
                    <li> + 登録</li>
                </a>
                @endif
            </ul>

            <hr />
        </div>

            {{-- ///====PROJECT-TABLE HEADER====/// --}}
            <div data-header="project-header" class="project">
                <div id="table-nav" class="primary">
                    <div class="flex-col">
                        <ul class="display list-unstyled">
                            <li> 案件名</li>
                            <li> 顧客</li>
                            <li> 担当</li>
                            <li> 見込</li>
                            <li> 営業状況</li>
                            <li> 作業工程</li>
                            <li data-type="number"> 受注月</li>
                            <li data-type="number"> 検収月</li>
                            <li data-type="number"> 売上高</li>
                            <li data-type="number"> 売上総利益</li>
                            <li data-type="number"> 利益率</li>
                            <li id="search-modal-init" ><span class="fa fa-search fa-lg fa-color-primary"> <b> 検索 </b></span> </li>
                        </ul>
                    </div>
                </div>
            </div>


            {{-- ///====PROJECT-TABLE DETAILS====/// --}}

            <div id="accordian" class="project table-body">
                <div class="mainLoader" id="main-loader"></div>


            </div>
        </div>
    </div>
</div>



<div class="modal" id="project-search-modal" >

    <div class="modal-content" >
        <span onclick="closeSearchModal('project-search-modal')" class="close">&times;</span>
        <span >Search Modal</span>
        <div>
             <form id="myForm">

                <table>

                     <tbody  style=" width: 100%;">
                        <tr>
                            <td>
                               全て:
                            </td>

                             <td>
                                 <input type="text" class="modal-inout" id="search" name="search">
                            </td>
                        </tr>

                        <tr>
                          <td>    
                          案件名:
                          </td>
                          <td>  
                             <input class="modal-inout" id="projectName" data-column-number="1" type="text">
                          </td>
                        </tr>

                        <tr>
                          <td>    
                          顧客:
                          </td>
                          <td>  
                             <input class="modal-inout" id="customerName" data-column-number="1" type="text">
                          </td>
                        </tr>


                        <tr>
                          <td>    
                          顧客:
                          </td>
                          <td>  
                             <input class="modal-inout" id="personInChargeName" data-column-number="1" type="text">
                          </td>
                        </tr>


                        <tr>
                            <td> 
                            受注月
                            </td>   
                            <td>  
                                 <div data-column-number="6" >
                                    <input id="monthOfInterestFrom" type="date" min="0" >
                                
                                    ~
                                    <input id="monthOfInterestTo" type="date" min="0" >
                                   
                                </div>
                           </td>
                        </tr>
                        
                        <tr>
                            <td> 
                            検収月
                            </td>   
                            <td>  
                                 <div data-column-number="7" >
                                    <input id="monthOfRecieptFrom" type="date" min="0" >
                                
                                    ~
                                    <input id="monthOfRecieptTo" type="date" min="0" >
                                   
                                </div>
                           </td>
                        </tr>

                        <tr>
                            <td> 
                            売上高
                            </td>   
                            <td>  
                                 <div data-column-number="8" >
                                    <input id="salesFrom" type="number" min="0" >~
                                    <input id="salesTo" type="number" min="0" >
                                </div>
                           </td>
                        </tr>


                        <tr>
                            <td> 
                            売上総利益
                            </td>   
                            <td>  
                                 <div data-column-number="9" >
                                    <input id="publicBenifitFrom" type="number" min="0" >~
                                    <input id="publicBenifitTo" type="number" min="0" >
                                </div>
                           </td>
                        </tr>

                        

                        <tr>
                            <td> 
                            利益率
                            </td>   
                            <td>  
                                 <div data-column-number="10" >
                                    <input id="interestRateFrom" type="number" min="0" max="100" >~
                                    <input id="interestRateTo" type="number" min="0" max="100" >
                                </div>
                           </td>
                        </tr>


                        <tr>
                        <td>
                        </td>
                        <td>
                            <button id="resetButton">Reset</button>
                             <button id="searchButton">Search</button>
                        </td>
                        </tr>

                  </tbody>
          </table>

        <form>
    
    </div>
    </div>


   
</div>

    @include("project.edit")
    @include("project.create")

    <script src="/js/updatedProject.js"></script>
    <script src="/js/anamolyChecker.js"></script>

    <script src="/js/generic-search-sort.js"></script>
    
<script>
"use strict";

new GenericSearchSort().configure();

var search_modal_init = document.getElementById("search-modal-init");

var cloned_search=search_modal_init.cloneNode(true);
search_modal_init.replaceWith(cloned_search);

cloned_search.addEventListener("click", function (){

    event.preventDefault();
   // var modal = document.getElementById("client-search-modal");
    //modal.style.display="block";
    var sm= document.getElementById('project-search-modal');
    sm.style.display="block";
    //openModal();
});


var resetButton = document.getElementById("resetButton");
resetButton.addEventListener("click", function (){


    event.preventDefault();
    var form = document.getElementById("myForm");
    form.reset();

    loadAndHide();

    var sm= document.getElementById('project-search-modal');
    sm.style.display="none";

});


var searchButton = document.getElementById("searchButton");
searchButton.addEventListener("click", function (){


    event.preventDefault();
    loadAndHide();
   

});

function loadAndHide(){
    var modal = document.getElementById("project-search-modal");


try{

var arrQuery =[
        {
            columNumber: 0,
            query: document.getElementById("projectName").value,
            type: "string"
        },

        //customerName

        {
            columNumber: 1,
            query: document.getElementById("customerName").value,
            type: "string"
        },

        //personInCharge
        {
            columNumber: 2,
            query: document.getElementById("personInChargeName").value,
            type: "string"
        },


        {
            columNumber: 6,

            range1: document.getElementById("monthOfInterestFrom").value,
            range2:  document.getElementById("monthOfInterestTo").value,
            type: "number"

        },

        {
            columNumber: 7,

            range1: document.getElementById("monthOfRecieptFrom").value,
            range2:  document.getElementById("monthOfRecieptTo").value,
            type: "number"

        },

        {
            columNumber: 8,

            range1: document.getElementById("salesFrom").value,
            range2:  document.getElementById("salesTo").value,
            type: "number"

        },

        {
            columNumber: 9,

            range1: document.getElementById("publicBenifitFrom").value,
            range2:  document.getElementById("publicBenifitTo").value,
            type: "number"

        },

        {
            columNumber: 10,

            range1: document.getElementById("interestRateFrom").value,
            range2:  document.getElementById("interestRateTo").value,
            type: "number"

        },


];


console.log(arrQuery);

 var gss =new GenericSearchSort();
 gss.searchInColumn(arrQuery);


}
catch(err){

console.log(err);
}

var sm= document.getElementById('project-search-modal');
sm.style.display="none";


}

function closeSearchModal(domId){

    var sm= document.getElementById(domId);
    sm.style.display="none";

}
</script>

    @include("footer")
