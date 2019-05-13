<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    //
    protected $table = 'teams';

    protected $fillable = ['name', 'municipality','financing','supervisor','status'];
    
    protected $primaryKey = 'id_team';
}
