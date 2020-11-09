@include("header")

{{-- ///====PAGE TITLE --}}
<div class="page-title">
    <span class="fa fa-user"></span>
    ユーザー一覧
</div>


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
        
        <ul class="userlist-nav center list-unstyled" style="float: right;">
            <a href="" onclick="adjustRowHeight()">
                <li class="fa fa-list"> </li>
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

        <div class="staffs table-body">

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

                    //Converting japanese salary to comma separated string
                    $salary= strval($user->unit_price);
                    if(strlen($salary)>=4)
                    {
                        $new_salary=substr_replace($salary, ',', -4, 0);
                        
                    }
                    else {
                        # code...
                        $new_salary=$salary;
                    }
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
                                <li><div class="pos pos-{{$position}}">{{ $position }}</div></li>
                                <li>{{ $time_diff}}{{ $unit }}</li>
                                <li class="salary">{{ $new_salary }}円</li>
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


<script src="/js/user.js"></script>
@include("footer")
