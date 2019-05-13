<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequerimentsAssignment extends Model
{
    protected $table = 'requeriments_assignment';

    protected $fillable = ['headquarter','meta_discipline','academic_unit','cohorte','id_supervisors','value'];
    
    protected $primaryKey = 'id';
}
