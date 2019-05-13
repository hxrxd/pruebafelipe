<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    //
    protected $table = 'statuses';

    protected $fillable = ['student', 'stationery','contract','budget','toaim1','toaim2','conta','pay','notice'];
    
    protected $primaryKey = 'id';
    
}
