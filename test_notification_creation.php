<?php
/**
 * Test Notification Creation
 * 
 * This script tests creating a notification record to ensure the contact field issue is fixed.
 */

// Load Laravel environment
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "🧪 Testing Notification Creation\n";
echo "================================\n\n";

try {
    // Test creating a notification record
    $notification = App\Models\Notification::create([
        'userID' => 'TEST001',
        'userName' => 'Test User',
        'chat_id' => '1871585935',
        'contact' => null, // This should work now
        'title' => 'Test Notification',
        'message' => 'This is a test notification to verify the fix.',
        'type' => 'manual',
        'status' => 'pending',
    ]);

    echo "✅ Notification created successfully!\n";
    echo "ID: {$notification->id}\n";
    echo "User: {$notification->userName}\n";
    echo "Chat ID: {$notification->chat_id}\n";
    echo "Status: {$notification->status}\n";

    // Clean up - delete the test record
    $notification->delete();
    echo "\n🧹 Test record cleaned up.\n";

    echo "\n🎉 The contact field issue is fixed!\n";
    echo "You can now send notifications through the admin panel.\n";

} catch (Exception $e) {
    echo "❌ Error creating notification: " . $e->getMessage() . "\n";
    echo "\n🔧 The contact field issue is still present.\n";
} 