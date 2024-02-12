@extends('layouts.admin')
@section('content')
    <div class="container mt-5">
        <h1 class="text-center m-5">@yield('title')</h1>
        @if ($errors->any())
            <div class="alert  alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="@yield('route')" method="POST">
            @csrf
            @yield('method')
            <div class="row g-3 w-50 m-auto">
                <div class="col-12">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="@if (isset($project)) {{ old('name', $project->name) }}@else{{ old('name') }} @endif"
                        required>
                </div>
                <div class="col-12">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug"
                        value="@if (isset($project)) {{ old('slug', $project->slug) }}@else{{ old('slug') }} @endif">
                </div>
                @if(!isset($type) && !isset($technology))
                <div class="col-12">
                    <label for="link" class="form-label">Link</label>
                    <input type="text" class="form-control" id="link" name="link"
                        value="@if (isset($project)) {{ old('link', $project->link) }}@else{{ old('link') }} @endif">
                </div>
                @endif
                @if(isset($types))
                <div class="col-12">
                    <label for="types" class="form-label">Types</label>
                    <select class="form-select" aria-label="Default select example" id="types" name="type_id">
                        <option value="">Open this select menu</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}" @if(old('type_id') == $type->id || (isset($project) && $project->type_id == $type->id)) selected @endif>{{ $type->name }}</option>
                        @endforeach
                      </select>
                </div>
                @endif
                  @if(isset($technologies))
                  <div class="col-12">
                    <label for="technology" class="form-label col-12">Technologies</label>
                    @foreach ($technologies as $technology)
                    <div class="form-check form-check-inline" id="technologies">
                      <input class="form-check-input" type="checkbox" id="technology-{{ $technology->id }}" value="{{ $technology->id }}" name="technologies[]" @if((isset($project) && $project->technologies->contains($technology->id)) || in_array($technology->id, old('technologies', []))) checked @endif>
                      <label class="form-check-label" for="technology-{{ $technology->id }}">{{ $technology->name }}</label>
                    </div>
                    @endforeach
                  </div>
                    @endif

                <button type="submit" class="btn btn-primary mt-4 col-12 py-3 text-uppercase">Submit</button>
            </div>
        </form>
    </div>
@endsection
