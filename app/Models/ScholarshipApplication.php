<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScholarshipApplication extends Model
{
    protected $fillable = [
        'scholarship_id',
        'name',
        'email',
        'phone',
        'semester',
        'ipk',
        'document_path',
        'status'
    ];

    public function scholarship()
    {
        return $this->belongsTo(Scholarship::class);
    }
}