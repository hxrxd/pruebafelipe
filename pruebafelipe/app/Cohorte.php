<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cohorte extends Model
{
    //
    protected $table = 'cohortes';

    protected $fillable = ['cohorte','status'];
    
    protected $primaryKey = 'id';
}
