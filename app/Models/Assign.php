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
            ->select('assign_id as assignID', 'year', 'month', 'plan_man_month as value')
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
            ->select('user_id')
            ->where('assign.project_id', $projectID)
            ->groupBy('assign.user_id')
            ->get()->count();
    }

    public function upsertAssign($data)
    {
        //deleting all the existing data in the assign table 
        $project_id_to_delete = intval($data[0]['project_id']);
        DB::table('assign')->where('project_id', $project_id_to_delete)->delete();

        // //all the assign id which has been updated or created
        $assignIdArray = [];

        foreach ($data as $key => $value) {
            $assign_id = $value['assign_id'];
            $project_id = $value['project_id'];
            $user_id = $value['user_id'];
            $year = $value['year'];
            $month = $value['month'];
            $plan_man_month = $value['plan_man_month'];

            //not storing the row if the plan_man_month value is zero
            if (floatval($plan_man_month) == 0) {
                continue;
            }

            // if ($assign_id == null) {
            $new_id = Assign::create([
                'project_id' => $project_id,
                'user_id' => $user_id,
                'year' => $year,
                'month' => $month,
                'plan_man_month' => $plan_man_month,
            ])->id;

            // array_push($assignIdArray, $new_id);
            // } else {
            //     Assign::where('assign_id', $assign_id)->update([
            //         'project_id' => $project_id,
            //         'user_id' => $user_id,
            //         'year' => $year,
            //         'month' => $month,
            //         'plan_man_month' => $plan_man_month,
            //     ]);
            //     array_push($assignIdArray, $assign_id);
            // }
        } //end of foreach loop

        //creating project object
        $projectObj = new Project;

        //get gross profit of the project
        $projectProfit = $projectObj->getProjectProfit($project_id);

        //get profit percentage of the project
        $profitPercentage = $projectObj->getProjectProfitPercentage($project_id);

        //creating array for the return data
        $returnArray = [];
        $returnArray['grossProfit'] = $projectProfit;
        $returnArray['profitPercentage'] = $profitPercentage;
        return $returnArray;
    }
}
