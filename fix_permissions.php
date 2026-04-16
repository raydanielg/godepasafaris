<?php
// Fix Laravel Storage Permissions Script
// Run this from the project root directory

$storagePath = __DIR__ . '/storage';
$bootstrapPath = __DIR__ . '/bootstrap/cache';

echo "Fixing Laravel permissions...\n";

// Function to chmod recursively
function chmodRecursive($path, $filePerm = 0644, $dirPerm = 0755) {
    if (!file_exists($path)) {
        echo "Path does not exist: $path\n";
        return;
    }
    
    if (is_file($path)) {
        chmod($path, $filePerm);
        echo "Fixed file: $path\n";
        return;
    }
    
    if (is_dir($path)) {
        chmod($path, $dirPerm);
        echo "Fixed directory: $path\n";
        
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );
        
        foreach ($iterator as $item) {
            if ($item->isDir()) {
                chmod($item->getPathname(), $dirPerm);
            } else {
                chmod($item->getPathname(), $filePerm);
            }
        }
    }
}

// Fix storage directory
if (file_exists($storagePath)) {
    echo "\n=== Fixing storage directory ===\n";
    chmodRecursive($storagePath, 0664, 0775);
}

// Fix bootstrap/cache directory  
if (file_exists($bootstrapPath)) {
    echo "\n=== Fixing bootstrap/cache directory ===\n";
    chmodRecursive($bootstrapPath, 0664, 0775);
}

echo "\n=== Clearing caches ===\n";

// Clear view cache
$viewsCache = $storagePath . '/framework/views';
if (file_exists($viewsCache)) {
    $files = glob($viewsCache . '/*');
    foreach ($files as $file) {
        if (is_file($file)) {
            unlink($file);
            echo "Deleted: $file\n";
        }
    }
}

// Clear compiled services
$compiledPath = $storagePath . '/framework/cache';
if (file_exists($compiledPath)) {
    $files = glob($compiledPath . '/*.php');
    foreach ($files as $file) {
        if (is_file($file)) {
            unlink($file);
            echo "Deleted cache: $file\n";
        }
    }
}

echo "\nPermissions fixed!\n";
echo "Run: php artisan config:clear\n";
echo "Run: php artisan cache:clear\n";
echo "Run: php artisan view:clear\n";
