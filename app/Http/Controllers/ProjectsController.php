<?php

namespace App\Http\Controllers;

use App\Models\project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Project::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(project $projects)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(project $projects)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, project $projects)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(project $projects)
    {
        //
    }
}
