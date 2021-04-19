<?php

namespace App\Services;

use App\Models\Assign;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AssignService
{

    protected $assignModel;

    public function __construct(Assign $assignModel)
    {
        $this->$assignModel = $assignModel;
    }

    /**
     * this function returns the details of 
     *
     * @param [int] $user_id
     * @param [int] $year
     * @return array
     */
    public function getAssignedProjectsDetails($user_id, $year)
    {
        $projects_id = DB::table('assign')
            ->where('user_id', $user_id)
            ->where('year', $year)
            ->groupBy('project_id')->get('project_id')->toArray();

        // if the active user does not have any project
        if ($projects_id == null) {
            $project_assign_details = [];
            return $project_assign_details;
        }

        for ($i = 0; $i < count($projects_id); $i++) {
            $project_id = $projects_id[$i]->project_id;

            $project_object = DB::table('projects')
                ->where('project_id', $project_id)
                ->first('project_name');

            $project_name = $project_object->project_name;
            $project_assign_details[$i]['projectName'] = $project_name;

            $project_assign_details[$i]['assign'] = DB::table('assign')
                ->select('user_id', 'project_id', 'year', 'month', 'plan_man_month as assignValue')
                ->where('user_id', $user_id)
                ->where('year', $year)
                ->where('project_id', $project_id)
                ->get();
        }

        return $project_assign_details;
    }

    /**
     * this method returns the summary of each user's assigned project name and the 
     * details year, month and plan_man_month on the year basis
     *
     * @param [int] $year
     * @return array
     */
    public function assignSummary($year)
    {
        $main_array = [];
        $carbon = new Carbon("first day of January $year");
        $first_day_of_year = $carbon->toDateTimeString();

        $active_users  = DB::table('users')
            ->select('user_id')
            ->whereYear('admission_day', '<=', $first_day_of_year)
            ->whereYear('exit_day', '>=', $first_day_of_year)
            ->get();

        for ($i = 0; $i < count($active_users); $i++) {
            $user_id = $active_users[$i]->user_id;
            $user_name[$i] = DB::table('users')->where('user_id', $user_id)->first('name as userName');

            $user_name[$i]->projects = $this->getAssignedProjectsDetails($user_id, $year);
        }

        $main_array['user'] = $user_name;

        return $main_array;
    }

    public function activeUserCount($year)
    {
        $users_id = DB::table('users')->where('year', $year)->groupBy('user_id')->get('user_id');
    }
}
