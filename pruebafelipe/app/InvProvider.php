<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvProvider extends Model
{
  //
  protected $table = 'inv_providers';

  protected $fillable = ['name', 'nit','phone','email','status'];

  protected $primaryKey = 'id';
}
