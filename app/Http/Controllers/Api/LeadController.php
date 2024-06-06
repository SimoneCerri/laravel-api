<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\NewLeadMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Lead;
use Illuminate\Support\Facades\Mail;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        /* dd($request->all()); */
        $data = $request->all();
        //validate
        $validateData = Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);
        //return response json with errors if validator fails
        if ($validateData->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validateData->errors()
            ]);
        }
        //create the lead
        $newLead = Lead::create($data);
        //send the email
        Mail::to('admin@simonecerri.com')->send(new NewLeadMessage($newLead));
        //return the success response
        return response()->json([
            'success' => true,
            'message' => 'Message send successfully !'
        ]);
    }
}
