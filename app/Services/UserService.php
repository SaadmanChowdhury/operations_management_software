<?php

namespace App\Services;

use App\Models\Employment;
use App\Models\Favorite;
use App\Models\Salary;
use App\Models\User;
use Illuminate\Http\Request as Rq;

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

    public function updateUser($request)
    {
        $userModel = new User();
        $salaryModel = new Salary();
        $employmentModel = new Employment();
        $loggedUser = auth()->user();

        //validating data
        // $validatedData = $request->validated();
        $data = $this->getDummyData();
        $request = new Rq($data);
        $id = $request->userID;

        //create user or update user
        //if $id is null then we will create create new user
        if ($id == null) {
            //we are creating new user and inserting data in the user table
            $new_user_id = $userModel->createNewUser($request);
            //we are create composite salary and insert data in the table
            $salaryModel->createCompositeSalary($request->compositeSalary, $new_user_id);
            //we are create composite employment and insert data in the table
            $employmentModel->createCompositeEmployment($request->compositeEmployment, $new_user_id);
        }

        dd('create done for new user');
        //else we will update the data

        //if the password has been changed -> hashing password
        if ($request->password != null) {
            $validatedData['password'] = bcrypt($request->password);
        } else {
            // the password is not changed, so setting the old password
            $data = User::select('password')->where('user_id', $id)->first();
            $oldPassword = $data->password;
            $validatedData['password'] = $oldPassword;
        }

        //if the logged in user is general user then he/she will not be able to change the unit_price
        if ($loggedUser->user_authority != 'システム管理者') {
            unset($validatedData['unit_price']);
        }

        //changing the array key name from id to user_id
        $validatedData['user_id'] = $validatedData['id'];
        unset($validatedData['id']);

        //updating record
        User::where('user_id', $id)->update($validatedData);
    }

    public function getDummyData()
    {
        $rules = [
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
            'remark' => 'dummy',
        ];



        $rules['compositeSalary'][0] = [
            'salaryID' => null,
            'startDate' => '2021-05-04',
            'endDate' => '2021-05-14',
            'salaryAmount' => 200,
        ];
        $rules['compositeSalary'][1] = [
            'salaryID' => null,
            'startDate' => '2021-05-04',
            'endDate' => '2021-05-14',
            'salaryAmount' => 200,
        ];

        $rules['compositeEmployment'][0] = [
            'employmentID' => null,
            'startDate' => '2021-06-04',
            'endDate' => '2021-06-17',
            'isResign' => '1',
        ];

        return $rules;
    }
}
