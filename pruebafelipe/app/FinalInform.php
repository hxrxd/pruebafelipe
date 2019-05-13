<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinalInform extends Model
{
    protected $table = 'final_inform';

    protected $fillable = ['methodology','direct_users','indirect_users','project'];

    protected $primaryKey = 'id';
}
