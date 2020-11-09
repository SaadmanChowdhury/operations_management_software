@include("header")
<div class="user-list container-fluid">
    <div class="p-r row">

        {{-- ///====PAGE TITLE --}}
        <div class="page-title float-left">
            <h2 style="color: black;margin-left:21px">ユーザー一覧</h2>
        </div>

        {{-- ///====REGISTER BUTTON====/// --}}
        <div class="btn-holder float-right">
            <a href="" class="register-btn btn-orange"><span class="fa fa-plus"></span>新規追加</a>
        </div>
    </div>
    <div class="d-flex">

        <div class="row row-content">
            <div class="content-width">

                {{-- ///====FILTER NAVIGATION====/// --}}
                <ul class="userlist-nav center list-unstyled">
                    <a href="">
                        <li> 全て</li>
                    </a>
                    <a href="">
                        <li> PL</li>
                    </a>
                    <a href="">
                        <li> PM</li>
                    </a>
                    <a href="">
                        <li> SE</li>
                    </a>
                    <a href="">
                        <li> PG</li>
                    </a>
                </ul>
                <hr />

                {{-- ///====USER-TABLE HEADER====/// --}}
                <div id="table-nav" class="primary">
                    <div class="flex-col">
                        <ul class="display list-unstyled">
                            <li> コード <span class="fa fa-caret-down"></span></li>
                            <li>氏名 <span class="fa fa-caret-down"></span></li>
                            <li>所属 <span class="fa fa-caret-down"></span></li>
                            <li>ポジション <span class="fa fa-caret-down"></span></li>
                            <li>入場日 <span class="fa fa-caret-down"></span></li>
                            <li>経過月数 <span class="fa fa-caret-down"></span></li>
                            <li>単価(最新) <span class="fa fa-caret-down"></span></li>

                            <li><span class="fa fa-filter fa-lg"></span><span class="fa fa-caret-down"></span></li>
                        </ul>
                    </div>

                </div>

                {{-- ///====CARBON USED FOR TIME====/// --}}
                @php
                    use Carbon\Carbon;
                @endphp

                <div class="staffs">

                    {{-- ///====ELAPSED TIME CALCULATION====/// --}}
                    @foreach ($users as $user)
                        @php
                            
                            $mytime=Carbon::today();
                            $time_diff=floor(($mytime->diffInDays($user->admission_day))/365);
                            $unit='年';
                            if($time_diff==0)
                            {
                                $time_diff=floor(($mytime->diffInDays($user->admission_day))/30);
                                $unit='月';
                            }

                    
                            ///====CONVERTING INT TO TEXT====///
                            $salary= number_format($user->unit_price);
                            // USER_ICON URL
                            switch ($user->gender) {
                                case '0':
                                    $pro_icon='pro_icon';
                                    break;
                                case '1':
                                    $pro_icon='pro_icon3';
                                    break;
                                
                                default:
                                    $pro_icon='pro_icon';
                                    break;
                            }

                            // USER_LOCATION
                            switch ($user->location) {
                                case '0':
                                    $loc='宮崎';
                                    break;
                                case '1':
                                    $loc='東京';
                                    break;
                                case '2':
                                    $loc='福岡';
                                    break;
                                
                                default:
                                    $loc='宮崎';
                                    break;
                            }

                            // USER_POSITION
                            switch ($user->position) {
                                case '0':
                                    $position='PM';
                                    $bg_color=' #28c128';
                                    break;
                                case '1':
                                    $position='PL';
                                    $bg_color='orange';
                                    break;
                                case '2':
                                    $position='SE';
                                    $bg_color=' blue';
                                    break;
                                case '3':
                                    $position='PG';
                                    $bg_color=' #f86128';
                                    break;
                                
                                default:
                                    $position='SE';
                                    break;
                            }


                        @endphp

                        {{-- ///====USER-TABLE DETAILS====/// --}}
                        <div class="card" id="user-row-{{ $user->user_id }}" onload="numberWithCommas({{ $user->unit_price }})">
                            <div class="card-header">
                                <a>
                                    <div class="display list-unstyled">
                                        <li>{{ $user->user_id }}</li>
                                        <li><img src="img/{{ $pro_icon }}.png" class="smallpic">
                                            <div class="user-name">{{ $user->name }}</div>
                                        </li>
                                        <li>{{ $loc }}</li>
                                        <li><div class="pos" style="background-color: {{ $bg_color }}">{{ $position }}</div></li>
                                        <li>{{ $user->admission_day }}</li>
                                        <li>{{ $time_diff}}{{ $unit }}</li>
                                        <li class="salary">{{ $salary }}円</li>
                                        <li>
                                            <div class="edit">
                                                <span style="font-size: 11px; margin:6px;width:auto" class="fa fa-pencil"></span>編集
                                            </div>
                                        </li>

                                    </div>
                                </a>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>


<script src="/js/user.js"></script>
@include("footer")
