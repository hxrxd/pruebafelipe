<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    //
    protected $table = 'families';

    protected $fillable = ['name', 'student','phone','relationship'];
    
    protected $primaryKey = 'id_families';
}
