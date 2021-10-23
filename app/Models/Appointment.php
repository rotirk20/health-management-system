<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment',
        'doctor_id',
        'patient_id',
        'code'
    ];

    protected $dates = ['appointment'];

    public function patients()
    {
        return $this->belongsToMany(Patient::class, 'appointments', 'id', 'patient_id');
    }

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, 'appointments', 'id', 'doctor_id');
    }

    public function files()
    {
    	return $this->hasMany(File::class);
    }
}
