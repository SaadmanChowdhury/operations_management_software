<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserService
{

    protected $userModel;

    public function __construct(User $userModel)
    {
        $this->$userModel = $userModel;
    }

    public function fetchUserList()
    {

        $userModel  = new User;
        // Step 2
        $array = $userModel->readUserList();

        // Step 3
        $array = $this->helper_fetchUserList($array);

        // Step 4 and 5
        return $this->arrayFormatting_fetchUserList($array);
    }

    public function helper_fetchUserList($array)
    {
        $loggedUser = auth()->user();
        if ($loggedUser->user_authority == 'システム管理者') {
            // take your decision
            return $array;
        }

        for ($i = 0; $i < count($array); $i++) {
            // If user is not project leader [General user]
            if ($array[$i]->projectLeaderID != $loggedUser->user_id) {
                unset($array[$i]->unitPrice);
            }
        }

        return $array;
    }

    private function arrayFormatting_fetchUserList($array)
    {
        $formattedArray['user'] = $array;

        return $formattedArray;
    }
}
