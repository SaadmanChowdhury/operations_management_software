@include("header")

{{-- ///====PAGE TITLE --}}
<div class="page-title">
    <span class="fa fa-users"></span>
    顧客一覧

    <input type="hidden" id="page-name" value="client_list">
    <input type="hidden" id="initial-preference" value="{{ $initialPreference }}">
</div>

{{-- ///====REGISTER BUTTON====/// --}}
{{-- <div id="client-list" class="btn-holder float-right">
    <a href="" class="register-btn btn-orange"><span class="fa fa-plus"></span> 新 規 追 加</a>
</div> --}}

<div class="d-flex">

    <div class="row row-content">
        <div class="content-width">
            <div class="responsive-scroll">
                <ul class="userlist-nav center list-unstyled">
                    <a href="">
                        <li> 全て</li>
                    </a>
                </ul>


                <ul class="userlist-nav center list-unstyled" style="float: right;">
                    <a href="" id="toogler" onclick="adjustRowHeight()" class="list-icon">
                        <li class="fa fa-list"> </li>
                    </a>

                    @if ($loggedInUser->user_authority == 'システム管理者')
                    <a href="" onclick="clientRegisterModalHandler()" >
                        <li> + 登録</li>
                    </a>
                    @endif
                </ul>

                <hr />
            </div>

            {{-- ///====CLIENT-TABLE HEADER====/// --}}
            <div data-header="client-head" id="table-nav" class="midori">
                <div class="flex-col">
                    <ul class="display list-unstyled">
                        <li data-type="number" > コード</li>
                        <li>会社名</li>
                        <li>責任者</li>
                        <li data-type="number">受注顧合計</li>
                        <li data-type="number">実績粗利</li>

                        <li id="search-modal-init" ><span class="fa fa-search fa-lg fa-color-mild-midori"> <b> 検索 </b></span></li>

                    </ul>
                </div>
            </div>


            {{-- ///====CLIENT-TABLE DETAILS====/// --}}

            <div id="client_table" class="client table-body" style="display:none;">

                @foreach ($list as $client)
                <div data-row="{{ $client->client_id }}" class="card _client" id="client-row-{{ $client->client_id }}">
                    <div class="card-header">
                        <div class="display list-unstyled">
                            <li>{{ $client->client_id }}</li>
                            <li>{{ $client->client_name }}</li>
                            <li>
                                <img src="img/pro_icon.png" class="smallpic">
                                <div class="user-name">
                                    {{ $client->user_id }}
                                </div>
                                {{-- <div class="user-name">中村</div>
                                    --}}
                            </li>
                            <!-- {{$loggedInAuthority }}
{{$loggedInUser->user_id }}
{{$loggedInUser->user_authority}} -->

                            @if (($loggedInUser->user_authority == 'システム管理者') || $loggedInUser->user_id ==
                            $client->user_id)
                            <li class="_money">{{ $client->total_sale }}</li>
                            <li class="_money">{{ $client->total_profit }}</li>

                            <li>
                                <div class="edit" onclick="clientEditModalHandler({{ $client->client_id }})">
                                    <span style="font-size: 11px; margin:6px;width:auto" class="fa fa-pencil"></span>編集
                                </div>
                            </li>
                            @else
                            <li class="transparent">円</li>
                            <li class="transparent">円</li>

                            <li>
                                <div class="edit transparent">
                                    <span style="font-size: 11px; margin:6px;width:auto" class="fa fa-pencil"></span>編集
                                </div>
                            </li>
                            @endif

                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>


@include("client.edit")
@include("client.create")

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
                              責任: 
                          </td>
                          <td>  
                             <input class="modal-inout" id="duty" data-column-number="2" type="text">
                         </td>
                        </tr>
                        <tr>
                            <td> 
                               受注顧合計
                            </td>   
                            <td>  
                                 <div data-column-number="3" >
                                    <input id="rev1" type="number"  >~
                                    <input id="rev2" type="number"  >
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


<script src="/js/client.js"></script>
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

var arrQuery =[
        {
            columNumber: 1,
            query: document.getElementById("companyName").value,
            type: "string"
        },

        {
            columNumber: 2,
            query:  document.getElementById("duty").value,
            type: "string"
        },

        {
            columNumber: 3,

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