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
        {{ route('admin.projects.update', $element) }}
    @elseif (isset($type))
        {{ route('admin.types.update', $element) }}
    @else
        {{ route('admin.technologies.update', $element) }}
    @endif
@endsection
@section('method')
    @method('PUT')
@endsection
