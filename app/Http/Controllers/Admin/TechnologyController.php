<?php

namespace App\Http\Controllers\Admin;

use App\Models\Technology;
use App\Http\Requests\StoreTechnologyRequest;
use App\Http\Requests\UpdateTechnologyRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.techs.index',['technologies'=> Technology::orderByDesc('id')->paginate(5)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.techs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTechnologyRequest $request)
    {
        $name = $request['name'];
        $validatedRequest = $request->validated();
        $validatedRequest['slug'] = Str::slug($request->name,'-');
        Technology::create($validatedRequest);
        return to_route('admin.technologies.index')->with('status', "Add successfully type -> '$name' !");
    }

    /**
     * Display the specified resource.
     */
    public function show(Technology $technology)
    {
        //dd($technology);
        //$tech = $technology;
        //dd($tech);
        return view('admin.techs.show',compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technology $technology)
    {
        return view('admin.techs.edit',compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTechnologyRequest $request, Technology $technology)
    {
        $oldTech = $request['oldName'];
        $validatedRequest = $request->validated();
        $slug = Str::slug($request->name,'-');
        $validatedRequest['slug'] = $slug;
        $newTech = $validatedRequest['name'];
        $technology->update($validatedRequest);
        return to_route('admin.technologies.index')->with('status',"Tech -> $oldTech updated in '$newTech' with success !");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $name = $technology['name'];
        $technology->delete();
        return to_route('admin.technologies.index')->with('status',"Deleted -> '$name' tech with success..");
    }
}
