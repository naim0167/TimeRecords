@extends('layouts.timerecords')
@section('main')

    <div class="container">
        <div class="text-right">
            <a class="btn btn-dark mt-2 bg-info" href="/reports/person">Show By Person</a>
            <a class="btn btn-dark mt-2 bg-danger" href="/reports/">Show By Projects</a>
            <a class="btn btn-dark mt-2 " href="/reports/daily">Show By date</a>
            <a class="btn btn-dark mt-2 " href="/reports/monthly">Show By Month</a>
        </div>
        <h1>Personal Reports</h1>
        <table class="table table-hover mt-3 text-center">
            <thead>
                <tr>
                    <th>Serial</th>
                    <th>Project Name</th>
                    <th>Recorded by</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Total Hour</th>
                </tr>
            </thead>
            @foreach($time_records as $record)
            <tbody>
                <tr>
                    <th>{{ $loop->index +1 }}</th>
                    <td>{{ $record->project->name }}</td>
                    <td>{{ $record->user->name }}</td>
                    <td>{{ $record->start_time }}</td>
                    <td>{{ $record->end_time }}</td>
                    <td>{{ $record->total_hours }}</td>
                    <td> 
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>

@endsection
