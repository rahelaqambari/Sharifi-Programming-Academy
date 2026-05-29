<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    protected $fillable = [
        'last_name',
        'img_url',
        'phone',
        'tazkira',
        'user_id',
    ];
        public function user(){
        return $this->belongsTo(User::class);
    }
       public function sinfs(){
        return $this->belongsToMany(Sinf::class,'sinf_id');
    }

        public function payment(){
        return $this->hasMany(Payment::class);
    }
}
