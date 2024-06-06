<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        dd($request->all());
        //validate
        //return response json with errors if validator fails
        //create the lead
        //send the email
        //return the success response
    }
}
