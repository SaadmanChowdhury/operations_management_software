@include("header")

{{-- ///====PAGE TITLE --}}
<div class="page-title">
    <span class="fa fa-newspaper-o"></span>
    案件一覧
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
            </ul>
            <ul class="userlist-nav center list-unstyled" style="float: right;">
                <a href="" onclick="adjustRowHeight()">
                    <li class="fa fa-list"> </li>
                </a>
            </ul>

            <hr />

            {{-- ///====PROJECT-TABLE HEADER====/// --}}
            <div class="project">
                <div id="table-nav" class="primary">
                    <div class="flex-col">
                        <ul class="display list-unstyled">
                            <li> 案件名</li>
                            <li> 顧客</li>
                            <li> 担当</li>
                            <li>作業工程</li>
                            <li> 見込</li>
                            <li> 状況</li>
                            <li> 受注月</li>
                            <li> 検収月</li>
                            <li> 売上高</li>
                            <li> 売上原価</li>
                            <li>売上総利益</li>
                            <li> 利益率</li>
                        </ul>
                    </div>
                </div>
            </div>


            {{-- ///====PROJECT-TABLE DETAILS====/// --}}

            <div id="accordian" class="project table-body">

                <div class="card" id="project-row-1" onclick="display(1)">
                    <div class="card-header" id="row1head">
                        <div class="display list-unstyled">
                            <li>実績管理システム</li>
                            <li>トゥエンティフォーセブン</li>
                            <li><img src="img/pro_icon.png" class="smallpic">
                                <div class="user-name">右田</div></li>
                            <li>設計</li>
                            <li><div class="item-green">見積中</div></li>
                            <li><div class="item-red">A</div></li>
                            <li>2001/08</li>
                            <li>2004/08</li>
                            <li>12,0000円</li>
                            <li>13,0000円</li>
                            <li>40,0000円</li>
                            <li>40%</li>
                        </div>
                    </div>
                    {{-- ///====PROJECT-INNER-CONTENT====/// --}}
                    <div class="collapse show" id="row1" >
                        <div class="card-body row">
                            {{-- ///====PROJECT-INNER_LEFT_TABLE====/// --}}
                            <div class="table-left">
                                <table>
                                  
                                  <tr>
                                      <td>ABC</td>
                                      <td>Y100000</td>
                                  </tr>
                                  <tr>
                                      <td>ABC</td>
                                      <td>Y100000</td>
                                  </tr>
                                  <tr>
                                      <td>ABC</td>
                                      <td>Y100000</td>
                                  </tr>
                                  <tr>
                                      <td>ABC</td>
                                      <td>Y100000</td>
                                  </tr>
                              </table>
                            </div>
                            {{-- ///====PROJECT-ADD_BTN====/// --}}
                            <div class="add">
                                <button class="btn round-btn primary"><span class="fa fa-plus"></span></button>
                            </div>
                            {{-- ///====PROJECT-INNER-RIGHT-TABLE====/// --}}
                            <div class="table-right">
                                <table>
                                    <tr>
                                        <th>Member</th>
                                        <th>Ab</th>
                                        <th>2020/01</th>
                                        <th>2020/02</th>
                                        <th>2020/03</th>
                                        <th>2020/04</th>
                                        <th>2020/05</th>
                                        <th>2020/06</th>
                                        <th>2020/07</th>
                                        <th>2020/08</th>
                                        <th>2020/09</th>
                                        <th>2020/10</th>
                                        <th style="background-color:#ffbf0b;color:black">2020/11</th>
                                        <th>2020/12</th>
                                    </tr>
                                    <tr>
                                        <td><img src="img/pro_icon.png">Sofia</td>
                                        <td>none</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>

                                    </tr>
                                    <tr>
                                        <td><img src="img/pro_icon.png">Sofia</td>
                                        <td>none</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        
                                    </tr>
                                    <tr>
                                        <td><img src="img/pro_icon.png">Sofia</td>
                                        <td>none</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        
                                    </tr>
                                    <tr>
                                        <td><img src="img/pro_icon.png">Sofia</td>
                                        <td>none</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        
                                    </tr>
                                    <tr>
                                        <td><img src="img/pro_icon.png">Sofia</td>
                                        <td>none</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="action">
                                <ul class="list-unstyled">
                                    <li class="list"><button class="btn round-btn danger"><span class="fa fa-trash"></span></button></li>
                                    <li class="list"><button class="btn round-btn success"><span class="fa fa-clone"></span></button></li>
                                    <li class="list"><button  class="btn round-btn primary"><span class="fa fa-save"></span></button></li>
                                </ul>
                            </div>
                        </div>
                      </div>
                </div> {{-- ///====PROJECT-1st ROW ENDS====/// --}}

                {{-- ///====PROJECT-2nd ROW STARTS====/// --}}
                <div class="card" id="project-row-" onclick="display(2)">
                    <div class="card-header" id="row2head">
                        <div class="display list-unstyled">
                            <li>実績管理システム</li>
                            <li>トゥエンティフォーセブン</li>
                            <li><img src="img/pro_icon.png" class="smallpic">
                                <div class="user-name">右田</div></li>
                            <li>設計</li>
                            <li><div class="item-green">見積中</div></li>
                            <li><div class="item-red">A</div></li>
                            <li>2001/08</li>
                            <li>2004/08</li>
                            <li>12,0000円</li>
                            <li>13,0000円</li>
                            <li>40,0000円</li>
                            <li>40%</li>
                        </div>
                    </div>
                    {{-- ///====PROJECT-INNER-CONTENT====/// --}}
                    <div class="collapse show" id="row2" >
                        <div class="card-body row">
                            {{-- ///====PROJECT-INNER_LEFT_TABLE====/// --}}
                            <div class="table-left">
                                <table>
                                  
                                  <tr>
                                      <td>ABC</td>
                                      <td>Y100000</td>
                                  </tr>
                                  <tr>
                                      <td>ABC</td>
                                      <td>Y100000</td>
                                  </tr>
                                  <tr>
                                      <td>ABC</td>
                                      <td>Y100000</td>
                                  </tr>
                                  <tr>
                                      <td>ABC</td>
                                      <td>Y100000</td>
                                  </tr>
                              </table>
                            </div>
                            {{-- ///====PROJECT-ADD_BTN====/// --}}
                            <div class="add">
                                <button class="btn round-btn primary"><span class="fa fa-plus"></span></button>
                            </div>
                            {{-- ///====PROJECT-INNER-RIGHT-TABLE====/// --}}
                            <div class="table-right row">
                                <table class="table-scroll">
                                    <tr>
                                        <th class="mishti-orange">Member</th>
                                        <th class="mishti-orange">Ab</th>
                                        
                                    </tr>
                                    <tr>
                                        <td><img src="img/pro_icon.png">ソフィア</td>
                                        <td>none</td>
                                    </tr>
                                    <tr>
                                        <td><img src="img/pro_icon.png">ソフィア</td>
                                        <td>none</td>
                                                                               
                                    </tr>
                                    <tr>
                                        <td><img src="img/pro_icon.png">Sofia</td>
                                        <td>none</td>
                                                                                
                                    </tr>
                                    <tr>
                                        <td><img src="img/pro_icon.png">Sofia</td>
                                        <td>none</td>
                                    </tr>
                                </table>
                                <table>
                                    <tr>
                                        <th>2020/01</th>
                                        <th>2020/02</th>
                                        <th>2020/03</th>
                                        <th>2020/04</th>
                                        <th>2020/05</th>
                                        <th>2020/06</th>
                                        <th>2020/07</th>
                                        <th>2020/08</th>
                                        <th>2020/09</th>
                                        <th>2020/10</th>
                                        <th style="background-color:#ffbf0b;color:black">2020/11</th>
                                        <th>2020/12</th>
                                    </tr>
                                    <tr>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>

                                    </tr>
                                    <tr>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>

                                    </tr>
                                    <tr>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>

                                    </tr>
                                    <tr>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>
                                        <td>5.00</td>

                                    </tr>

                                </table>
                            </div>
                            <div class="action">
                                <ul class="list-unstyled">
                                    <li class="list"><button class="btn round-btn danger"><span class="fa fa-trash"></span></button></li>
                                    <li class="list"><button class="btn round-btn success"><span class="fa fa-clone"></span></button></li>
                                    <li class="list"><button  class="btn round-btn primary"><span class="fa fa-save"></span></button></li>
                                </ul>
                            </div>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include("footer")
