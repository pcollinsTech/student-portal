@extends('layouts.app')

@section('content')
    <character-declaration-component :initial-data="{{json_encode($registration)}}"></character-declaration-component>

@endsection
