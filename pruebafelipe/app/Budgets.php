<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Budgets extends Model
{
    protected $table = 'budgets';

    protected $fillable = ['amount','description','unit_cost','meassurement','project','user_create','user_update'];

    protected $primaryKey = 'id';
}
