@extends('layouts.app')
@section('main')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <div class="card mt-3 p-3">
                <form action="/projects/store" method="POST">
                @csrf
                <div class="form-group mt-2">
                    <label>Name</label>
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
                <a href="/projects" class="btn btn-dark">Back to Projects</a>
                <button class="btn btn-success" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection