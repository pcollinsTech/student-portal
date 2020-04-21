@extends('layouts.app')

@section('content')

    <tutor-details-component :initial-data="{{json_encode($registration)}}" :tutors='@json($tutors)' tutor_start="{{ $tutor_start }}" tutor_end="{{ $tutor_end }}"></tutor-details-component>

@endsection
