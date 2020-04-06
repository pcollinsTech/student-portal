@extends('layouts.app')

@section('content')

    <pharmacy-acceptance :student='@json($student)' placement_start="{{ $placement_start }}"></pharmacy-acceptance>

@endsection
