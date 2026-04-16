<?php
/**
 * Emergency Laravel Fix Script
 * Run this via browser or CLI
 */

echo "<h1>Emergency Laravel Fix</h1>";

// 1. Check PHP temp directory
echo "<h2>1. PHP Temp Directory</h2>";
$tempDir = sys_get_temp_dir();
echo "Temp Dir: $tempDir<br>";
echo "Writable: " . (is_writable($tempDir) ? 'YES' : 'NO') . "<br>";

// 2. Check disk space
echo "<h2>2. Disk Space</h2>";
$free = disk_free_space("/");
$total = disk_total_space("/");
echo "Free: " . round($free / 1024 / 1024 / 1024, 2) . " GB<br>";
echo "Total: " . round($total / 1024 / 1024 / 1024, 2) . " GB<br>";

// 3. Fix storage permissions
echo "<h2>3. Fixing Storage Permissions</h2>";
$storagePath = __DIR__ . '/storage';
$cachePath = __DIR__ . '/bootstrap/cache';

function fixPermissions($path, $filePerm = 0664, $dirPerm = 0775) {
    if (!file_exists($path)) {
        mkdir($path, $dirPerm, true);
        echo "Created: $path<br>";
    }
    
    chmod($path, $dirPerm);
    
    if (is_dir($path)) {
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
    echo "Fixed permissions: $path<br>";
}

try {
    fixPermissions($storagePath);
    fixPermissions($cachePath);
    echo "<span style='color:green'>Permissions fixed!</span><br>";
} catch (Exception $e) {
    echo "<span style='color:red'>Error: " . $e->getMessage() . "</span><br>";
}

// 4. Create necessary directories
echo "<h2>4. Creating Directories</h2>";
$dirs = [
    'storage/framework/cache',
    'storage/framework/views',
    'storage/framework/sessions',
    'storage/logs',
    'storage/app/public',
    'bootstrap/cache',
];

foreach ($dirs as $dir) {
    $fullPath = __DIR__ . '/' . $dir;
    if (!file_exists($fullPath)) {
        mkdir($fullPath, 0775, true);
        echo "Created: $dir<br>";
    }
}

// 5. Create custom temp directory
echo "<h2>5. Custom Temp Directory</h2>";
$customTemp = __DIR__ . '/storage/tmp';
if (!file_exists($customTemp)) {
    mkdir($customTemp, 0777, true);
    echo "Created custom temp: $customTemp<br>";
}

// 6. Clear compiled views
echo "<h2>6. Clearing Compiled Views</h2>";
$viewsCache = __DIR__ . '/storage/framework/views';
if (file_exists($viewsCache)) {
    $files = glob($viewsCache . '/*');
    $count = 0;
    foreach ($files as $file) {
        if (is_file($file) && strpos($file, '.php') !== false) {
            unlink($file);
            $count++;
        }
    }
    echo "Deleted $count compiled views<br>";
}

// 7. Create .user.ini for PHP settings
echo "<h2>7. PHP Configuration</h2>";
$userIni = __DIR__ . '/.user.ini';
$iniContent = "upload_tmp_dir = " . $customTemp . "\n";
$iniContent .= "sys_temp_dir = " . $customTemp . "\n";
$iniContent .= "session.save_path = " . $customTemp . "\n";

if (file_put_contents($userIni, $iniContent)) {
    echo "Created .user.ini with custom temp dir<br>";
} else {
    echo "Failed to create .user.ini<br>";
}

echo "<hr><h2>Done!</h2>";
echo "<p>Refresh your site now. If still failing, contact your hosting provider about disk space or temp directory permissions.</p>";
echo "<p><a href='/' style='font-size:18px;'>Go to Homepage</a></p>";
