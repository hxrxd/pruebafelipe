<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObjectiveForPlan extends Model
{
    protected $table = 'plan_objectives';

    protected $fillable = ['plan','objective','user_create','user_update'];

    protected $primaryKey = 'id';
}
