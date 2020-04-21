@extends('layouts.app')

@section('content')
    <tutor-acceptance :tutor='@json($tutor)' :student="{{json_encode($tutor->student)}}" :pharmacies="{{ json_encode($tutor->student->pharmacies)  }}"></tutor-acceptance>

@endsection
