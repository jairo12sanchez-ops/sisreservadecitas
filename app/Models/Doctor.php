<?php
namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = ['nombres', 'apellidos', 'telefono', 'licencia_medica', 'especialidad', 'user_id'];

    public function consultorio()
    {
        return $this->belongsTo(consultorio::class);
    }

    public function horarios()
    {
        return $this->hasMany(horarios::class);
    }
    public function user(){
    return $this->belongsTo(User::class,'users_id');
}

}
