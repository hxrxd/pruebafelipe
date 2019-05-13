<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departament extends Model
{
    //
    protected $table = 'departament';

    protected $fillable = ['departament'];

    protected $primaryKey = 'id_departament';

}
