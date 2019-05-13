<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkingPlan extends Model
{
    protected $table = 'working_plan';

    protected $fillable = ['team','cohort','status','observations'];

    protected $primaryKey = 'id';
}
