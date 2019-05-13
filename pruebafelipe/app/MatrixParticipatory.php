<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatrixParticipatory extends Model
{
    protected $table = 'matrix_participatory';

    protected $fillable = ['direct_users','indirect_users','excluded_neutral','harmed','direct_descript','indirect_descript','excluded_descript','harmed_descript','status','working_plan','user_create','user_update'];

    protected $primaryKey = 'id';
}
