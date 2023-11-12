<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(){
        $projects = Project::get();
        return view('projects.index', ['projects' => $projects]);
    }

    public function create(Request $request){
        return view('projects.create',['user'=>User::where('id', $request->user()->id)->first()]);
    }

    public function store(Request $request){
        $validateData = $request->validate([
            'user_id' => ['required', 'integer'],
            'name' =>  ['required', 'string'],
            'workload' => 'required'
        ]);

        $project = new Project;
        $project->fill($validateData);
        $project->save();

        return back()->withSuccess('The Project has been added!');
    }
}
