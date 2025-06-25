<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveillanceTimetable extends Model
{
    use HasFactory;

    protected $fillable = [
        'userID',
        'userName',
        'position',
        'faculty',
        'role',
        'examDate',
        'examDay',
        'startTime',
        'startTimeAMPM',
        'endTime',
        'endTimeAMPM',
        'programCode',
        'courseCode',
        'group',
        'totalStudent',
        'venue'
    ];

    public function invigilator() {
        return $this->belongsTo(Invigilator::class, 'userID', 'userID');
    }

}
