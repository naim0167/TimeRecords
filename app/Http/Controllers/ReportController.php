<?php

namespace App\Http\Controllers;

use App\Models\TimeRecord;
use App\Services\ReportService;

class ReportController extends Controller
{
    protected $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function index(){
        $timeRecords = $this->reportService->generateProjectReports();
        
        $timeRecords = $timeRecords->map(function ($record) {
            $hours = floor($record->minute / 60);
            $remainingMinutes = $record->minute % 60;
            $record->hours = sprintf("%02d:%02d", $hours, $remainingMinutes);

            $workingHours = $record->project->workload - $this->reportService->convertTimeToHours($hours, $remainingMinutes);
            
            $record->remainingHours = $this->reportService->calculateExtraWork($workingHours);

            return $record;
        });

        return view('reports.index', ['time_records'=>$timeRecords]);
    }    
    

    public function person(){
        $persons = $this->reportService->generatePersonReports();

        return view('reports.person', ['persons'=>$persons]);
    }    

    public function personReport($id){
        $timeRecords = TimeRecord::where('user_id', $id)->get();
        return view('reports.show', ['time_records'=>$timeRecords]);
    }

    public function daily(){
        $timeRecords = $this->reportService->generateDailyReports();

        $timeRecords = $timeRecords->map(function ($record) {
            $hours = floor($record->minute / 60);
            $remainingMinutes = $record->minute % 60;
            $record->hours = sprintf("%02d:%02d", $hours, $remainingMinutes);
            return $record;
        });

        return view('reports.daily', ['time_records'=>$timeRecords]);
    }

    public function monthly(){
        $timeRecords = $this->reportService->generateMonthlyReports();

        $timeRecords = $timeRecords->map(function ($record) {
            $hours = floor($record->minute / 60);
            $remainingMinutes = $record->minute % 60;
            $record->hours = sprintf("%02d:%02d", $hours, $remainingMinutes);

            $record->month =  date("F", mktime(0, 0, 0, $record->month, 1));

            return $record;
        });

        return view('reports.monthly', ['time_records'=>$timeRecords]);
    }
}
