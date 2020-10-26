@include("header")
<div class="user-list container-fluid">
    <div class="p-r row">
        <div class="page-title float-left">
            <h2 style="color: black;margin-left:21px">ユーザー一覧</h2>
        </div>
        <div class="btn-holder float-right">
            <a href="" class="register-btn btn-orange"><span class="fa fa-plus"></span> Register</a>
        </div>
    </div>
    <div class="d-flex">

        <div class="row row-content">
            <div class="content-width">

                <div id="table-nav" class="primary">
                    <div class="flex-col">
                        <ul class="display list-unstyled">
                            <li> コード <span class="fa fa-caret-down"></span></li>
                            <li>氏名 <span class="fa fa-caret-down"></span></li>
                            <li>責任者 <span class="fa fa-caret-down"></span></li>
                            <li>受注顧合計 <span class="fa fa-caret-down"></span></li>
                            <li>実績粗利 <span class="fa fa-caret-down"></span></li>
                            <li><span class="fa fa-filter fa-lg"></span><span class="fa fa-caret-down"></span></li>
                        </ul>
                    </div>

                </div>

               

                <div class="staffs">
                    
                        <div class="card"">
                            <div class="card-header">
                                <a>
                                    <div class="display list-unstyled">
                                        <li>001</li>
                                        <li><img src="img/pro_icon.png" class="smallpic">
                                            <div class="user-name">GTM</div>
                                        </li>
                                        <li>Sofia</li>
                                        <li class="pos">100000</li>
                                        <li>Y50,00000</li>
                                        <li><span><img src="img/edit.png" alt=""></span></li>

                                    </div>
                                </a>

                            </div>
                        </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>



@include("footer")
