<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupervisorU extends Model
{
    //
    protected $table = 'supervisor_us';

    protected $fillable = ['name', 'email','phone','academic','student'];
    
    protected $primaryKey = 'id_supervisors_u';
}
