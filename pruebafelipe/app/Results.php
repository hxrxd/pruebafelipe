<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Results extends Model
{
    protected $table = 'results';

    protected $fillable = ['description','status'];

    protected $primaryKey = 'id';
}
