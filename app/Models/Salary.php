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
}
