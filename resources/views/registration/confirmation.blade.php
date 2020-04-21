@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row my-5 justify-content-center">

            <div class="col-sm-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-4">
                            <h4>Your Details</h4>
                            <strong>Name:</strong> {{ $student->title }} {{$student->forenames}} {{$student->surname}}
                            <br><br>
                            <strong>Address</strong><br>
                            {{ $student->home_address_1 }} <br>
                            {{ $student->home_address_2 }} <br>
                            {{ $student->city }}<br>
                            {{ $student->county }}<br>
                            {{ $student->postcode }}<br>
                            <br>
                            <strong>DOB: </strong>{{ $student->date_of_birth->format('d M Y') }}<br>
                        </div>

                        <div class="mb-4">
                            <h4>University</h4>
                            <strong>Name:</strong> {{ $student->university->name }} <br>
                            <strong>Entry Date:</strong> {{ $student->entry_date->format('d M Y') }} <br>
                        </div>

                        <div class="mb-4">
                            <h4>Placements</h4>
                            <table class="table table-striped">
                                @foreach($student->pharmacies as $pharmacy)
                                    <tr>
                                        <td>
                                            {{ $pharmacy->trading_name }} <br>
                                            {{ $pharmacy->address_1 }} <br>
                                            {{ $pharmacy->town }}<br>
                                            {{ $pharmacy->county }}, {{$pharmacy->post_code}}
                                        </td>
                                        <td>
                                            <strong>Start:</strong> {{ $pharmacy->pivot->placement_start->format('d M Y') }} <br>
                                            <strong>End:</strong> {{ $pharmacy->pivot->placement_end->format('d M Y') }} <br>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>

                        <div class="mb-4">
                            <h4>Tutors</h4>
                            <table class="table table-striped">
                                @foreach($student->pharmacists as $pharmacist)
                                    <tr>
                                        <td>
                                            {{ $pharmacist->title }} {{$pharmacist->forenames}} {{$pharmacist->surname}}<br>
                                        </td>
                                        <td>
                                            <strong>Start:</strong> {{ $pharmacist->pivot->tutor_start->format('d M Y') }} <br>
                                            <strong>End:</strong> {{ $pharmacist->pivot->tutor_end->format('d M Y') }} <br>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>

                            <form action="/registration" method="POST">
                                @csrf
                                <input type="hidden" name="current_step" value="confirmation">
                                <button class="btn btn-primary" type="submit">Confirm and Submit</button>
                            </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
@stop