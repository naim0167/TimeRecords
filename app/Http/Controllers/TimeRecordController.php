<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Models\TimeRecord;
use Illuminate\Http\Request;
use App\Services\TimeRecordService;

class TimeRecordController extends Controller
{
    protected $timeRecordService;

    public function __construct(TimeRecordService $timeRecordService)
    {
        $this->timeRecordService = $timeRecordService;
    }

    public function index(){
        $timeRecords = TimeRecord::get();
        return view('timerecords.index', ['time_records'=>$timeRecords]);
    }

    public function create(Request $request){
        if(empty(Project::count())){
            return back()->withError('Please add a project first.');
        }
        return view('timerecords.create', [
            'projects'=>Project::get(),
            'user'=>User::where('id', $request->user()->id)->first()
        ]);
    }

    public function store(Request $request){
        $validatedData = $this->validateTimeRecord($request);

        if ($this->timeRecordService->checkValidWorkTime($request->user_id, $request->start_time)) {
            return back()->withError('An entry already exists between these hours.');
        }

        $timeRecord = new TimeRecord;
        $timeRecord->fill($validatedData);
        $timeRecord->save();

        return back()->withSuccess('The Entry has been added!');

    }
    
    public function edit(Request $request, $id){
        return view('timerecords.edit', [
            'time_record' =>TimeRecord::where('id', $id)->first(), 
            'projects'=>Project::get(),
            'user'=>User::where('id', $request->user()->id)->first()
        ]);
    }
    
    public function update(Request $request, $id){
        $validatedData = $this->validateTimeRecord($request);

        if ($this->timeRecordService->checkValidWorkTimeForUpdate($id, $request->user_id, $request->start_time)) {
            return back()->withError('An entry already exists between these hours.');
        }

        $timeRecord = TimeRecord::findOrFail($id);
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

    private function validateTimeRecord(Request $request) {
        return $request->validate([
            'project_id' => ['required', 'integer'],
            'user_id' => ['required', 'integer'],
            'start_time' =>  ['required', 'date_format:Y-m-d\TH:i'],
            'end_time' => ['required', 'date_format:Y-m-d\TH:i', 'after_or_equal:start_time'],
        ], [
            'project_id.required' => 'Please select a project',
        ]);
    }


}
