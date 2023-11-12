@extends('layouts.timerecords')
@section('main')

    <div class="container">
        
        <div class="text-right">
            <a class="btn btn-dark mt-2 bg-info" href="/reports/person">Show By Person</a>
            <a class="btn btn-dark mt-2 bg-danger" href="/reports/">Show By Projects</a>
            <a class="btn btn-dark mt-2 " href="/reports/monthly">Show By Month</a>
        </div>
        <h1>Daily Reports</h1>
        <table class="table table-hover mt-3 text-center">
            <thead>
                <tr>
                    <th>Serial</th>
                    <th>Date</th>
                    <th>Project Name</th>
                    <th>Hours Worked</th>
                    <th>Year</th>
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