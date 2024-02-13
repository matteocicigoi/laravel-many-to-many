@extends('layouts.admin')
@section('content')
    <div class="mt-5">
        @if (session('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
        @endif
        <ul>
            <li>Nome: {{ $element->name }}</li>
            <li>Slug: {{ $element->slug }}</li>
            @if (isset($element->technologies) && count($element->technologies) > 0)
                <li>Technologies:
                    <ul>
                        @foreach ($element->technologies as $technology)
                            <li>{{ $technology->name }}</li>
                        @endforeach
                    </ul>
                </li>
            @endif
            @if (isset($element->image))
            <li><img class="col-6 object-fit-contain " src="{{ asset('storage/' .  $element->image)}}" alt="image">
            </li>
        @endif
        </ul>
    </div>
@endsection
