<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Practice extends Model
{
    //
    protected $table = 'practices';

    protected $fillable = ['practice', 'practicea'];
    
    protected $primaryKey = 'id';
    
}
