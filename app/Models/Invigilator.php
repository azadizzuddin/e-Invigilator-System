<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invigilator extends Model
{
    use HasFactory;

    protected $table = 'invigilators'; // for invigilator table in MySQL database

    protected $fillable = [
        'userID',
        'userPassword',
        'userName',
        'position',
        'faculty',
        'contact',
        'chat_id' // Telegram chat ID
    ];

    public function schedules()
    {
        return $this->hasMany(SurveillanceTimetable::class, 'userID', 'userID');
    }
}
