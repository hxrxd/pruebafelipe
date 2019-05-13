<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $table = 'tasks';

    protected $fillable = ['description','start_date','deadline','duration','done','cost','objective','user_create','user_update'];

    protected $primaryKey = 'id';
}
