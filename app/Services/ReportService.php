<?php
namespace App\Services;
use App\Models\TimeRecord;
use Illuminate\Support\Facades\DB;

class ReportService
{
    public function generateProjectReports()
    {
        return TimeRecord::select(
                'project_id', 
                DB::raw('SUM(TIMESTAMPDIFF(minute, start_time, end_time)) as minute'))
                ->groupBy('project_id')
                ->get();
    }

    public function generatePersonReports()
    {
        return DB::table('time_records')
                ->select('user_id', 'users.name', DB::raw('SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(end_time, start_time)))) AS total_hours'))
                ->join('users', 'time_records.user_id', '=', 'users.id')
                ->groupBy('user_id', 'users.name')
                ->get();
    }

    public function generateDailyReports()
    {
        return TimeRecord::select(
                DB::raw('YEAR(start_time) as year'),
                DB::raw('DATE(start_time) as day'),
                'project_id',
                DB::raw('SUM(TIMESTAMPDIFF(minute, start_time, end_time)) as minute')
            )
            ->groupBy('year','day', 'project_id')
            ->get();
    }

    public function generateMonthlyReports()
    {
        return TimeRecord::select(
                DB::raw('YEAR(start_time) as year'),
                DB::raw('MONTH(start_time) as month'),
                'project_id',
                DB::raw('SUM(TIMESTAMPDIFF(minute, start_time, end_time)) as minute')
            )
            ->groupBy('year', 'month', 'project_id')
            ->get();
    }

    public function convertTimeToHours($hours, $minutes)
    {
        return $hours + round($minutes / 60, 2);
    }

    public function calculateExtraWork($workingHours)
    {
        if ($workingHours < 0) {
            return 'Extra work of : ' . ($workingHours * -1);
        }
        return $workingHours;
    }
}