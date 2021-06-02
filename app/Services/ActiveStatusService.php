<?php

namespace App\Services;

use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ActiveStatusService
{
    /**
     * this method will change the active status of a model depending on the 
     * provided information
     *
     * @param [type] $request
     * @return void
     */
    public function updateActiveStatus($request)
    {
        $item_type = $request->itemType;
        $item_id = $request->itemID;
        $active_status = $request->activeStatus;

        switch ($item_type) {
            case "user":
                $userModel = new User();
                return $userModel->changeActiveStatus($item_id, $active_status);
                break;
            case "project":
                $projectModel = new Project();
                return $projectModel->changeActiveStatus($item_id, $active_status);
                break;
            case "client":
                $clientModel = new Client();
                return $clientModel->changeActiveStatus($item_id, $active_status);
                break;
        }
    }
}
