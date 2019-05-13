<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DxDemography extends Model
{
    protected $table = 'dx_demography';

    protected $fillable = ['description','population_0_to_14', 'population_15_to_64','population_65_or_more', 'population_women', 'population_men', 'population_rural', 'population_urban', 'population_indigenous', 'population_garifuna', 'population_xinca','dx'];

    protected $primaryKey = 'id';
}
