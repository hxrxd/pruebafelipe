<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Engagement extends Model
{
    //
    protected $table = 'engagements';

    protected $fillable = ['no', 'year','student','agreement','initd','endd','length','payments','grant','grantm','contract'];
    
    protected $primaryKey = 'id_engagement';
}
