<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    protected $table = 'students';

    protected $fillable = ['dpi','dpiw','name','fsurname','ssurname','birthdate','cstatus','gender','carne','carrer','academicu','email','personalp','homep','adressr','adressrw','municipalityr','municipalityb','practice','headquarter','initd','endd','cohorte','length','payments','grant','grantm','financing','rev','nationality','status'];
    
    protected $primaryKey = 'id_student';
}
