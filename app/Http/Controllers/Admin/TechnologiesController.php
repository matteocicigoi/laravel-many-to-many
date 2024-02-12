<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTechnologiesRequest;
use App\Http\Requests\UpdateTechnologiesRequest;
use App\Models\Technology;
use Illuminate\Http\Request;
use App\Models\Type;
use Illuminate\Support\Str;

class TechnologiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'elements' => Technology::all(),
            'element_route' => 'technologies',
            'element_title' => 'Technology',
            'skip_type_col' => true,
        ];
        return view('admin.projects.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $technology =  true;
        return view('admin.projects.create', compact('technology'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTechnologiesRequest $request)
    {
                $data = $request->validated();
                $new_technology = new Technology();
                $new_technology->name = $data['name'];
                // se l'utente non inserisce uno slug
                if(!empty($data['slug'])){
                    $new_technology->slug = Str::of($data['slug'])->slug('-');
                }else{
                    $new_technology->slug = Str::of($data['name'])->slug('-');
                }
                $new_technology->save(); 
        
                return redirect()->route('admin.technologies.show', $new_technology)->with('message', 'Technology created correctly');
    }

    /**
     * Display the specified resource.
     */
    public function show(Technology $technology)
    {
        $data = [
            'element' => $technology
        ];
        return view('admin.projects.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technology $technology)
    {
        $data = [
            'element' => $technology,
            'technology' => true
        ];
        return view('admin.projects.update', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTechnologiesRequest $request, Technology $technology)
    {
        $data = $request->validated();
        // se l'utente non inserisce uno slug
        if(!empty($data['slug'])){
            $data['slug'] = Str::of($data['slug'])->slug('-');
        }else{
            $data['slug'] = Str::of($data['name'])->slug('-');
        }
        $technology->update($data);
        return redirect()->route('admin.technologies.show', $data['slug'])->with('message', 'Technology edited correctly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();
        return redirect()->route('admin.technologies.index')->with('message', 'Technology deleted correctly');
    }
}
