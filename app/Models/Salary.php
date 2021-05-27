<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Salary extends Model
{
    use HasFactory;
    protected $primaryKey = 'salary_id';
    protected $table = 'salaries';

    protected $guarded = [];

    public function getCompositeSalary($user_id)
    {
        return DB::table('salaries')
            ->select(
                'salary_id as salaryID',
                'start_date as startDate',
                'end_date as endDate',
                'salary as salaryAmount',
            )
            ->where('user_id', $user_id)
            ->get();
    }

    public function getLatestSalary($user_id)
    {
        $data = Salary::select('salary')
            ->where('user_id', $user_id)
            ->orderBy('start_date', 'desc')
            ->first();
        return $data->salary;
    }

    // public function createCompositeSalary($compositeSalaryArray, $user_id)
    // {
    //     $newArray = [];
    //     foreach ($compositeSalaryArray as $compositeSalary) {
    //         $data = [
    //             'user_id' => $user_id,
    //             'start_date' => $compositeSalary['startDate'],
    //             'end_date' => $compositeSalary['endDate'],
    //             'salary' => $compositeSalary['salaryAmount'],
    //         ];
    //         array_push($newArray, $data);
    //     }

    //     return DB::table('salaries')->insert($newArray);
    // }

    public function upsertCompositeSalary($compositeSalaryArray, $user_id)
    {
        foreach ($compositeSalaryArray as $compositeSalary) {
            DB::table('salaries')
                ->updateOrInsert(
                    ['salary_id' => $compositeSalary['salaryID']], // condition
                    [
                        'user_id' => $user_id,
                        'start_date' => $compositeSalary['startDate'],
                        'end_date' => $compositeSalary['endDate'],
                        'salary' => $compositeSalary['salaryAmount'],
                    ] // values
                );
        }
    }
}
