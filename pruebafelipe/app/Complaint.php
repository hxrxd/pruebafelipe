<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    //
    protected $table = 'complaints';

    protected $fillable = ['student', 'supervisor','title_complaint','desc','tracing','solution','status'];
    
    protected $primaryKey = 'id_complaints';

}
