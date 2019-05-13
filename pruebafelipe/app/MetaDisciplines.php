<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetaDisciplines extends Model
{
    protected $table = 'meta_discipline';

    protected $fillable = ['metacarrer', 'academic','carrer', 'incharge'];
  
    protected $primaryKey = 'id';
}
