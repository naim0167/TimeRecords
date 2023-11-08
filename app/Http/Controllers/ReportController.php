<?php

namespace App\Http\Controllers;

use App\Models\TimeRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(){
        $timeRecords = TimeRecord::select(
            'project_id', 
            DB::raw('SUM(TIMESTAMPDIFF(minute, start_time, end_time)) as minute')
        )
            ->groupBy('project_id')
            ->get();
        
        $timeRecords = $timeRecords->map(function ($record) {
            $hours = floor($record->minute / 60);
            $remainingMinutes = $record->minute % 60;
            $record->hours = sprintf("%02d:%02d", $hours, $remainingMinutes);

            $workingHours = ($record->project->workload) - ($this->convert($hours, $remainingMinutes));            
            
            $record->remainingHours = $this->extraWork($workingHours);

            return $record;
        });
        return view('reports.index', ['time_records'=>$timeRecords]);
    }    
    
    public function daily(){
        $timeRecords = TimeRecord::select(
            DB::raw('YEAR(start_time) as year'),
            DB::raw('DATE(start_time) as day'),
            'project_id',
            DB::raw('SUM(TIMESTAMPDIFF(minute, start_time, end_time)) as minute')
        )
        ->groupBy('year','day', 'project_id')
        ->get();

        $timeRecords = $timeRecords->map(function ($record) {
            $hours = floor($record->minute / 60);
            $remainingMinutes = $record->minute % 60;
            $record->hours = sprintf("%02d:%02d", $hours, $remainingMinutes);
            return $record;
        });

        return view('reports.daily', ['time_records'=>$timeRecords]
        );
    }

    public function monthly(){
        $timeRecords = TimeRecord::select(
            DB::raw('YEAR(start_time) as year'),
            DB::raw('MONTH(start_time) as month'),
            'project_id',
            DB::raw('SUM(TIMESTAMPDIFF(minute, start_time, end_time)) as minute')
        )
        ->groupBy('year', 'month', 'project_id')
        ->get();
    
        $timeRecords = $timeRecords->map(function ($record) {
            $hours = floor($record->minute / 60);
            $remainingMinutes = $record->minute % 60;
            $record->hours = sprintf("%02d:%02d", $hours, $remainingMinutes);

            $record->month =  date("F", mktime(0, 0, 0, $record->month, 1));

            return $record;
        });

        return view('reports.monthly', ['time_records'=>$timeRecords]);
    }
    
    private function convert($hours, $minutes) {
        return $hours + round($minutes / 60, 2);
    }
    
    private function extraWork ($workingHours){        
        if($workingHours < 0 ){
            return 'Extra work of : ' .($workingHours * -1);
        }
        return $workingHours;
    }
    
    public function download(){
        $entryReportData = TimeRecord::get();
        $reportFilePath = storage_path('app/report.csv');
        $handle = fopen($reportFilePath, 'w');
        fputcsv($handle, ['Serial', 'Project Name', 'Start Time', 'End Time']); 
        foreach ($entryReportData as $row) {
            fputcsv($handle, [
                $row->id, 
                $row->project->name, 
                $row->start_time, 
                $row->end_time
            ]);
        }
        
        fclose($handle);
    
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="report.csv"',
        ];
    
        return response()->download($reportFilePath, 'report.csv', $headers);
    }
}
