<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $table = "classes";
    protected $fillable = ['class'];

    public function users()
    {
        return $this->hasMany(User::class, 'class_id');
    }
}

