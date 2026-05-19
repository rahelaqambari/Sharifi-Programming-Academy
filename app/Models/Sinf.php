<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sinf extends Model
{
    //
        public function payment(){
        return $this->hasMany(Payment::class);
    }
       public function students(){
        return $this->belongsTo(Student::class,'student_id');
    }
       public function teacher(){
        return $this->belongsTo(Teacher::class);
    }
    

}
