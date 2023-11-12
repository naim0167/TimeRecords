@extends('layouts.timerecords')
@section('main')

<div class="container">
    <div class="text-right">
        <a class="btn btn-dark mt-2" href="/time_records/create">New Time Record</a>
        <a class="btn btn-dark mt-2" href="/projects/create">New project</a>
        <a class="btn btn-info mt-2" href="/reports/download">Download Report</a>
    </div>
    <h1>Entry Record</h1>

    <table class="table table-hover mt-3 text-center">
        <thead>
            <tr>
                <th>Serial</th>
                <th>Project Name</th>
                <th>Recorded by</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Total Hour</th>
                <th>Action</th>
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
                <a href="/time_records/{{$record->id}}/show"class="btn btn-success btn-sm">Show</a>
                <a href="/time_records/{{$record->id}}/edit" class="btn btn-dark btn-sm">Edit</a>
                <form action="/time_records/{{$record->id}}/delete" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                    <button class="btn btn-danger btn-sm" type="submit"><i class="fa-solid fa-trash"></i>Delete</button>
                </form>
            </td>
            </tr>
        </tbody>
        @endforeach
    </table>
</div>

@endsection