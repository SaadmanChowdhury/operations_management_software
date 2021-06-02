<?php

namespace App\Services;

use App\Models\Employment;
use App\Models\Favorite;
use App\Models\Salary;
use App\Models\User;
// use Illuminate\Http\Request as Rq;

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

    public function upsertUser($request)
    {
        $userModel = new User();
        $salaryModel = new Salary();
        $employmentModel = new Employment();
        $loggedUser = auth()->user();

        // $data = $this->getDummyData();
        // $request = new Rq($data);

        $createdOrUpdatedUserId = $userModel->upsertUser($request);

        //only admin can change the salary and the employment
        if ($loggedUser->user_authority == 'システム管理者') {
            $salaryModel->upsertCompositeSalary($request->compositeSalary, $createdOrUpdatedUserId);
            $employmentModel->upsertCompositeEmployment($request->compositeEmployment, $createdOrUpdatedUserId);
        }
        return ['userID' => $createdOrUpdatedUserId];
    }

    // created for testing upsertUser function
    public function getDummyData()
    {
        $rules = [
            // 'userID' => 15,
            'userCode' => 'roy01',
            'userName' => 'Roy',
            'email' => 'roy@gmail.com',
            'password' => '1212',
            'gender' => '1',
            'location' => '宮崎',
            'tel' => '266845',
            'position' => 'PG',
            'employeeClassification' => 'full time',
            'affiliationID' => null,
            'emergencyContact' => '',
            'condition1' => '',
            'condition2' => '',
            'locker' => '',
            'userAuthority' => 'システム管理者',
            'remarks' => 'dummy',
        ];



        $rules['compositeSalary'][0] = [
            'salaryID' => 1,
            'startDate' => '2091-05-04',
            'endDate' => '2021-05-14',
            'salaryAmount' => 200,
        ];
        $rules['compositeSalary'][1] = [
            'salaryID' => null,
            'startDate' => '2021-05-04',
            'endDate' => '2021-05-14',
            'salaryAmount' => 999,
        ];

        $rules['compositeEmployment'][0] = [
            'employmentID' => null,
            'startDate' => '1111-06-04',
            'endDate' => '2021-06-17',
            'isResign' => '1',
        ];

        return $rules;
    }
}
