<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';

    protected $fillable = ['title','description','message','type','email_emisor','email_receptor','token','seen','operation_type','operation_doc_id','operation_team_id','operation_user_id'];

    protected $primaryKey = 'id';
}
