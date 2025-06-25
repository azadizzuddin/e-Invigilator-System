<?php
/**
 * Test Notification Script
 * 
 * This script tests sending a Telegram notification to your chat ID.
 */

// Load Laravel environment
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "🧪 Testing Telegram Notification\n";
echo "================================\n\n";

// Your chat ID
$chatId = '1871585935';

// Create Telegram service
$telegramService = new App\Services\TelegramService();

echo "Sending test message to chat ID: {$chatId}\n";

// Send test message
$result = $telegramService->sendMessage(
    $chatId,
    'Test Notification',
    "Hello! This is a test message from your Exam Surveillance System.\n\nIf you receive this, your Telegram integration is working perfectly! 🎉"
);

if ($result['success']) {
    echo "✅ Message sent successfully!\n";
    echo "Message ID: {$result['message_id']}\n";
    echo "\n🎉 Your Telegram notification system is working!\n";
} else {
    echo "❌ Failed to send message: {$result['error']}\n";
    echo "\n🔧 Troubleshooting:\n";
    echo "1. Make sure you haven't blocked the bot\n";
    echo "2. Check if the chat ID is correct\n";
    echo "3. Verify your bot token is correct\n";
} 