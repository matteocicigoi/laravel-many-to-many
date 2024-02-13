<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectsRequest;
use App\Http\Requests\UpdateProjectsRequest;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'elements' => Project::all(),
            'element_route' => 'projects',
            'element_title' => 'Project',

        ];
        return view('admin.projects.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types'), compact('technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectsRequest $request)
    {
        $data = $request->validated();
        $new_project = new Project();
        $new_project->name = $data['name'];
        $new_project->link = $data['link'];
        $new_project->type_id = $data['type_id'];
        if(!empty($data['image'])){
            $img_path = Storage::put('uploads', $data['image']);
            $new_project->image = $img_path;
        }
        // se l'utente non inserisce uno slug
        if(!empty($data['slug'])){
            $new_project->slug = Str::of($data['slug'])->slug('-');
        }else{
            $new_project->slug = Str::of($data['name'])->slug('-');
        }
        $new_project->save(); 
        
        if(isset($data['technologies'])){
            $new_project->technologies()->sync($data['technologies']);
        }
        return redirect()->route('admin.projects.show', $new_project)->with('message', 'Post created correctly');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $data = [
            'element' => $project
        ];
        return view('admin.projects.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $data = [
            'element' => $project,
            'types' => Type::all(),
            'technologies' => Technology::all()
        ];
        return view('admin.projects.update', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectsRequest $request, Project $project)
    {
        $data = $request->validated();
        if(!empty($data['image'])){
            $img_path = Storage::put('uploads', $data['image']);
            $data['image'] = $img_path;
        }elseif($request['delete-img'] == 'on'){
            //elimina l'immagine
            Storage::delete($project->image);
            $data['image'] = null;
        }
        // se l'utente non inserisce uno slug
        if(!empty($data['slug'])){
            $data['slug'] = Str::of($data['slug'])->slug('-');
        }else{
            $data['slug'] = Str::of($data['name'])->slug('-');
        }
        $project->update($data);

        if(isset($data['technologies'])){
            $project->technologies()->sync($data['technologies']);
        }else{
            $project->technologies()->sync([]);
        }
        return redirect()->route('admin.projects.show', $data['slug'])->with('message', 'Post edited correctly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        Storage::delete($project->image);
        $project->delete();
        return redirect()->route('admin.projects.index')->with('message', 'Post deleted correctly');
    }
}
