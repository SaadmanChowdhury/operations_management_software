@include("header")

{{-- ///====PAGE TITLE --}}
<div class="page-title">
    @csrf
    <span class="fa fa-user"></span>
    ユーザー一覧

    <input type="hidden" id="page-name" value="user_list">
    <input type="hidden" id="initial-preference" value="{{ $initialPreference }}">
    
</div>


<div class="row row-content">
    <div class="content-width">

        {{-- ///====FILTER NAVIGATION====/// --}}
        <div class="responsive-scroll">
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

            <ul class="userlist-nav center list-unstyled" style="float: right;">
                <a href="" id="toogler" onclick="adjustRowHeight()" class="list-icon">
                    <li class="fa fa-list"> </li>
                </a>
                @if ($loggedUser->user_authority == 'システム管理者')
                <a href="" onclick="userRegisterModalHandler()" >
                    <li> + 登録</li>
                </a>
                @endif
            </ul>


            <hr />

        </div>



        {{-- ///====USER-TABLE HEADER====/// --}}
        <div data-header="client-head" id="table-nav" class="mild-midori">
            <div class="flex-col">
                <ul class="display list-unstyled">
                    {{--
                    <li data-type="number"> コード <span class="fa fa-caret-down"></span></li>
                    <li>氏名 <span class="fa fa-caret-down"></span></li>
                    <li>所属 <span class="fa fa-caret-down"></span></li>
                    <li>ポジション <span class="fa fa-caret-down"></span></li>
                    <li>経過月数 <span class="fa fa-caret-down"></span></li>
                    <li data-type="number" >単価(最新) <span class="fa fa-caret-down"></span></li>
                    <li><span class="fa fa-filter fa-lg"></span><span class="fa fa-caret-down"></span></li>
                    --}}


                    <li data-type="number" >コード</li>
                    <li>氏名</li>
                    <li>所属</li>
                    <li>ポジション</li>
                    <li data-type="time" >経過月数</li>

                    @if ($loggedUser->user_authority == 'システム管理者')
                    <li data-type="number">単価(最新)</li>
                    @endif

                    <li id="search-modal-init"><span class="fa fa-search fa-lg fa-color-mild-midori"> <b> 検索 </b></span> </li>
                </ul>
            </div>

        </div>


        <div class="staffs table-body">

        </div>
    </div>
</div>

<div class="modal" id="client-search-modal" >

    <div class="modal-content" >
        <span onclick="closeSearchModal('client-search-modal')" class="close">&times;</span>
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
                            会社名:
                          </td>
                          <td>  
                             <input class="modal-inout" id="companyName" data-column-number="1" type="text">
                          </td>
                        </tr>
                        
                        <tr>
                            <td> 
                            経過月数
                            </td>   
                            <td>  
                                 <div data-column-number="4" >
                                    <input id="tim1" type="number" min="0" >
                                    <input id="tim2" type="number" min="0">
                                    ~
                                    <input id="tim3" type="number" min="0" >
                                    <input id="tim4" type="number" min="0" >
                                </div>
                           </td>
                        </tr>

                        <tr>
                            <td> 
                            単価(最新)
                            </td>   
                            <td>  
                                 <div data-column-number="5" >
                                    <input id="rev1" type="number" min="0" >~
                                    <input id="rev2" type="number" min="0" >
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


@include("user.edit")
@include("user.create")

<script src="/js/user.js"></script>
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
    var sm= document.getElementById('client-search-modal');
    sm.style.display="block";
    //openModal();
});


var resetButton = document.getElementById("resetButton");
resetButton.addEventListener("click", function (){


    event.preventDefault();
    var form = document.getElementById("myForm");
    form.reset();

    loadAndHide();

    var sm= document.getElementById('client-search-modal');
    sm.style.display="none";

});


var searchButton = document.getElementById("searchButton");
searchButton.addEventListener("click", function (){


    event.preventDefault();
    loadAndHide();
   

});

function loadAndHide(){
    var modal = document.getElementById("client-search-modal");


try{



var t1,t2,t3,t4;

t1=document.getElementById("tim1").value;
t2=document.getElementById("tim2").value;
t3=document.getElementById("tim3").value;
t4=document.getElementById("tim4").value;

if(t1==""){
    //t1=;
}else{
    t1=t1+"年";
}

if(t2==""){
    //t2=0;
}
else{
    t2=t2+"月";
}

if(t3==""){
    //t3=0;
}
else{
    t3=t3+"年";
}

if(t4==""){
    
}
else{
    t4=t4+"月";
}


var q;
if(t1==0 && t2==0){
    
}

var arrQuery =[
        {
            columNumber: 1,
            query: document.getElementById("companyName").value,
            type: "string"
        },

        {
            columNumber: 4,

            range1: t1+t2,
            range2: t3+t4,
            type: "time"

        },

        {
            columNumber: 5,

            range1: document.getElementById("rev1").value,
            range2:  document.getElementById("rev2").value,
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

var sm= document.getElementById('client-search-modal');
sm.style.display="none";


}

function closeSearchModal(domId){

    var sm= document.getElementById(domId);
    sm.style.display="none";

}
</script>


@include("footer")