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

            <ul class="userlist-nav center list-unstyled">
                <a href="">
                    <li> 全て</li>
                </a>
            </ul>
            <ul class="userlist-nav center list-unstyled" style="float: right;">
                <a href="" onclick="adjustRowHeight()">
                    <li class="fa fa-list"> </li>
                </a>

                @if ($loggedInUser->user_authority == config('constants.User_authority.システム管理者'))
                <a href="" onclick="ProjectRegisterModalHandler()">
                    <li> + 登録</li>
                </a>
                @endif
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
                            <li> 見込</li>
                            <li> 営業状況</li>
                            <li> 作業工程</li>
                            <li> 受注月</li>
                            <li> 検収月</li>
                            <li> 売上高</li>
                            <li> 売上総利益</li>
                            <li> 利益率</li>
                            <li><span class="fa fa-filter fa-lg fa-color-primary">Filter</span> </li>
                        </ul>
                    </div>
                </div>
            </div>


            {{-- ///====PROJECT-TABLE DETAILS====/// --}}

            <div id="accordian" class="project table-body">

                <div class="card _project" id="project-row-">
                    <div class="card-header" id="row1head" onclick="display(1)">
                        <div class="display list-unstyled">
                            <li>実績管理システム</li>
                            <li>トゥエンティフォーセブン</li>
                            <li><img src="img/pro_icon.png" class="smallpic">
                                <div class="user-name">右田</div>
                            </li>
                            <li>
                                <div class="item-green">見積中</div>
                            </li>
                            <li>
                                <div class="item-red">A</div>
                            </li>
                            <li>設計</li>
                            <li>2001/08</li>
                            <li>2004/08</li>
                            <li>12,0000円</li>
                            <li>40,0000円</li>
                            <li>40%</li>
                            <li>
                                <div class="edit" onclick="projectEditModalHandler(1)">
                                    <span style="font-size: 11px; margin:6px;width:auto" class="fa fa-pencil"></span>編集
                                </div>
                            </li>
                        </div>
                    </div>
                    {{-- ///====PROJECT-INNER-CONTENT====///
                    --}}
                    <div class="collapse show" id="row1">
                        <div class="card-body row _accordion">
                            {{-- ///====PROJECT-INNER_LEFT_TABLE====///
                            --}}
                            <div class="table-left">
                                <table>
                                    <tr>
                                        <td>予算</td>
                                        <td>71,4000　円</td>
                                    </tr>
                                    <tr>
                                        <td>原価</td>
                                        <td>10,0000　円</td>
                                    </tr>
                                    <tr>
                                        <td>工数</td>
                                        <td>10,0000　円</td>
                                    </tr>
                                    <tr>
                                        <td>粗利</td>
                                        <td>1000　円</td>
                                    </tr>
                                    <tr>
                                        <td>率</td>
                                        <td>75.4　%</td>
                                    </tr>
                                    <tr>
                                        <td>期間</td>
                                        <td>2001-2004</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="project-rhs">
                                {{--
                                ///====PROJECT-ADD_BTN====///--}}
                                <div class="add-minus-holder">
                                    <button class="btn round-btn danger _minus"><span
                                            class="fa fa-minus"></span></button>
                                    <button class="btn round-btn primary _plus"><span
                                            class="fa fa-plus"></span></button>
                                </div>
                                {{-- ///====PROJECT-INNER-RIGHT-TABLE====///
                                --}}
                                <div class="table-right row">
                                    <table class="table-fix">
                                        <tr>
                                            <th class="mishti-orange">メンバー</th>
                                            <th class="mishti-orange">工数合計</th>

                                        </tr>
                                        <tr class="row-total">
                                            <td>5</td>
                                            <td>none</td>
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
                                            <td><img src="img/pro_icon.png">ソフィア</td>
                                            <td>none</td>
                                        </tr>
                                    </table>
                                    <div class="table-des-container">
                                        <table class="table-des">
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
                                            <tr class="row-total">
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
                                </div>
                            </div>
                            <div class="action">
                                <ul class="list-unstyled">
                                    <li class="list"><button class="btn round-btn danger"><span
                                                class="fa fa-trash"></span></button></li>
                                    <li class="list"><button class="btn round-btn success midori"><span
                                                class="fa fa-undo"></span></button></li>
                                    <li class="list"><button class="btn round-btn primary"><span
                                                class="fa fa-save"></span></button></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> {{-- ///====PROJECT-1st ROW ENDS====///
                --}}

                {{-- ///====PROJECT-2nd ROW STARTS====/// --}}
                <div class="card _project" id="project-row-">
                    <div class="card-header" id="row2head" onclick="display(2)">
                        <div class="display list-unstyled">
                            <li>実績管理システム</li>
                            <li>トゥエンティフォーセブン</li>
                            <li><img src="img/pro_icon.png" class="smallpic">
                                <div class="user-name">右田</div>
                            </li>
                            <li>
                                <div class="item-green">見積中</div>
                            </li>
                            <li>
                                <div class="item-red">A</div>
                            </li>
                            <li>設計</li>
                            <li>2001/08</li>
                            <li>2004/08</li>
                            <li>12,0000円</li>
                            <li>40,0000円</li>
                            <li>40%</li>
                            <li>
                                <div class="edit" onclick="projectEditModalHandler(1)">
                                    <span style="font-size: 11px; margin:6px;width:auto" class="fa fa-pencil"></span>編集
                                </div>
                            </li>
                        </div>
                    </div>
                    {{-- ///====PROJECT-INNER-CONTENT====///
                    --}}
                    <div class="collapse show" id="row2">
                        <div class="card-body row _accordion">
                            {{-- ///====PROJECT-INNER_LEFT_TABLE====///
                            --}}
                            <div class="table-left">
                                <table>
                                    <tr>
                                        <td>予算</td>
                                        <td>Y100000</td>
                                    </tr>
                                    <tr>
                                        <td>原価</td>
                                        <td>Y100000</td>
                                    </tr>
                                    <tr>
                                        <td>工数</td>
                                        <td>Y100000</td>
                                    </tr>
                                    <tr>
                                        <td>粗利</td>
                                        <td>Y1000</td>
                                    </tr>
                                    <tr>
                                        <td>率</td>
                                        <td>Y1000</td>
                                    </tr>
                                    <tr>
                                        <td>期間</td>
                                        <td>Y1000</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="project-rhs">
                                {{--
                                ///====PROJECT-ADD_BTN====///--}}
                                <div class="add-minus-holder">
                                    <button class="btn round-btn danger _minus"><span
                                            class="fa fa-minus"></span></button>
                                    <button class="btn round-btn primary _plus"><span
                                            class="fa fa-plus"></span></button>
                                </div>
                                {{-- ///====PROJECT-INNER-RIGHT-TABLE====///
                                --}}
                                <div class="table-right row">
                                    <table class="table-fix">
                                        <tr>
                                            <th class="mishti-orange">メンバー</th>
                                            <th class="mishti-orange">工数合計</th>

                                        </tr>
                                        <tr class="row-total">
                                            <td>5</td>
                                            <td>none</td>
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
                                            <td><img src="img/pro_icon.png">ソフィア</td>
                                            <td>none</td>
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
                                            <td><img src="img/pro_icon.png">ソフィア</td>
                                            <td>none</td>
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
                                            <td><img src="img/pro_icon.png">ソフィア</td>
                                            <td>none</td>
                                        </tr>
                                        <tr>
                                            <td><img src="img/pro_icon.png">ソフィア</td>
                                            <td>none</td>
                                        </tr>
                                        <tr>
                                            <td><img src="img/pro_icon.png">ソフィア</td>
                                            <td>none</td>
                                        </tr>
                                    </table>
                                    <div class="table-des-container">
                                        <table class="table-des">
                                            <tr>
                                                <th>2020/09</th>
                                                <th>2020/10</th>
                                                <th style="background-color:#ffbf0b;color:black">2020/11</th>
                                                <th>2020/12</th>
                                            </tr>
                                            <tr class="row-total">
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
                                            </tr>
                                            <tr>
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
                                            </tr>
                                            <tr>
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
                                            </tr>
                                            <tr>
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
                                            </tr>
                                            <tr>
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
                                            </tr>
                                            <tr>
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
                                            </tr>

                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="action">
                                <ul class="list-unstyled">
                                    <li class="list"><button class="btn round-btn danger"><span
                                                class="fa fa-trash"></span></button></li>
                                    <li class="list"><button class="btn round-btn success midori"><span
                                                class="fa fa-undo"></span></button></li>
                                    <li class="list"><button class="btn round-btn primary"><span
                                                class="fa fa-save"></span></button></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include("project.edit")
@include("project.create")

@include("footer")
