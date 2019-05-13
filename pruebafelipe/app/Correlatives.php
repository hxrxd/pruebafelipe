<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Correlatives extends Model
{
    //
    protected $table = 'correlatives';

    protected $fillable = ['no', 'year','subject','to','description','email'];
    
    protected $primaryKey = 'id';
}
