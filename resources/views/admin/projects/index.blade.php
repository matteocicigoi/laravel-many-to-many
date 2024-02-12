@extends('layouts.admin')

@section('content')
    <?php 
    if(isset($type)){
        $element = 'types';
        $element_title = 'Type';
    }elseif (isset($technology)) {
        $element = 'technologies';
        $element_title = 'Technology';
    }else {
        $element = 'projects';
        $element_title = 'Project';
    }
    ?>
    <a class="btn btn-outline-success mt-3" href="{{ route('admin.' . $element . '.create') }}" role="button">Add {{ $element_title }}</a>
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
                    @if(!isset($type) && !isset($technology))<th scope="col">Type</th>@endif
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <td>{{ $project->name }}</td>
                        @if(!isset($type) && !isset($technology))<td>{{ isset($project->type) ? $project->type->name : '' }}</td>@endif
                        <td>
                            <a href="{{ route('admin.' . $element . '.show', $project) }}" role="button"
                                class="btn btn-outline-primary btn-sm"><i class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('admin.' . $element . '.edit', $project) }}" role="button"
                                class="btn btn-outline-success btn-sm"><i class="fa-solid fa-pencil"></i></a>
                            <form action="{{ route('admin.' . $element . '.destroy', $project) }}" method="POST" class="d-inline">
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
