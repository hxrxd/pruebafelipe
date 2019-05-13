<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Headquarters extends Model
{
    //
    protected $table = 'headquarters';

    protected $fillable = ['name', 'nameincharge','charge','phone','team','status'];
    
    protected $primaryKey = 'id_headquarters';
}
