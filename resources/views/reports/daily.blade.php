@extends('layouts.app')
@section('main')

    <div class="container">
        
        <div class="text-right">
            <a class="btn btn-dark mt-2 " href="/reports/monthly">Show By Month</a>
            <a class="btn btn-dark mt-2 " href="/reports/">Show By Projects</a>
        </div>
        <h1>Daily Reports</h1>
        <table class="table table-hover mt-3 text-center">
            <thead>
                <tr>
                <th scope="col">Serial</th>
                <th scope="col">Date</th>
                <th scope="col">Project Name</th>
                <th scope="col">Hours Worked</th>
                <th scope="col">Year</th>
                </tr>
            </thead>
            @foreach($time_records as $record)
            <tbody>
                <tr>
                <th>{{ $loop->index +1 }}</th>
                <td>{{ $record->day }}</td>
                <td>{{ $record->project->name }}</td>
                <td>{{ $record->hours }}</td>
                <td>{{ $record->year }}</td>                
                </tr>
            </tbody>
            @endforeach
        </table>

    </div>

@endsection