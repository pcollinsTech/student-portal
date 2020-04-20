@extends('layouts.app')

@section('content')

    <tutor-acceptance :student='@json($tutor->student)' placement_start="{{ $tutor->tutor_start }}"></tutor-acceptance>

@endsection
