@extends('layouts.app')

@section('content')

    <placement-details-component :pharmacies='@json($pharmacies)' placement_start="{{ $placement_start }}"></placement-details-component>

@endsection
