<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conf extends Model
{
    protected $table = 'conf';

    protected $fillable = ['act','datestart','dateend'];
    
    protected $primaryKey = 'description';
}
