<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupervisorH extends Model
{
    //
    protected $table = 'supervisor_hs';

    protected $fillable = ['name', 'email','phone','place','student'];
    
    protected $primaryKey = 'id_supervisors_h';
}
