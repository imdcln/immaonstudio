<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    protected $table = "genders";
    protected $fillable = ['gender'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
