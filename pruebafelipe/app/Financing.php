<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Financing extends Model
{
    //
    protected $table = 'financings';

    protected $fillable = ['name', 'noname','nameincharge','charge','item','itemw'];
    
    protected $primaryKey = 'id_financings';
}
