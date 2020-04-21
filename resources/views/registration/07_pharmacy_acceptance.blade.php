@extends('layouts.app')

@section('content')

    <pharmacy-acceptance :student="{{ json_encode($placement->student) }}" :placement="{{ json_encode($placement) }}"></pharmacy-acceptance>

@endsection
