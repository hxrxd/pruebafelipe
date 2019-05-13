<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DxEconomy extends Model
{
  protected $table = 'dx_economy';

  protected $fillable = ['description', 'poverty', 'poverty_extreme', 'income_per_family', 'observations', 'dx'];

  protected $primaryKey = 'id';
}
