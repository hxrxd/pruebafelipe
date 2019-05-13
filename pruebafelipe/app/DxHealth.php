<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DxHealth extends Model
{
    protected $table = 'dx_health';

    protected $fillable = ['rate_access_primary_health_care', 'rate_diseases_by_contaminated_water', 'rate_chronic_malnutrition', 'diseases', 'dx'];

    protected $primaryKey = 'id';
}
