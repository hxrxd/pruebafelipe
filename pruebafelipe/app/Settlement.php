<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settlement extends Model
{
    //
    protected $table = 'settlements';

    protected $fillable = ['no', 'year','student'];
    
    protected $primaryKey = 'id_settlements';
}
