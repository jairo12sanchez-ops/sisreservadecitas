<?php
use App\Models\Consultorio;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$consultorio = Consultorio::find(1);
if ($consultorio) {
    echo "Consultorio 1 exists: " . $consultorio->nombre;
} else {
    echo "Consultorio 1 DOES NOT EXIST";
}
