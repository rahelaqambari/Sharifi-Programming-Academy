<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    //
    protected $fillable = [
        'year',
        'month',
        'day',
        'amount',
        'teacher_id',
    ];
}
