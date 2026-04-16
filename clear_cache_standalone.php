<?php
/**
 * Standalone Cache Clearer - No Laravel Boot Required
 * Upload to server and access via browser
 */

echo "<h1>Clearing Laravel Caches...</h1>";

$basePath = __DIR__;

// 1. Clear route cache
echo "<h2>1. Route Cache</h2>";
$routeCache = $basePath . '/bootstrap/cache/routes.php';
if (file_exists($routeCache)) {
    if (unlink($routeCache)) {
        echo "✓ Deleted routes.php cache<br>";
    } else {
        echo "✗ Failed to delete routes.php<br>";
    }
} else {
    echo "ℹ No routes.php cache found<br>";
}

// 2. Clear view cache
echo "<h2>2. View Cache</h2>";
$viewCache = $basePath . '/storage/framework/views';
$count = 0;
if (is_dir($viewCache)) {
    $files = glob($viewCache . '/*');
    foreach ($files as $file) {
        if (is_file($file) && strpos($file, '.php') !== false) {
            if (unlink($file)) {
                $count++;
            }
        }
    }
}
echo "✓ Deleted $count compiled views<br>";

// 3. Clear config cache
echo "<h2>3. Config Cache</h2>";
$configCache = $basePath . '/bootstrap/cache/config.php';
if (file_exists($configCache)) {
    if (unlink($configCache)) {
        echo "✓ Deleted config.php cache<br>";
    } else {
        echo "✗ Failed to delete config.php<br>";
    }
} else {
    echo "ℹ No config.php cache found<br>";
}

// 4. Clear other caches
echo "<h2>4. Other Caches</h2>";
$cacheFiles = [
    '/bootstrap/cache/events.php',
    '/bootstrap/cache/packages.php',
    '/bootstrap/cache/services.php',
    '/storage/framework/cache/data/*',
];

foreach ($cacheFiles as $pattern) {
    $fullPath = $basePath . $pattern;
    if (strpos($pattern, '*') !== false) {
        // Handle wildcards
        $files = glob($fullPath);
        foreach ($files as $file) {
            if (is_file($file) && unlink($file)) {
                echo "✓ Deleted: " . basename($file) . "<br>";
            }
        }
    } elseif (file_exists($fullPath)) {
        if (unlink($fullPath)) {
            echo "✓ Deleted: " . basename($fullPath) . "<br>";
        }
    }
}

echo "<hr><h2>✓ All Caches Cleared!</h2>";
echo "<p><a href='/' style='font-size:18px; background:#8B4513; color:white; padding:10px 20px; text-decoration:none; border-radius:5px;'>Go to Homepage</a></p>";
echo "<p><small>If still failing, check if files were actually deleted above.</small></p>";
