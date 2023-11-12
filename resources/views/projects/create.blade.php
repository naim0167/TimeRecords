@extends('layouts.timerecords')
@section('main')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <div class="card mt-3 p-3">
                <form action="/projects/store" method="POST">
                @csrf
                <h3>Add Project</h3>
                <div class="form-group mt-2">
                    <label>Project Name</label>
                    <input type="text" name ="name" class="form-control" value="{{old('name')}}">
                    @if($errors->has('name'))
                    <div class="text-danger">
                        {{ $errors->first('name') }}
                    </div>
                    @endif
                </div>
                <div class="form-group mt-2">
                    <label>Workload (Hours)</label>
                    <input type="number" name ="workload" class="form-control" value="{{old('workload')}}">
                    @if($errors->has('workload'))
                    <div class="text-danger">
                        {{ $errors->first('workload') }}
                    </div>
                    @endif
                </div>
                <div class="form-group mt-2">
                    <h6>Current user : <label class="bg-info text-white d-inline text-align-right">{{$user->name}}</label></h6>
                    <input type="hidden" name ="user_id" class="form-control" value="{{$user->id}}">
                </div>
                <a href="/projects" class="btn btn-dark">Back to Projects</a>
                <button class="btn btn-success" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection