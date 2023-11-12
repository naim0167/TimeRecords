@extends('layouts.timerecords')
@section('main')

    <div class="container">
        
        <div class="text-right">
            <a class="btn btn-dark mt-2 bg-info" href="/reports/person">Show By Person</a>
            <a class="btn btn-dark mt-2 " href="/reports/daily">Show By date</a>
            <a class="btn btn-dark mt-2 " href="/reports/monthly">Show By Month</a>
        </div>
        <h1>Project Reports</h1>
        <table class="table table-hover mt-3 text-center" id="myTable">
            <thead>
                <tr>
                    <th>Serial</th>
                    <th>Project Name</th>
                    <th>Workload (Hrs.)</th>
                    <th>Hours Worked</th>
                    <th>Workload Remaining</th>
                </tr>
            </thead>
            <tbody>
                @foreach($time_records as $record)
                <tr>
                    <th>{{ $loop->index +1 }}</th>
                    <td>{{ $record->project->name }}</td>
                    <td>{{ $record->project->workload }}</td>
                    <td>{{ $record->hours }}</td>
                    <td>{{ $record->remainingHours }} (hrs.)</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
