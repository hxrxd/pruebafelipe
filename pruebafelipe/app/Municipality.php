<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    protected $table = 'municipality';

    protected $fillable = ['id_departament', 'municipality'];
    
    protected $primaryKey = 'id_municipality';


}
