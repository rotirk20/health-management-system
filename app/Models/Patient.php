<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'city',
        'age',
        'address',
        'city',
        'phone',
        'email'
    ];

    public function appointments() {
        return $this->belongsToMany(Patient::class, 'appointments')->withPivot('appointment');
    }
}
