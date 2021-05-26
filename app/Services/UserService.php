<?php

namespace App\Services;

use App\Models\Employment;
use App\Models\Favorite;
use App\Models\Salary;
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
        $userModel  = new User();
        $favoriteModel  = new Favorite();
        $salaryModel  = new Salary();

        $usersList = $userModel->readUserList();

        foreach ($usersList as $user) {
            $user->isFavorite = $favoriteModel->isFavorite('user', $user->userID);
            $user->latestSalary = $salaryModel->getLatestSalary($user->userID);
        }

        $array = $this->helper_fetchUserList($usersList);

        return $this->arrayFormatting_fetchUserList($array);
    }

    public function helper_fetchUserList($array)
    {
        $loggedUser = auth()->user();
        if ($loggedUser->user_authority == 'システム管理者') {
            return $array;
        }

        for ($i = 0; $i < count($array); $i++) {
            // logged in user can see his/her salary
            // if ($loggedUser->user_id == $array[$i]->userID) {
            //     continue;
            // }
            $array[$i]->latestSalary = '';
        }
        return $array;
    }

    private function arrayFormatting_fetchUserList($array)
    {
        $formattedArray['user'] = $array;

        return $formattedArray;
    }

    public function readUser($id)
    {
        $userModel = new User();
        $favoriteModel = new Favorite();
        $salaryModel = new Salary();
        $employmentModel = new Employment();

        $data = $userModel->readUser($id);
        // from the perspective of the logged in user if that person is favorite
        $data[0]->isFavorite = $favoriteModel->isFavorite('user', $id);
        // getting the composite salary information
        $data[0]->compositeSalary = $salaryModel->getCompositeSalary($id);
        // getting the composite employment information
        $data[0]->compositeEmployment = $employmentModel->getCompositeEmployment($id);
        return $data;
    }
}
