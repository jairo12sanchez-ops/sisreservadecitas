<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuracione extends Model
{
    use HasFactory;

    public function getLogoUrlAttribute()
    {
        $dynamicPath = storage_path('app/public/' . $this->logo);
        if ($this->logo && file_exists($dynamicPath)) {
            return \Illuminate\Support\Facades\Storage::url($this->logo);
        }
        return asset('assets/img/logo_empresa_odoes.jpeg');
    }
}
