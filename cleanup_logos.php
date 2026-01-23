<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\configuracione;
use Illuminate\Support\Facades\Storage;

echo "Cleaning up orphaned logs...\n";

// Get active logo
$config = configuracione::latest()->first();
$activeLogo = $config ? $config->logo : null;

// Normalize path (database stores 'logos/filename.jpg', storage is 'app/public/logos')
// We'll list files in 'public/logos'
$directory = 'public/logos';
$files = Storage::files($directory);

if (empty($files)) {
    echo "No files found in $directory.\n";
    exit;
}

$deletedCount = 0;

foreach ($files as $file) {
    // $file includes directory: 'public/logos/filename.jpg'
    // $activeLogo usually looks like 'logos/filename.jpg' or just 'filename.jpg' depending on how it was saved.
    // Let's compare basenames to be safe.
    
    $filename = basename($file);
    $activeBasename = $activeLogo ? basename($activeLogo) : null;
    
    if ($activeBasename && $filename === $activeBasename) {
        echo "KEEP: $filename (Active)\n";
    } else {
        echo "DELETE: $filename\n";
        Storage::delete($file);
        $deletedCount++;
    }
}

echo "Cleanup complete. Deleted $deletedCount files.\n";
