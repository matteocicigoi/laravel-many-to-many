@extends('layouts.create_update')
@section('title')
    @if (!isset($type) && !isset($technology))
        Update Project
    @elseif(isset($type))
        Add TypeUpdate Type
    @else
        Update Technology
    @endif
@endsection
@section('route')
    @if (!isset($type) && !isset($technology))
        {{ route('admin.projects.update', $project) }}
    @elseif (isset($type))
        {{ route('admin.types.update', $project) }}
    @else
        {{ route('admin.technologies.update', $project) }}
    @endif
@endsection
@section('method')
    @method('PUT')
@endsection
