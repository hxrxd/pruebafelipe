<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DxMunicipalManagement extends Model
{
    protected $table = 'dx_municipal_management';

    protected $fillable = ['municipal_management_index', 'dx'];

    protected $primaryKey = 'id';
}
