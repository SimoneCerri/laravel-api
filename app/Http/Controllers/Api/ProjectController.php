<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        /* $projects = Project::all();
        return response()->json([
            'projects'=> $projects,
        ]); */

        /* return [
            'projects'=> $projects,
            //work as well cuz the controler is from Api folder of Laravel
        ] */

        $projects = Project::with('technologies', 'type')->paginate(5); //care to pass correct name inside with()
        return response()->json([
            'projects' => $projects,
        ]);
    }

    public function show($id)
    {
        $project = Project::with('technologies', 'type')->where('id', $id)->first();
        if ($project) {
            return response()->json([
                'success' => true,
                'response' => $project
            ]);
        } else {
            return response()->json([
                'success' => false,
                'response' => 'Error 404'
            ]);
        }
    }
}
