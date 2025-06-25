# Telegram Notification System Setup Guide

This guide will help you set up the Telegram notification system for sending automated and manual notifications to invigilators.

## 🚀 Quick Setup (5 minutes)

### 1. Create a Telegram Bot

1. **Open Telegram** and search for `@BotFather`
2. **Start a chat** with BotFather
3. **Send the command**: `/newbot`
4. **Follow the prompts**:
   - Enter a name for your bot (e.g., "Exam Surveillance Bot")
   - Enter a username for your bot (must end with 'bot', e.g., "exam_surveillance_bot")
5. **Save the bot token** that BotFather gives you (looks like: `123456789:ABCdefGHIjklMNOpqrsTUVwxyz`)

### 2. Configure Environment Variables

Add this to your `.env` file:

```env
TELEGRAM_BOT_TOKEN=your_bot_token_here
```

### 3. Test the Connection

1. Go to your admin dashboard
2. Navigate to **Notifications**
3. Click **"Test Connection"**
4. You should see: "Telegram connection test successful! Bot: @your_bot_username"

### 4. Add Chat IDs for Invigilators

For each invigilator to receive notifications:

1. **Invigilator starts a chat** with your bot (@your_bot_username)
2. **Invigilator sends any message** to the bot (e.g., "Hello")
3. **Admin gets the chat ID** by visiting: `https://api.telegram.org/botYOUR_BOT_TOKEN/getUpdates`
4. **Admin adds the chat ID** to the invigilator's profile in the database

## 📋 Detailed Setup Instructions

### Step 1: Bot Creation

**What is a Telegram Bot?**
- A bot is an automated account that can send and receive messages
- It's free to create and use
- No API costs or rate limits

**Creating the Bot:**
```
1. Open Telegram app
2. Search for "@BotFather"
3. Click "Start"
4. Send: /newbot
5. Enter bot name: "Exam Surveillance System"
6. Enter bot username: "exam_surveillance_bot"
7. Copy the token: 123456789:ABCdefGHIjklMNOpqrsTUVwxyz
```

### Step 2: Environment Configuration

**Add to .env file:**
```env
TELEGRAM_BOT_TOKEN=123456789:ABCdefGHIjklMNOpqrsTUVwxyz
```

**Important:** Never share your bot token publicly!

### Step 3: Database Setup

The system automatically creates the necessary database tables. Run:

```bash
php artisan migrate
```

### Step 4: Getting Chat IDs

**Method 1: Using getUpdates API**
1. Ask invigilators to start a chat with your bot
2. Visit: `https://api.telegram.org/botYOUR_BOT_TOKEN/getUpdates`
3. Look for the "chat" object with "id" field
4. Copy the chat ID (it's a number like 123456789)

**Method 2: Using a simple script**
Create a file called `get_chat_id.php` in your project root:

```php
<?php
$botToken = 'YOUR_BOT_TOKEN_HERE';
$url = "https://api.telegram.org/bot{$botToken}/getUpdates";
$response = file_get_contents($url);
$data = json_decode($response, true);

echo "Recent chats:\n";
foreach ($data['result'] as $update) {
    if (isset($update['message'])) {
        $chat = $update['message']['chat'];
        echo "Name: {$chat['first_name']}";
        if (isset($chat['last_name'])) echo " {$chat['last_name']}";
        echo " | Chat ID: {$chat['id']}\n";
    }
}
```

Run: `php get_chat_id.php`

### Step 5: Adding Chat IDs to Database

**Option A: Direct Database Update**
```sql
UPDATE invigilators 
SET chat_id = '123456789' 
WHERE userID = 'INV001';
```

**Option B: Using Laravel Tinker**
```bash
php artisan tinker
```
```php
$invigilator = App\Models\Invigilator::where('userID', 'INV001')->first();
$invigilator->chat_id = '123456789';
$invigilator->save();
```

## 🔧 Testing the System

### 1. Test Bot Connection
- Go to Admin Dashboard → Notifications
- Click "Test Connection"
- Should show success message

### 2. Test Manual Notification
- Go to "Send Individual"
- Select an invigilator with chat ID
- Send a test message
- Check if invigilator receives it on Telegram

### 3. Test Bulk Notification
- Go to "Send Bulk"
- Select multiple invigilators
- Send a test message
- Verify all recipients get the message

## 📅 Automated Notifications

### Setting Up Automated Reminders

1. **Go to "Automated Settings"**
2. **Choose timing**: How many days before duty to send reminder
3. **Create templates** using variables:
   - `{invigilator_name}` - Invigilator's name
   - `{exam_date}` - Exam date (dd/mm/yyyy)
   - `{start_time}` - Start time
   - `{venue}` - Exam venue
   - `{role}` - Invigilator role

**Example Template:**
```
Title: Exam Duty Reminder for {invigilator_name}

Message: Dear {invigilator_name},

This is a reminder for your exam duty on {exam_date} ({exam_day}).

Details:
- Time: {start_time} - {end_time}
- Venue: {venue}
- Role: {role}
- Course: {course_code}
- Students: {total_students}

Please ensure you arrive 30 minutes before the start time.

Thank you!
```

### Running Automated Notifications

**For Development (Manual):**
```bash
php artisan notifications:send-automated
```

**For Production (Cron Job):**
Add to your server's crontab:
```bash
* * * * * cd /path/to/your/project && php artisan schedule:run >> /dev/null 2>&1
```

And in `app/Console/Kernel.php`:
```php
protected function schedule(Schedule $schedule)
{
    $schedule->command('notifications:send-automated')->everyMinute();
}
```

## 🛠️ Troubleshooting

### Common Issues

**1. "Telegram connection test failed"**
- Check if bot token is correct
- Ensure bot token is in .env file
- Verify internet connection

**2. "No Telegram chat ID" error**
- Invigilator hasn't started a chat with the bot
- Chat ID not added to database
- Check if chat ID is correct

**3. Messages not being sent**
- Check Laravel logs: `storage/logs/laravel.log`
- Verify bot has permission to send messages
- Ensure invigilator hasn't blocked the bot

**4. Automated notifications not working**
- Check if cron job is running
- Verify schedule_id is set correctly
- Check notification status in database

### Debug Commands

**Check bot info:**
```bash
curl "https://api.telegram.org/botYOUR_BOT_TOKEN/getMe"
```

**Check recent updates:**
```bash
curl "https://api.telegram.org/botYOUR_BOT_TOKEN/getUpdates"
```

**Test sending message:**
```bash
curl -X POST "https://api.telegram.org/botYOUR_BOT_TOKEN/sendMessage" \
     -H "Content-Type: application/json" \
     -d '{"chat_id":"CHAT_ID_HERE","text":"Test message"}'
```

## 📱 User Experience

### For Invigilators

1. **Start chat with bot**: Search for your bot username
2. **Send any message**: "Hello" or "Start"
3. **Receive notifications**: Automatic reminders and manual messages
4. **No app installation needed**: Works in Telegram web/app

### For Admins

1. **Easy management**: Web interface for all notifications
2. **Bulk sending**: Send to multiple invigilators at once
3. **Automated reminders**: Set up once, works automatically
4. **Delivery tracking**: See which messages were sent/failed

## 🔒 Security Considerations

- **Bot token**: Keep it secret, never commit to version control
- **Chat IDs**: These are public, but don't share unnecessarily
- **Rate limiting**: Telegram has generous limits, but be respectful
- **User consent**: Ensure invigilators agree to receive notifications

## 📊 Monitoring

### Check Notification Status

```sql
-- View all notifications
SELECT * FROM notifications ORDER BY created_at DESC;

-- Check failed notifications
SELECT * FROM notifications WHERE status = 'failed';

-- Count by status
SELECT status, COUNT(*) as count 
FROM notifications 
GROUP BY status;
```

### Log Files

Check Laravel logs for detailed error information:
```bash
tail -f storage/logs/laravel.log
```

## 🎉 Success!

Once set up, your system will:
- ✅ Send individual notifications instantly
- ✅ Send bulk notifications to multiple invigilators
- ✅ Automatically remind invigilators before duties
- ✅ Track delivery status
- ✅ Work reliably without external API costs

The Telegram system is much simpler than WhatsApp and provides a better user experience for both admins and invigilators! 