@extends('layouts.timerecords')
@section('main')

    <div class="container">
        <div class="text-right">
            <a class="btn btn-dark mt-2 bg-danger" href="/reports/">Show By Projects</a>
            <a class="btn btn-dark mt-2 " href="/reports/daily">Show By date</a>
            <a class="btn btn-dark mt-2 " href="/reports/monthly">Show By Month</a>
        </div>
        <h1>Person Reports</h1>
        <table class="table table-hover mt-3 text-center" id="myTable">
            <thead>
                <tr>
                    <th>Serial</th>
                    <th>Username</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($persons as $person)
                <tr>
                    <th>{{ $loop->index +1 }}</th>
                    <td>{{ $person->name }}</td>
                    <td>
                        <a href="/reports/person/{{$person->user_id}}/show"class="btn btn-info btn-sm">Report</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
