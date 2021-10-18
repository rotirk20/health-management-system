<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'city',
        'phone',
        'email',
        'title',
        'password'
    ];

    protected $hidden = [
        'password'
    ];

    public function appointments() {
        return $this->belongsToMany(Doctor::class, 'appointments')->withPivot('appointment');
    }
}
