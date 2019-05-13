<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workplan extends Model
{
    protected $table = 'workplans';

    protected $fillable = ['objective_what','objective_what_for', 'amount','goal','quality','time','result','project'];

    protected $primaryKey = 'id';
}
