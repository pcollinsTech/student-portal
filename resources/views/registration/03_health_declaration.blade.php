@extends('layouts.app')

@section('content')

    <health-declaration-component :initial-data="{{json_encode($registration)}}"></health-declaration-component>

@endsection
