<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(){
        $projects = Project::get();
        return view('projects.index', ['projects' => $projects]);
    }

    public function create(){
        return view('projects.create');
    }

    public function store(Request $request){
        
        $validateData = $request->validate([
            'name' => 'required|string',
            'workload' => 'required'
        ]);

        $project = new Project;
        $project->fill($validateData);
        $project->save();

        return back()->withSuccess('The Project has been added!');
    }
}
