<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CivilStatus extends Model
{
    //
    protected $table = 'civil_statuses';

    protected $fillable = ['status'];
    
    protected $primaryKey = 'id';
}
