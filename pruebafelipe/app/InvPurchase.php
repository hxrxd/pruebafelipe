<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvPurchase extends Model
{
  //
  protected $table = 'inv_purchases';

  protected $fillable = ['number', 'oc_no','pdate','value','user','provider'];

  protected $primaryKey = 'id';
}
