@include("header")
<div class="user-list container-fluid">
    <div class="p-r row">
        <div class="page-title float-left">
            <h2 style="color: black">ユーザー一覧</h2>
        </div>
        <div class="btn-holder float-right">
            <a href="" class="register-btn btn-orange"><span class="fa fa-plus"></span> Register</a>
        </div>
    </div>
    <div class="d-flex">
    
        <div class="row row-content">
            <div class="content-width">
                
                
                <ul class="userlist-nav center list-unstyled">
                    <a href=""><li> 全て</li></a>
                    <a href=""><li> PM</li></a>
                    <a href=""><li> SE</li></a>
                    <a href=""><li> PG</li></a>
                </ul>
                <hr/>
    
                <div id="table-nav" class="primary">
                    <div class="flex-col">
                        <ul class="display list-unstyled">
                            <li> コード <span class="fa fa-caret-down"></span></li>
                            <li >氏名 <span class="fa fa-caret-down"></span></li>
                            <li >所属 <span class="fa fa-caret-down"></span></li>
                            <li >ポジション <span class="fa fa-caret-down"></span></li>
                            <li>入場日 <span class="fa fa-caret-down"></span></li>
                            <li >経過月数 <span class="fa fa-caret-down"></span></li>
                            <li >単価(最新) <span class="fa fa-caret-down"></span></li>
    
                            <li ><span class="fa fa-filter fa-lg"></span><span class="fa fa-caret-down"></span></li>
                        </ul>
                    </div>    	
                      
                </div>

                <div class="staffs">
                    <div class="card">
                        <div class="card-header">
                            <a>
                              <div class="display list-unstyled">
                                <li>0001</li>
                                <li><img src="img/pro_icon.png" class="smallpic"><div>サドマン</div></li>
                                <li>宮崎</li>
                                <li class="pos">PM</li>
                                <li>1/1/2020</li>
                                <li>1年</li>
                                <li>220000円</li>
                                <li><span class="fa fa-ellipsis-v"></span></li>
                                                                                
                              </div>
                            </a>
                          
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" >
                            <a >
                              <div class="display list-unstyled">
                                <li>0002</li>
                                <li><img src="img/user.png" class="smallpic"><div>スマイや</div></li>
                                <li>宮崎</li>
                                <li class="pos">SE</li>
                                <li>1/1/2020</li>
                                <li>1年</li>
                                <li>220000円</li>
                                <li><span class="fa fa-ellipsis-v"></span></li>
                                                                                
                              </div>
                            </a>
                          
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <a >
                              <div class="display list-unstyled">
                                <li>0003</li>
                                <li><img src="img/pro_icon.png" class="smallpic"><div>ウトショブ</div></li>
                                <li>宮崎</li>
                                <li class="pos">SE</li>
                                <li>10/1/2020</li>
                                <li>1月</li>
                                <li>220000円</li>
                                <li><span class="fa fa-ellipsis-v"></span></li>
                                                                                
                              </div>
                            </a>
                          
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <a >
                              <div class="display list-unstyled">
                                <li>0004</li>
                                <li><img src="img/user.png" class="smallpic"><div>ソフィア</div></li>
                                <li>宮崎</li>
                                <li class="pos">SE</li>
                                <li>10/1/2020</li>
                                <li>1月</li>
                                <li>220000円</li>
                                <li><span class="fa fa-ellipsis-v"></span></li>
                                                                                
                              </div>
                            </a>
                          
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <a >
                              <div class="display list-unstyled">
                                <li>0005</li>
                                <li><img src="img/pro_icon.png" class="smallpic"><div>サミウル</div></li>
                                <li>宮崎</li>
                                <li class="pos">PG</li>
                                <li>10/1/2020</li>
                                <li>1月</li>
                                <li>220000円</li>
                                <li><span class="fa fa-ellipsis-v"></span></li>
                                                                                
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
