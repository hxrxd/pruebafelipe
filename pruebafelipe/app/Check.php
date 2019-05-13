<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
    //
    protected $table = 'checks';

    protected $fillable = ['student','receipt','nocheck','grant','datein','datepay','dateout','desc'];
    
    protected $primaryKey = 'id_check';
}
