<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agreement extends Model
{
    //
    protected $table = 'agreement';

    protected $fillable = ['agreement_n', 'agreement_w','date_n','date_w'];

    protected $primaryKey = 'id_agreement';
}
