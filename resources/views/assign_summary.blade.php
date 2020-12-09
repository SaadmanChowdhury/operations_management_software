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

            {{-- ///====ASSIGN-SUMMARY-TABLE HEADER====///
            --}}
            <div id="table-nav" class=" _assign text-medium">
                
                <div class="assign-header-sub-row mild-yellow text-center text-lg">
                     2020
                </div>
                <div class="d-flex assign-header-sub-row mild-yellow text-center list-unstyled">
                    <div class="wrapper d-flex text-medium" >
                        <li class="faded-face-color">名前</li>
                        <li class="faded-face-color">プロジェクト</li>
                        <li >1</li>
                        <li >2</li>
                        <li >3</li>
                        <li >4</li>
                        <li >5</li>
                        <li >6</li>
                        <li >7</li>
                        <li >8</li>
                        <li >9</li>
                        <li >10</li>
                        <li >11</li>
                        <li >12</li>
                    </div>
                </div>
            </div>


            {{-- ///====ASSIGN-SUMMARY-TABLE DETAILS====///
            --}}
            <div class="d-flex assign-summary table-header _assign list-unstyled">
                <div class="wrapper text-medium d-flex text-center" >
                    <li class="yellow" >2.0</li>
                    <li class="yellow"> </li>
                    <li class="green" >2.0</li>
                    <li class="green" >2.0</li>
                    <li class="green" >2.0</li>
                    <li class="face-color" >2.5</li>
                    <li class="green" >2.0</li>
                    <li class="green" >2.0</li>
                    <li class="blue" >1.5</li>
                    <li class="blue" >1.5</li>
                    <li class="blue" >1.0</li>
                    <li class="blue" >1.0</li>
                    <li class="grey" >0</li>
                    <li class="grey" >0</li>
                </div>
            </div>

            <div class="assign-summary table-body _assign">

                <div class="assign-user-tab">
                    <div class="d-flex assign-user-sub-row _header list-unstyled text-center">
                        <div class="wrapper d-flex text-center" >
                            <li class="d-flex text-medium align-items-center" >丸田</li>
                            <li class=" text-medium">合計 </li>
                            <li class="faded-green" >1.0</li>
                            <li class="faded-green" >1.0</li>
                            <li class="faded-green" >1.0</li>
                            <li class="faded-green" >1.0</li>
                            <li class="faded-green" >1.0</li>
                            <li class="faded-green" >1.0</li>
                            <li class="faded-green" >1.0</li>
                            <li class="faded-green" >1.0</li>
                            <li class="faded-green" >1.0</li>
                            <li class="faded-green" >1.0</li>
                            <li class="faded-grey" >0</li>
                            <li class="faded-grey" >0</li>
                        </div>
                        
                    </div>
                    <div class="assign-user-sub-row">
                        <div class="wrapper d-flex text-center" >
                            <li class="d-flex align-items-center" ></li>
                            <li class="flex-3">東電プロジェクト </li>
                            <li class="faded-yellow" >1.0</li>
                            <li class="faded-yellow" >1.0</li>
                            <li class="faded-yellow" >1.0</li>
                            <li class="faded-yellow" >1.0</li>
                            <li class="faded-yellow" >1.0</li>
                            <li class="faded-yellow" >1.0</li>
                            <li ></li>
                            <li ></li>
                            <li ></li>
                            <li ></li>
                            <li ></li>
                            <li ></li>
                        </div>
                    </div>
                    <div class="assign-user-sub-row">
                        <div class="wrapper d-flex text-center" >
                            <li class="d-flex align-items-center" ></li>
                            <li class="flex-3"> パナソニック改修対応</li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li class="faded-yellow" >1.0</li>
                            <li class="faded-yellow"  >1.0</li>
                            <li class="faded-yellow"  >1.0</li>
                            <li class="faded-yellow"  >1.0</li>
                            <li class="faded-yellow"  >1.0</li>
                            <li></li>
                            <li></li>
                        </div>
                    </div>
                </div>

                <div class="assign-user-tab">
                    <div class="d-flex assign-user-sub-row _header list-unstyled text-center">
                        <div class="wrapper d-flex text-center" >
                            <li class="d-flex text-medium align-items-center" >富永</li>
                            <li class=" text-medium">合計 </li>
                            <li class="faded-green" >1.0</li>
                            <li class="faded-green" >1.0</li>
                            <li class="faded-green" >1.0</li>
                            <li class="faded-green" >1.0</li>
                            <li class="faded-green" >1.0</li>
                            <li class="faded-green" >1.0</li>
                            <li class="faded-green" >1.0</li>
                            <li class="faded-green" >1.0</li>
                            <li class="faded-green" >1.0</li>
                            <li class="faded-green" >1.0</li>
                            <li class="faded-grey" >0</li>
                            <li class="faded-grey" >0</li>
                        </div>
                        
                    </div>
                    <div class="assign-user-sub-row">
                        <div class="wrapper d-flex text-center" >
                            <li class="d-flex align-items-center" ></li>
                            <li class="flex-3">東電プロジェクト </li>
                            <li class="faded-yellow" >1.0</li>
                            <li class="faded-yellow" >1.0</li>
                            <li class="faded-yellow" >1.0</li>
                            <li class="faded-yellow" >1.0</li>
                            <li class="faded-yellow" >1.0</li>
                            <li class="faded-yellow" >1.0</li>
                            <li ></li>
                            <li ></li>
                            <li ></li>
                            <li ></li>
                            <li ></li>
                            <li ></li>
                        </div>
                    </div>
                    <div class="assign-user-sub-row">
                        <div class="wrapper d-flex text-center" >
                            <li class="d-flex align-items-center" ></li>
                            <li class="flex-3"> パナソニック改修対応</li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li class="faded-yellow" >1.0</li>
                            <li class="faded-yellow"  >1.0</li>
                            <li class="faded-yellow"  >1.0</li>
                            <li class="faded-yellow"  >1.0</li>
                            <li class="faded-yellow"  >1.0</li>
                            <li></li>
                            <li></li>
                        </div>
                    </div>
                </div>


                <div class="assign-user-tab">
                    <div class="assign-user-sub-row _header">

                    </div>
                    <div class="assign-user-sub-row">

                    </div>
                    <div class="assign-user-sub-row">

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
                </div>
            </div>
        </div>
    </div>
</div>

@include("footer")
