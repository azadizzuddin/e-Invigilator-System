<?php
/**
 * Telegram Chat ID Helper Script
 * 
 * This script helps you get chat IDs for invigilators who have started a chat with your bot.
 * 
 * Usage:
 * 1. Make sure invigilators have started a chat with your bot
 * 2. Run: php get_chat_ids.php
 * 3. Copy the chat IDs and add them to your database
 */

// Load Laravel environment
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Get bot token from environment
$botToken = env('TELEGRAM_BOT_TOKEN');

if (!$botToken || $botToken === 'your_bot_token_here') {
    echo "❌ Error: Please set your TELEGRAM_BOT_TOKEN in the .env file\n";
    echo "Get your bot token from @BotFather on Telegram\n";
    exit(1);
}

echo "🤖 Getting chat IDs for bot: " . $botToken . "\n\n";

// Get updates from Telegram
$url = "https://api.telegram.org/bot{$botToken}/getUpdates";
$response = file_get_contents($url);

if (!$response) {
    echo "❌ Error: Could not connect to Telegram API\n";
    echo "Check your internet connection and bot token\n";
    exit(1);
}

$data = json_decode($response, true);

if (!isset($data['ok']) || !$data['ok']) {
    echo "❌ Error: " . ($data['description'] ?? 'Unknown error') . "\n";
    exit(1);
}

if (empty($data['result'])) {
    echo "📭 No recent chats found\n";
    echo "Ask invigilators to start a chat with your bot first\n";
    echo "They should search for your bot username and send any message\n";
    exit(0);
}

echo "📱 Recent chats found:\n";
echo str_repeat("-", 60) . "\n";

$chatIds = [];

foreach ($data['result'] as $update) {
    if (isset($update['message'])) {
        $chat = $update['message']['chat'];
        $chatId = $chat['id'];
        $firstName = $chat['first_name'] ?? '';
        $lastName = $chat['last_name'] ?? '';
        $username = $chat['username'] ?? '';
        $fullName = trim($firstName . ' ' . $lastName);
        
        // Avoid duplicates
        if (!in_array($chatId, $chatIds)) {
            $chatIds[] = $chatId;
            
            echo "👤 Name: " . ($fullName ?: 'Unknown') . "\n";
            if ($username) echo "   Username: @{$username}\n";
            echo "   Chat ID: {$chatId}\n";
            echo "   Type: " . ($chat['type'] ?? 'private') . "\n";
            echo str_repeat("-", 60) . "\n";
        }
    }
}

echo "\n💡 To add these chat IDs to your database:\n";
echo "1. Go to your admin dashboard\n";
echo "2. Find the invigilator by name\n";
echo "3. Update their chat_id field with the corresponding Chat ID\n";

echo "\nOr use this SQL command (replace with actual values):\n";
echo "UPDATE invigilators SET chat_id = 'CHAT_ID_HERE' WHERE userName = 'INVIGILATOR_NAME_HERE';\n";

echo "\n🔧 You can also use Laravel Tinker:\n";
echo "php artisan tinker\n";
echo "\$invigilator = App\\Models\\Invigilator::where('userName', 'INVIGILATOR_NAME')->first();\n";
echo "\$invigilator->chat_id = 'CHAT_ID_HERE';\n";
echo "\$invigilator->save();\n"; 