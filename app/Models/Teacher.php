<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    //
    protected $fillable = [
        'last_name',
        'degree',
        'phone',
        'img_url',
        'bio',
        'user_id',
    ];
        public function user(){
        return $this->belongsTo(User::class);
    }

        public function salaries(){
        return $this->hasMany(Salary::class);
    }

        public function sinfs(){
        return $this->hasMany(Sinf::class);
    }
}
