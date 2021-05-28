<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Employment extends Model
{
    use HasFactory;
    protected $primaryKey = 'employment_id';
    protected $table = 'employments';

    protected $guarded = [];

    public function getCompositeEmployment($user_id)
    {
        return DB::table('employments')
            ->select(
                'employment_id as employmentID',
                'start_date as startDate',
                'end_date as endDate',
                'resignation_flag as isResign',
            )
            ->where('user_id', $user_id)
            ->whereNull("deleted_at")
            ->get();
    }

    // public function createCompositeEmployment($compositeEmploymentArray, $user_id)
    // {
    //     $newArray = [];
    //     foreach ($compositeEmploymentArray as $compositeEmployment) {
    //         $data = [
    //             'user_id' => $user_id,
    //             'start_date' => $compositeEmployment['startDate'],
    //             'end_date' => $compositeEmployment['endDate'],
    //             'resignation_flag' => $compositeEmployment['isResign'],
    //         ];
    //         array_push($newArray, $data);
    //     }

    //     return DB::table('employments')->insert($newArray);
    // }

    public function upsertCompositeEmployment($compositeEmploymentArray, $user_id)
    {
        foreach ($compositeEmploymentArray as $compositeEmployment) {
            DB::table('employments')
                ->updateOrInsert(
                    ['employment_id' => $compositeEmployment['employmentID']], // condition
                    [
                        'user_id' => $user_id,
                        'start_date' => $compositeEmployment['startDate'],
                        'end_date' => $compositeEmployment['endDate'],
                        'resignation_flag' => $compositeEmployment['isResign'],
                    ] // values
                );
        }
    }
}
