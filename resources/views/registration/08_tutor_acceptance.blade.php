@extends('layouts.app')

@section('content')

    <tutor-acceptance :student='@json($student)' placement_start="{{ $placement_start }}"></tutor-acceptance>

@endsection
