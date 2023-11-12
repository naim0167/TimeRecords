@extends('layouts.timerecords')
@section('main')
    <div class="container">
        <div class="text-right">
            <a class="btn btn-dark mt-2 " href="/reports/daily">Show By date</a>
            <a class="btn btn-dark mt-2 " href="/reports/">Show By Projects</a>
        </div>
        <h1>Monthly Reports</h1>
        <table class="table table-hover mt-3 text-center">
            <thead>
                <tr>
                <th scope="col">Serial</th>
                <th scope="col">Month</th>
                <th scope="col">Project Name</th>
                <th scope="col">Hours Worked</th>
                <th scope="col">Year</th>
                </tr>
            </thead>
            @foreach($time_records as $record)
            <tbody>
                <tr>
                <th>{{ $loop->index +1 }}</th>
                <td>{{ $record->month}}</td>
                <td>{{ $record->project->name }}</td>
                <td>{{ $record->hours }}</td>
                <td>{{ $record->year}}</td>
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>

@endsection
