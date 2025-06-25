<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramService
{
    protected $botToken;
    protected $apiUrl;

    public function __construct()
    {
        $this->botToken = config('services.telegram.bot_token');
        $this->apiUrl = "https://api.telegram.org/bot{$this->botToken}";
    }

    /**
     * Send a Telegram message to a specific chat ID
     */
    public function sendMessage($chatId, $title, $message)
    {
        try {
            // Format the message
            $formattedMessage = $this->formatMessage($title, $message);

            $response = Http::post("{$this->apiUrl}/sendMessage", [
                'chat_id' => $chatId,
                'text' => $formattedMessage,
                'parse_mode' => 'HTML'
            ]);

            if ($response->successful()) {
                Log::info('Telegram message sent successfully', [
                    'chat_id' => $chatId,
                    'response' => $response->json()
                ]);
                return [
                    'success' => true,
                    'message_id' => $response->json('result.message_id'),
                    'response' => $response->json()
                ];
            } else {
                Log::error('Telegram API error', [
                    'chat_id' => $chatId,
                    'response' => $response->json(),
                    'status' => $response->status()
                ]);
                return [
                    'success' => false,
                    'error' => $response->json('description', 'Unknown error'),
                    'response' => $response->json()
                ];
            }
        } catch (\Exception $e) {
            Log::error('Telegram service error', [
                'chat_id' => $chatId,
                'error' => $e->getMessage()
            ]);
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Send bulk messages to multiple recipients
     */
    public function sendBulkMessages($recipients, $title, $message)
    {
        $results = [];
        
        foreach ($recipients as $recipient) {
            $result = $this->sendMessage($recipient['chat_id'], $title, $message);
            $results[] = [
                'userID' => $recipient['userID'],
                'userName' => $recipient['userName'],
                'chat_id' => $recipient['chat_id'],
                'result' => $result
            ];
        }

        return $results;
    }

    /**
     * Format message with HTML formatting
     */
    protected function formatMessage($title, $message)
    {
        return "<b>{$title}</b>\n\n{$message}\n\n<i>This is an automated message from Exam Surveillance System.</i>";
    }

    /**
     * Test the Telegram bot connection
     */
    public function testConnection()
    {
        try {
            $response = Http::get("{$this->apiUrl}/getMe");
            return $response->successful();
        } catch (\Exception $e) {
            Log::error('Telegram connection test failed', [
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * Get bot information
     */
    public function getBotInfo()
    {
        try {
            $response = Http::get("{$this->apiUrl}/getMe");
            if ($response->successful()) {
                return $response->json('result');
            }
            return null;
        } catch (\Exception $e) {
            return null;
        }
    }
} 