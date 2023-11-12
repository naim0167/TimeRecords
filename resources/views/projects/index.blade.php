@extends('layouts.timerecords')
@section('main')

<div class="container">
    <div class="text-right">
        <a class="btn btn-dark mt-2" href="/time_records/create">New Time Record</a>
        <a class="btn btn-dark mt-2" href="/projects/create">New project</a>
    </div>
    <h1>Projects Records</h1>

    <table class="table table-hover mt-3 text-center" id="myTable">
        <thead>
            <tr>
            <th>Serial</th>
            <th>Assigned by</th>
            <th>Project Name</th>
            <th>Work Hour</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projects as $project)
            <tr>
                <th>{{ $loop->index +1 }}</th>
                <td>{{ $project->user->name }}</td>
                <td>{{ $project->name }}</td>
                <td>{{ $project->workload }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
