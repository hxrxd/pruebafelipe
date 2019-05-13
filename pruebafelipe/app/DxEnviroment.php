<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DxEnviroment extends Model
{
    protected $table = 'dx_enviroment';

    protected $fillable = ['forest_cover_rate', 'num_plans_integral_management_solid_waste', 'land_use_rate', 'dx'];

    protected $primaryKey = 'id';
  }
