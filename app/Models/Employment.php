<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employment extends Model
{
    use HasFactory;
    protected $primaryKey = 'employment_id';
    protected $table = 'employments';

    protected $guarded = [];
}
