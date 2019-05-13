<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvDetail extends Model
{
  //
  protected $table = 'inv_details';

  protected $fillable = ['purchase', 'article','inv_number','open_date','resp_target_number','employee','observations'];

  protected $primaryKey = 'id';
}
