@extends('layouts.create_update')
@section('title')
    @if (!isset($type) && !isset($technology))
        Add Project
    @elseif(isset($type))
        Add Type
    @else
        Add Technology
    @endif
@endsection
@section('route')
    @if (!isset($type) && !isset($technology))
        {{ route('admin.projects.store') }}
    @elseif(isset($type))
        {{ route('admin.types.store') }}
    @else
        {{ route('admin.technologies.store') }}
    @endif
@endsection
