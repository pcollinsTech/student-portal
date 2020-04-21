@extends('layouts.app')

@section('content')

    <placement-details-component :initial-data="{{json_encode($registration)}}" :pharmacies='@json($pharmacies)' placement_start="{{ $placement_start }}" placement_end="{{ $placement_end }}"></placement-details-component>

@endsection
