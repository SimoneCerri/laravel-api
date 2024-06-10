<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;

class EmailController extends Controller
{
    public function index()
    {
        return view('admin.emails.index', ['emails' => Lead::orderByDesc('id')->paginate(5)]);
    }
    public function show(Lead $email)
    {
        return view('admin.emails.show', compact('email'));
    }
    public function destroy(Lead $email)
    {
        $title = $email['title'];
        $email->delete();
        return to_route('admin.emails.index')->with('status', "Deleted '$title' email with success..");
    }
}
