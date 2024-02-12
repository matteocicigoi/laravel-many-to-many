@extends('layouts.admin')
@section('content')
    <div class="mt-5">
        @if (session('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
        @endif
        <ul>
            <li>Nome: {{ $project->name }}</li>
            <li>Slug: {{ $project->slug }}</li>
            @if (isset($project->technologies) && count($project->technologies) > 0)
                <li>Technologies:
                    <ul>
                        @foreach ($project->technologies as $technology)
                            <li>{{ $technology->name }}</li>
                        @endforeach
                    </ul>
                </li>
            @endif
        </ul>
    </div>
@endsection
