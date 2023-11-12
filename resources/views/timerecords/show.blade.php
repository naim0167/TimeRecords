@extends('layouts.timerecords')
@section('main')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-4 mt-2">
            <div class="card p-4 mt-5">
                <p> Project Name: <b>{{$time_record->project->name}}</b></p>
                <p> Start Time: <b>{{$time_record->start_time}}</b></p>
                <p> End Time: <b>{{$time_record->end_time}}</b></p>
                <p> Work Hour: <b>{{$time_record->total_hours}}</b></p>
                <p> Record Number : <b>{{$time_record->id}}</b></p>
                <p> Recorded by : <b>{{$time_record->user->name}}</b></p>
                <a href="/time_records" class="btn btn-dark">Back</a>
        </div>
    </div>
</div>
@endsection