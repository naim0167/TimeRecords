@extends('layouts.app')
@section('main')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <div class="card mt-3 p-3">
                <form action="/time_records/{{$time_record->id}}/update" method="POST">
                @csrf
                @method('put')
                <div class="form-group mt-2">
                    <label>Project: <b>{{$time_record->project->name }}</b> </label>
                    <select name="project_id" class="form-control mt-2" value="{{old('project_id')}}" required>
                        <option value="{{$time_record->project_id}}">{{$time_record->project->name}}</option>
                        @foreach($projects as $project)
                        <option value="{{$project->id}}"> {{$project->name}} </option>
                        @endForeach
                    </select>
                    @if($errors->has('project_id'))
                    <div class="text-danger">
                        {{ $errors->first('project_id') }}
                    </div>
                    @endif
                </div>

                <div class="form-group mt-2">
                    <label>Start Time</label>
                    <input type="datetime-local" name ="start_time" class="form-control" value="{{old('start_time', $time_record->start_time)}}">
                    @if($errors->has('start_time'))
                    <div class="text-danger">
                        {{ $errors->first('start_time') }}
                    </div>
                    @endif
                </div>
                <div class="form-group mt-2">
                    <label>End Time</label>
                    <input type="datetime-local" name ="end_time" class="form-control" value="{{old('end_time', $time_record->end_time)}}">
                    @if($errors->has('end_time'))
                    <div class="text-danger">
                        {{ $errors->first('end_time') }}
                    </div>
                    @endif
                </div>
                <a href="/" class="btn btn-dark">Back</a>
                <button class="btn btn-success" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
