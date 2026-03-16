<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Paciente extends Model
{
    use HasRoles, HasFactory;
    protected $guard_name = 'web';

    public function historial(){
        return $this->hasMany(Historial::class);
    }
    public function pagos(){
        return $this->hasMany(Pago::class);
    }
}
