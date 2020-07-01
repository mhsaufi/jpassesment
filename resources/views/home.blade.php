@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Companies</div>

                <div class="card-body">
                    <a href="{{ url('employee') }}">View Employees</a><br><br>
                    <a href="{{ url('company') }}">View Companies</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection