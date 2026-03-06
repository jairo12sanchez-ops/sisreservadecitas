<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuracione extends Model
{
    use HasFactory;

    public function getLogoUrlAttribute()
    {
        if ($this->logo && \Illuminate\Support\Facades\Storage::disk('public')->exists($this->logo)) {
            return \Illuminate\Support\Facades\Storage::url($this->logo);
        }
        return asset('assets/img/logo empresa odoes.jpeg');
    }
}
