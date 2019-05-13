<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DxEducation extends Model
{
    protected $table = 'dx_education';

    protected $fillable = ['percentage_math_test_approval_primary','percentage_math_test_approval_secondary', 'percentage_math_test_approval_diversified','percentage_reading_test_approval_primary', 'percentage_reading_test_approval_secondary', 'percentage_reading_test_approval_diversified', 'dx'];

    protected $primaryKey = 'id';
}
