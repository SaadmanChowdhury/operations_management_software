<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Assign extends Model
{
    use HasFactory;

    protected $table = 'assign';

    protected $guarded = [];

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

    public function upsertAssign($data)
    {
        // //all the assign id which has been updated or created
        $assignIdArray = [];

        foreach ($data as $key => $value) {
            $assign_id = $value['assign_id'];
            $project_id = $value['project_id'];
            $user_id = $value['user_id'];
            $year = $value['year'];
            $month = $value['month'];
            $execution = $value['execution'];

            if ($assign_id == null) {
                $new_id = Assign::create([
                    'project_id' => $project_id,
                    'user_id' => $user_id,
                    'year' => $year,
                    'month' => $month,
                    'execution' => $execution,
                ])->id;

                array_push($assignIdArray, $new_id);
            } else {
                Assign::where('assign_id', $assign_id)->update([
                    'project_id' => $project_id,
                    'user_id' => $user_id,
                    'year' => $year,
                    'month' => $month,
                    'execution' => $execution,
                ]);
                array_push($assignIdArray, $assign_id);
            }
        } //end of foreach loop

        return $assignIdArray;
    }
}
