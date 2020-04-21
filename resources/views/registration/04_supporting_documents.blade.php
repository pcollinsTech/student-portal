@extends('layouts.app')

@section('content')

    <supporting-documents-component :initial-data="{{json_encode($registration)}}"></supporting-documents-component>

@endsection
