@extends('layouts.app')

@section('content')

    <pharmacy-acceptance :student="{{ json_encode($student) }}" placement_start="{{ $placement_start }}"></pharmacy-acceptance>

@endsection
