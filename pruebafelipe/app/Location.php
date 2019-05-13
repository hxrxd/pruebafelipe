<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Team;
use App\Location;
use DB;

class Location extends Model
{
    //
    protected $table = 'locations';

    protected $fillable = ['team', 'latitude','longitude'];

    protected $primaryKey = 'id';
}
