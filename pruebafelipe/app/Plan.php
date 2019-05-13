<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table = 'plan';

    protected $fillable = ['month','nmonth','experiences','validated','status','num_correction','experiences_corrections','student','team','cohort','user_create','user_update','updated_at'];

    protected $primaryKey = 'id';
}
