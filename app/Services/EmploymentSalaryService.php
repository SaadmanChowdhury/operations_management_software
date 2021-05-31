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
            if ($employment->startDate != null) {
                $start_date = Carbon::createFromFormat('Y-m-d',  $employment->startDate);
            }

            if ($employment->endDate != null) {
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

    public function employmentIsNotOverlap($user_id)
    {
        $employmentModel = new Employment();
        $employments = $employmentModel->getCompositeEmployment($user_id);
        // dd($employments);

        $parent_start_date = $parent_end_date = null;
        $child_start_date = $child_end_date = null;
        foreach ($employments as $employment) { // parent loop
            if ($employment->startDate != null) {
                $parent_start_date = Carbon::createFromFormat('Y-m-d',  $employment->startDate);
            }

            if ($employment->endDate != null) {
                $parent_end_date = Carbon::createFromFormat('Y-m-d',  $employment->endDate);
            }

            // the child loop counter
            for ($i = 0; $i < count($employments); $i++) { // child loop
                //ignore the loop if parent and child is same (for all other values)
                if ($employment->employmentID == $employments[$i]->employmentID) {
                    continue;
                }

                // setting the child values
                if ($employments[$i]->startDate != null) {
                    $child_start_date = Carbon::createFromFormat('Y-m-d',  $employments[$i]->startDate);
                }

                if ($employments[$i]->endDate != null) {
                    $child_end_date = Carbon::createFromFormat('Y-m-d',  $employments[$i]->endDate);
                }

                //IF both employment interval's endDate is null
                if ($parent_end_date == null && $child_end_date == null) {
                    //Throw Overlapped Error, Throw MultipleNull error
                    return false;
                }

                //IF parent-loop's employment endDate is null 
                if ($parent_end_date == null) {
                    //IF child-loop endDate is after parent-loop startDate
                    if ($child_end_date->gt($parent_start_date)) {
                        return false;
                    }
                }

                //IF child-loop's employment endDate is null
                if ($child_end_date == null) {
                    continue;
                }

                //Check if start date of child-loop employment is inside parent-loop employment
                //IF ( Std-E_L < Std-E_X) && ( End-E_L > Std-E_X )
                if (
                    ($parent_start_date->lt($child_start_date)) &&
                    ($parent_end_date->gt($child_start_date))
                ) {
                    return false;
                }
            } // end of child loop
        } // end of parent loop
        return true;
    }
} // end of EmploymentSalaryService class
