<?php

return [
    // プロジェクト の　注文の状況
    'Order_Status' => [
        'A' => 0,   //config('constants.Order_status.A')
        'B' => 1,   //config('constants.Order_status.B')
        'C' => 2,   //config('constants.Order_status.C')
        'Z' => 3,   //config('constants.Order_status.Z'),
        '●' => 4,   //config('constants.Order_status.●'),
    ],

    // プロジェクト の 事業の状況
    'Business_situation' => [
        '見積前' => 0,    //Before quotation       //config('constants.Business_situation.見積前')
        '見積中' => 1,    //During loading        //config('constants.Business_situation.積中')
        '見積済' => 2,    //Presented Estimation  //config('constants.Business_situation.見積提示済')
        '受注' => 3,    //Orders received            //config('constants.Business_situation.受注'),
        '検収中' => 4,    //Accepted            //config('constants.Business_situation.検収中'),
        '完了' => 5,    //Done          //config('constants.Business_situation.完了'),
    ],

    // プロジェクト の 開発段階						
    'Development_stage' => [
        '受注前着手' => 0,    //Start before ordering   //config('constants.Development_stage.受注前着手')
        '要件' => 1,    //Requirement definition   //config('constants.Development_stage.要件')
        '設計' => 2,    // Specification phase   //config('constants.Development_stage.設計')
        '実装' => 3,    // Implementation phase   //config('constants.Development_stage.実装')
        'テスト' => 4,    //Accepted         //config('constants.Development_stage.検収中'),
        '開発完了' => 5,    //Done         //config('constants.Development_stage.完了'),
    ],

    // プロジェクト の ステータスの見積もり アイヂ						
    'Estimate_status_id' => [
        '調整中' => 0,    //Adjusting    //config('constants.Estimate_status_id.調整中')
        '作成済み' => 1,    //Created    //config('constants.Estimate_status_id.作成済み')
        '保留' => 2,    // On hold    //config('constants.Estimate_status_id.保留')
        '提出' => 3,    //Submitted    //config('constants.Estimate_status_id.提出'),
    ],


    // ユーザー　の　位置									
    'Position' => [
        'PM' => 'PM',    //Project Manager    //config('constants.Position.PM')
        'PL' => 'PL',    //Project Leader    //config('constants.Position.PL')
        'SE' => 'SE',    // Software Engineer    //config('constants.Position.SE')
        'PG' => 'PG',    //Programmer    //config('constants.Position.PG'),
    ],

    // ユーザー　の　ユーザー権限															
    'User_authority' => [
        'システム管理者' => 'システム管理者',    // System Administrator    //config('constants.User_authority.システム管理者')
        '一般管理者' => '一般管理者',    //General administrator    //config('constants.User_authority.一般管理者')
        '一般ユーザー' => '一般ユーザー',    // General user    //config('constants.User_authority.一般ユーザー')
    ],

    // スタッフの職場
    'Location' => [
        '宮崎' => '宮崎',    // Miyazaki    //config('constants.Location.宮崎')
        '東京' => '東京',    // Tokyo       //config('constants.Location.東京')
        '福岡' => '福岡' ,    // Fukuoka     //config('constants.Location.福岡')
    ],
    // itemTypeで使用するためのテーブルのID
    'Table' => [
        'user' => 'user',    // User Table    //config('constants.Table.user')
        'project' => 'project',    // Project Table    //config('constants.Table.project')
        'client' => 'client',    // Client Table    //config('constants.Table.client')
    ],

];
