<?php

namespace App\Services;

use App\Models\Employment;
use Carbon\Carbon;

class EmploymentSalaryService
{
    // checking if the employment date is set reversely or not
    public function employmentDateIsNotReverse($user_id)
    {
        $employmentModel = new Employment();
        $employments = $employmentModel->getCompositeEmployment($user_id);
        foreach ($employments as $employment) {
            $start_date =  $end_date = null;
            if (!is_null($employment->startDate)) {
                $start_date = Carbon::createFromFormat('Y-m-d',  $employment->startDate);
            }

            if (!is_null($employment->endDate)) {
                $end_date = Carbon::createFromFormat('Y-m-d',  $employment->endDate);
            }
            if ($end_date == null) {
                continue;
            }

            if ($start_date->gt($end_date)) {
                return false;
            }
        }
        return true;
    }
}
