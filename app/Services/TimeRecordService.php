<?php

namespace App\Services;

use App\Models\TimeRecord;

class TimeRecordService
{
    public function checkValidWorkTime($userId, $startTime)
    {
        return TimeRecord::where('user_id', $userId)
            ->whereRaw('? between start_time and end_time', [$startTime])
            ->count() > 0;
    }

    public function checkValidWorkTimeForUpdate($id, $userId, $startTime)
    {
        return TimeRecord::where('id', '!=', $id)
            ->where('user_id', $userId)
            ->whereRaw('? between start_time and end_time', [$startTime])
            ->count() > 0;
    }
}
