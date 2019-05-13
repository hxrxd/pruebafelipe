<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    //

    protected $table = 'contracts';

    protected $fillable = ['no', 'year','student','agreement','initd','date2','date3','date4','date5','endd','length','payments','grant','grantm'];
    
    protected $primaryKey = 'id_contracts';

}
