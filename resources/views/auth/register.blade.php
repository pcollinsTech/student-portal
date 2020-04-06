@extends('layouts.app')

@section('content')

    <registration-component :counties='{{ $counties }}' :universities='@json($universities)'></registration-component>

@endsection
