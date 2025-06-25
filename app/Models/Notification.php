<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'userID',
        'userName',
        'chat_id',
        'contact',
        'title',
        'message',
        'type', // 'manual', 'bulk'
        'status', // 'pending', 'sent', 'failed'
        'sent_at',
        'error_message',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
    ];

    public function invigilator()
    {
        return $this->belongsTo(Invigilator::class, 'userID', 'userID');
    }
} 