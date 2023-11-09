<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\TimeRecord;
use App\Rules\OverlappingTimeRecords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class TimeRecordController extends Controller
{
    public function index(){
        $timeRecords = TimeRecord::get();
        return view('timerecords.index', ['time_records'=>$timeRecords]);
    }

    public function create(){
        if(empty(Project::count())){
            return back()->withError('Please add a project first.');
        }
        return view('timerecords.create', ['projects'=>Project::get()]);
    }

    public function store(Request $request){
        $messages = [
            'project_id' => 'Please select a project',
        ];
        $validatedData = $request->validate([
            'project_id' => ['required', 'integer'],
            'start_time' =>  ['required', 'date_format:Y-m-d\TH:i'],
            'end_time' => ['required', 'date_format:Y-m-d\TH:i', 'after_or_equal:start_time'],
        ], $messages);

        $validWorkTime = TimeRecord::query()
        ->whereRaw('? between start_time and end_time', [$request->start_time])
        ->count();

        if ($validWorkTime > 0) {
            return back()->withError('An entry already exist between this hours.');
        }

        $this->validateStartTime($request->start_time);
        $timeRecord = new TimeRecord;
        $timeRecord->fill($validatedData);
        $timeRecord->save();

        return back()->withSuccess('The Entry has been added!');
    }

    
    public function edit($id){
        return view('timerecords.edit', [
            'time_record' =>TimeRecord::where('id', $id)->first(), 
            'projects'=>Project::get()]);
    }
    
    public function update(Request $request, $id){
        $messages = [
            'project_id' => 'Please select a project',
        ];

        $validatedData = $request->validate([
            'project_id' => ['required', 'integer'],
            'start_time' =>  ['required', 'date_format:Y-m-d\TH:i'],
            'end_time' => ['required', 'date_format:Y-m-d\TH:i', 'after_or_equal:start_time'],
        ], $messages);

        $validWorkTime = TimeRecord::query()
            ->where('id', '!=' , $id)
            ->whereRaw('? between start_time and end_time', [$request->start_time])
            ->count();


        if ($validWorkTime > 0) {
            return back()->withError('An entry already exist between this hours.');
        }

        $timeRecord = TimeRecord::where('id', $id)->first();
        $timeRecord->fill($validatedData);
        $timeRecord->save();

        return back()->withSuccess('The Entry has been updated!');
    }
    
    public function show($id){
        $timeRecord = TimeRecord::where('id', $id)->first();
        return view('timerecords.show', ['time_record' =>$timeRecord]);
    }

    public function destroy($id){
        $timeRecord = TimeRecord::where('id', $id)->first();
        $timeRecord->delete();
        return back()->withSuccess('Entry Deleted successfully.');
    }

}
