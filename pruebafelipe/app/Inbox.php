<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{
    //
    protected $table = 'inboxes';

    protected $fillable = ['no', 'year','datein','sender','message','subject','observation','status','rev','processing','email'];
    
    protected $primaryKey = 'id_inbox';
}
