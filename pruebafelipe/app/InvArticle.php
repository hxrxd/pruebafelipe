<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvArticle extends Model
{
  //
  protected $table = 'inv_articles';

  protected $fillable = ['name', 'description','provider','status','stock','cost'];

  protected $primaryKey = 'id';
}
