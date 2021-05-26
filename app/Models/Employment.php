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
            ->get();
    }
}
