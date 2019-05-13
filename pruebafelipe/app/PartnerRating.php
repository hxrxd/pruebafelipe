<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartnerRating extends Model
{
    //
    protected $table = 'partner_ratings';

    protected $fillable = ['student', 'headquarter','space','desc_space','equipment','desc_equipment','location','community','team_time','capabilities','asses_capabilities','relationship','knowledge','transport','stipend','materials','trainings','permission','social_risk','ambiental_risk','desc_partner'];
    
    protected $primaryKey = 'id_partner_ratings';
}
