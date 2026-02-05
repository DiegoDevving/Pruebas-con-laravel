<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bloodtype extends Model
{
    //Relacion uno a muchos
    public function patients(){
        return $this->hasMany(Patient::class);
    }

    // ESTA LÍNEA ES LA CLAVE:
    protected $table = 'blood_types';

    protected $fillable = ['name'];


}
