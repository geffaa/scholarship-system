<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scholarship extends Model
{
    protected $fillable = ['name', 'requirements', 'type'];

    public function applications()
    {
        return $this->hasMany(ScholarshipApplication::class);
    }
}