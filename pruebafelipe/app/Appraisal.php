<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appraisal extends Model
{
    //
    protected $table = 'appraisals';

    protected $fillable =['student', 'age','supervisor','journey','civil_status','economic_activity','comunication','desc_comunication','type_comunication','lapse_comunication','understandable_comunication','respect_communication','fulfillment','assess_comunication','accompaniment','interest','assess_advisory','type_advisory','resolution','assess_accompaniment','assess_mono','assess_convivencia','assess_multi','assess_wp','assess_dx','respect','understandable','cooperation','amiability','assess_supervisor','complaint','desc_appraisals','name_student'];

    protected $primaryKey = 'id_appraisals';
}
