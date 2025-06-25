<?php
/**
 * Add Chat ID Script
 * 
 * This script helps you add a Telegram chat ID to an invigilator record.
 */

// Load Laravel environment
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "🤖 Adding Chat ID to Invigilator\n";
echo "================================\n\n";

// Your chat ID from the previous script
$chatId = '1871585935';
$userName = 'letmekms'; // Your Telegram name

echo "Looking for invigilator with name: {$userName}\n";

// Try to find invigilator by name
$invigilator = App\Models\Invigilator::where('userName', 'LIKE', "%{$userName}%")->first();

if (!$invigilator) {
    echo "❌ No invigilator found with name containing '{$userName}'\n";
    echo "\nAvailable invigilators:\n";
    
    $allInvigilators = App\Models\Invigilator::all();
    if ($allInvigilators->count() > 0) {
        foreach ($allInvigilators as $inv) {
            echo "- {$inv->userName} (ID: {$inv->userID})\n";
        }
    } else {
        echo "No invigilators found in database.\n";
    }
    
    echo "\n💡 You can:\n";
    echo "1. Create a new invigilator record through admin panel\n";
    echo "2. Or update an existing one with your name\n";
    exit(1);
}

echo "✅ Found invigilator: {$invigilator->userName} (ID: {$invigilator->userID})\n";

// Check if chat_id already exists
if ($invigilator->chat_id) {
    echo "⚠️  Chat ID already exists: {$invigilator->chat_id}\n";
    echo "Do you want to update it? (y/n): ";
    $handle = fopen("php://stdin", "r");
    $line = fgets($handle);
    fclose($handle);
    
    if (trim(strtolower($line)) !== 'y') {
        echo "Operation cancelled.\n";
        exit(0);
    }
}

// Update the chat_id
$invigilator->chat_id = $chatId;
$invigilator->save();

echo "✅ Successfully updated chat ID for {$invigilator->userName}\n";
echo "Chat ID: {$chatId}\n";

echo "\n🎉 You can now receive Telegram notifications!\n";
echo "Test it by going to Admin Dashboard → Notifications → Send Individual\n"; 