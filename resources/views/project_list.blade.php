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


            {{-- ///====PROJECT-TABLE DETAILS====/// --}}

            <div class="project table-body">

                <div class="card" id="project-row-">
                    <div class="card-header" id="row1head">
                        <div class="display list-unstyled">
                            <li>Project 1</li>
                            <li>トゥエンティフォーセブン</li>
                            <li>maruta</li>
                            <li>Design</li>
                            <li>A</li>
                            <li>見積中</li>
                            <li>2001</li>
                            <li>2004</li>
                            <li>12000</li>
                            <li>13000</li>
                            <li>40000</li>
                            <li>40%</li>
                        </div>
                    </div>
                    <div class="collapse show" id="row1" >
                        <div class="card-body row">
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
                            <div class="add">
                                <button class="btn round-btn primary"><span class="fa fa-plus"></span></button>
                            </div>
                          <div class="table-right">
                              <table>
                                  <tr>
                                      <th>Member</th>
                                      <th>Ab</th>
                                      <th>202001</th>
                                      <th>202002</th>
                                      <th>202003</th>
                                      <th>202004</th>
                                      <th>202005</th>
                                      <th>202006</th>
                                      <th>202001</th>
                                      <th>202002</th>
                                      <th>202003</th>
                                      <th>202004</th>
                                      <th>202005</th>
                                      <th>202006</th>
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
                </div>
                <div class="card" id="project-row-">
                    <div class="card-header" id="row2head">
                        <div class="display list-unstyled">
                            <li>Project 1</li>
                            <li>トゥエンティフォーセブン</li>
                            <li>maruta</li>
                            <li>Design</li>
                            <li>A</li>
                            <li>見積中</li>
                            <li>2001</li>
                            <li>2004</li>
                            <li>12000</li>
                            <li>13000</li>
                            <li>40000</li>
                            <li>40%</li>
                        </div>
                    </div>
                    <div class="collapse show" id="row2" >
                        <div class="card-body row">
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
                            <div class="add">
                                <button class="btn round-btn primary"><span class="fa fa-plus"></span></button>
                            </div>
                          <div class="table-right">
                              <table>
                                  <tr>
                                      <th>Member</th>
                                      <th>Ab</th>
                                      <th>202001</th>
                                      <th>202002</th>
                                      <th>202003</th>
                                      <th>202004</th>
                                      <th>202005</th>
                                      <th>202006</th>
                                      <th>202001</th>
                                      <th>202002</th>
                                      <th>202003</th>
                                      <th>202004</th>
                                      <th>202005</th>
                                      <th>202006</th>
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
                </div>
            </div>
        </div>
    </div>
</div>

@include("footer")
