<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogTeam extends Model
{
    protected $table = 'log_teams';

    protected $fillable = ['type','activity','description','user','team','objective','working_plan','project'];

    protected $primaryKey = 'id';
}
