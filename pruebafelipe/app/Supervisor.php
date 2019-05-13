<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    //
    protected $table = 'supervisors';

    protected $fillable = ['name', 'iduser','phone','region'];
    
    protected $primaryKey = 'id_supervisors';
}
