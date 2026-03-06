<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuracione extends Model
{
    use HasFactory;

    public function getLogoUrlAttribute()
    {
        $logoPath = $this->logo;
        if ($logoPath && \Illuminate\Support\Facades\Storage::disk('public')->exists($logoPath)) {
            return url('storage/' . $logoPath);
        }
        return url('assets/img/logo_empresa_odoes.jpeg');
    }
}
