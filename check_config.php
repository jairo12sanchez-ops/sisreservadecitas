<?php
use App\Models\Configuracion;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $count = \DB::table('configuraciones')->count();
    echo "Configuraciones count: " . $count . "\n";
    if ($count == 0) {
        echo "Table is empty.\n";
    } else {
        $conf = \DB::table('configuraciones')->first();
        print_r($conf);
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
