<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    //
    protected $table = 'receipts';

    protected $fillable = ['no', 'year','student','contract','initd','endd','payments','grant','grantm','engagement'];
    
    protected $primaryKey = 'id_receipts';
}
