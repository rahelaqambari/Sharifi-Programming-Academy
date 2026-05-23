<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'amount',
    ];
    //
       public function student(){
        return $this->belongsTo(Student::class);
    }

       public function sinf(){
        return $this->belongsTo(Sinf::class);
    }
}
