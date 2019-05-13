<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObjectiveResult extends Model
{
    protected $table = 'objectives_results';

    protected $fillable = ['amount','description','cuantitative','result','objective'];

    protected $primaryKey = 'id';
}
