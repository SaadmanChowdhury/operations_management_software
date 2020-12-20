<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Assign extends Model
{
    use HasFactory;

    protected $table = 'assign';

    public function getAssignInfo($projectID, $memberID)
    {
        return DB::table('assign')
            ->select('assign_id as assignID', 'year', 'month', 'execution as value')
            ->where('assign.project_id', $projectID)
            ->where('assign.user_id', $memberID)
            ->get();
    }

    public function getMemberId($projectID)
    {
        return DB::table('assign')
            ->select('user_id as memberID')
            ->where('assign.project_id', $projectID)
            ->groupBy('assign.user_id')
            ->get();
    }

    public function getCountOfMembers($projectID)
    {
        return DB::table('assign')
            ->where('assign.project_id', $projectID)
            ->groupBy('assign.user_id')
            ->count();
    }
}
