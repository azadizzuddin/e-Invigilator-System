<?php
/**
 * Debug Relationships
 * 
 * This script checks the relationships between schedules and invigilators.
 */

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\SurveillanceTimetable;
use App\Models\Invigilator;

echo "🔍 Debugging Schedule-Invigilator Relationships\n";
echo "===============================================\n\n";

// Check upcoming schedules and their invigilators
$upcomingSchedules = SurveillanceTimetable::where('examDate', '>=', now()->toDateString())
    ->where('examDate', '<=', now()->addDays(7)->toDateString())
    ->get();

echo "Upcoming schedules:\n";
foreach ($upcomingSchedules as $schedule) {
    echo "- Date: {$schedule->examDate}\n";
    echo "  Invigilator: {$schedule->userName} (ID: {$schedule->userID})\n";
    
    // Check if invigilator exists in invigilators table
    $invigilator = Invigilator::where('userID', $schedule->userID)->first();
    if ($invigilator) {
        echo "  ✅ Found in invigilators table\n";
        echo "  Chat ID: " . ($invigilator->chat_id ?: 'Not set') . "\n";
    } else {
        echo "  ❌ Not found in invigilators table\n";
    }
    echo "\n";
}

echo "All invigilators with chat IDs:\n";
$invigilatorsWithChatId = Invigilator::whereNotNull('chat_id')->get();
foreach ($invigilatorsWithChatId as $invigilator) {
    echo "- {$invigilator->userName} (ID: {$invigilator->userID}) - Chat ID: {$invigilator->chat_id}\n";
} 