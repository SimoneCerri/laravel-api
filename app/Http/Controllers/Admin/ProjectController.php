<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Technology;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.projects.index',['projects'=> Project::orderByDesc('id')->paginate(5)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create',compact('types','technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        //dd($request);
        //validate
        $validatedRequest = $request->validated();
        $slug = Str::slug($request->title,'-');
        //dd($slug);
        //create
        //dd($validatedRequest);
        $validatedRequest['slug'] = $slug;
        $title = $validatedRequest['title'];
        if($request->has('img')) //check if request have the 'img' inside
        {
            $img_path = Storage::put('uploads',$validatedRequest['img']); //take the path
            $validatedRequest['img'] = $img_path; //save the path inside validated data
        }
        $project = Project::create($validatedRequest);
        //dd($project);
        if($request->has('technologies'))
        {
            $project->technologies()->attach($validatedRequest['technologies']);
        }
        //dd($project);
        //redirect
        return to_route('admin.projects.show',compact('project'))->with('status',"Add successfully project '$title' !");
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show',compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit',compact('project','types','technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $validatedRequest = $request->validated();
        $slug = Str::slug($request->title, '-');
        $validatedRequest['slug'] = $slug;
        if ($request->has('img')) //check if request have the 'img' inside
        {
            if($project->img) //check if exist one img before inside it
            {
                Storage::delete($project->img); //delete old img inside storage
            }
            $img_path = Storage::put('uploads', $validatedRequest['img']); //take the path
            $validatedRequest['img'] = $img_path; //save the path inside validated data
        }
        if($project->has('technologies'))
        {
            $project->technologies()->sync($validatedRequest['technologies']);
        }
        else
        {
            $project->technologies()->sync([]);
        }
        $project->update($validatedRequest);
        $title = $project['title'];
        return to_route('admin.projects.index')->with('status',"Project '$title' updated with success !");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $title = $project['title'];
        if ($project->img)
        {
            Storage::delete($project->img); //delete old img inside storage
        }
        $project->delete();
        return to_route('admin.projects.index')->with('status',"Deleted '$title' project with success..");
    }
}