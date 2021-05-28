<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Estimate extends Model
{
    use HasFactory;
    protected $primaryKey = 'estimate_id';
    protected $table = 'estimates';

    protected $guarded = [];

    public function getEstimateOfProject($project_id)
    {
        return DB::table('estimates')
            ->select(
                'estimate_id as estimateID',
                'estimate_code as estimateCode',
                'estimate_status as estimateStatus',
                'estimate_cost as estimateCost',
            )
            ->where('project_id', $project_id)
            ->whereNull("deleted_at")
            ->get();
    }
}
