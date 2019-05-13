<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diagnostic extends Model
{
    protected $table = 'diagnostics';

    protected $fillable = ['introduction', 'objective','team', 'cohort', 'file_path', 'user_create', 'user_update', 'edit_flag', 'editing'];

    protected $primaryKey = 'id';
}
