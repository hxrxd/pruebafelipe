<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = ['name','location','description','justification','objective','type','student','team','cohort','line','stakeholders','startdate','deadline','file_path','edit_flag','status','budget'];

    protected $primaryKey = 'id';
}
