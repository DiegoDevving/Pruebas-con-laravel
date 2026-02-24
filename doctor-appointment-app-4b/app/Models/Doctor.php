<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'specialty_id',
        'medical_license_number',
        'biography'
    ];

    // Relación: El doctor pertenece a un Usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación: El doctor pertenece a una Especialidad
    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }
}
