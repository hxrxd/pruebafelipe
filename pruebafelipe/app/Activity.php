<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activities';

    protected $fillable = ['activity','time', 'status','startdate','deadline','workplan'];

    protected $primaryKey = 'id';
}
