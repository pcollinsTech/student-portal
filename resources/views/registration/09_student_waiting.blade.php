@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row my-5">

        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">

                    <p> Name: {{ $student->title }} {{$student->forenames}} {{$student->surname}}
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="card">
                <div class="card-body">
                    <p>Status: Awaiting Pharmacy Approval...
                </div>
            </div>
        </div>
    </div>

    <div class="row my-5 d-flex justify-content-center">
        <div class="col-6 d-flex justify-content-between ">
            <a class="navbar-brand" href="{{ url('/pharmacy-acceptance') }}">
            <button class="btn btn-primary">See Pharmacy Acceptance Email</button>
            </a>
            <a class="navbar-brand" href="{{ url('/pharmacist-acceptance') }}">
            <button class="btn btn-primary">See Tutor Acceptance Email</button>
            </a>
        </div>
    </div>
</div>
@stop