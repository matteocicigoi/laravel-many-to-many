<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTypesRequest;
use App\Http\Requests\UpdateTypesRequest;
use Illuminate\Http\Request;
use App\Models\Type;
use Illuminate\Support\Str;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Type::all();
        $type =  true;
        return view('admin.projects.index', compact('projects'), compact('type'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type =  true;
        return view('admin.projects.create', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTypesRequest $request)
    {
                $data = $request->validated();
                $new_type = new Type();
                $new_type->name = $data['name'];
                // se l'utente non inserisce uno slug
                if(!empty($data['slug'])){
                    $new_type->slug = Str::of($data['slug'])->slug('-');
                }else{
                    $new_type->slug = Str::of($data['name'])->slug('-');
                }
                $new_type->save(); 
        
                return redirect()->route('admin.types.show', $new_type)->with('message', 'Type created correctly');
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        $project = $type;
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        $project = $type;
        $type =  true;
        return view('admin.projects.update', compact('project'), compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTypesRequest $request, Type $type)
    {
        $data = $request->validated();
        // se l'utente non inserisce uno slug
        if(!empty($data['slug'])){
            $data['slug'] = Str::of($data['slug'])->slug('-');
        }else{
            $data['slug'] = Str::of($data['name'])->slug('-');
        }
        $type->update($data);
        return redirect()->route('admin.types.show', $data['slug'])->with('message', 'Type edited correctly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->route('admin.types.index')->with('message', 'Type deleted correctly');
    }
}
