@extends('layouts.admin')

@section('content')
    <a class="btn btn-outline-success mt-3" href="{{ route('admin.' . $element_route . '.create') }}" role="button">Add {{ $element_title }}</a>
    <div class="mt-5">
        @if (session('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
        @endif
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" class="w-50">Name</th>
                    @if(!isset($skip_type_col))<th scope="col">Type</th>@endif
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($elements as $element)
                    <tr>
                        <td>{{ $element->name }}</td>
                        @if(!isset($skip_type_col))<td>{{ isset($element->type) ? $element->type->name : '' }}</td>@endif
                        <td>
                            <a href="{{ route('admin.' . $element_route . '.show', $element) }}" role="button"
                                class="btn btn-outline-primary btn-sm"><i class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('admin.' . $element_route . '.edit', $element) }}" role="button"
                                class="btn btn-outline-success btn-sm"><i class="fa-solid fa-pencil"></i></a>
                            <form action="{{ route('admin.' . $element_route . '.destroy', $element) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" role="button" class="btn btn-outline-danger btn-sm"><i
                                        class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endsection
