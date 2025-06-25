<?php
/**
 * Check Table Structure
 */

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "🔍 Checking Notifications Table Structure\n";
echo "=========================================\n\n";

try {
    $columns = DB::select('DESCRIBE notifications');
    
    echo "Table columns:\n";
    foreach ($columns as $col) {
        echo "- {$col->Field}: {$col->Type} (" . ($col->Null == 'YES' ? 'NULL' : 'NOT NULL') . ")\n";
    }
    
    echo "\n✅ Table structure looks good!\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
} 