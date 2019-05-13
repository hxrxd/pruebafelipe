<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DxTerritory extends Model
{
    protected $table = 'dx_territory';

    protected $fillable = ['name', 'location', 'masl', 'surface', 'dx'];

    protected $primaryKey = 'id';
}
