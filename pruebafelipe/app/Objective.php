<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objective extends Model
{
    protected $table = 'objectives';

    protected $fillable = ['objective','activities','results','results_ids','hits','failures','isGroup','objective_corrections','status','student','project','user_create','user_update'];

    protected $primaryKey = 'id';
}
