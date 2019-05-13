<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatrixPlanning extends Model
{
    protected $table = 'matrix_planning';

    protected $fillable = ['index','level','narrative_summary','indicators','means_of_verification','assumptions','source_info','collection_method','analysis_method','collection_frequency','responsible','status','working_plan','user_create','user_update'];

    protected $primaryKey = 'id';
}
