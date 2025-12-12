<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactInfo;

class ContactInfoController extends Controller
{
    public function index()
    {
        // Get the first contact info (assuming only one row exists)
        $contact = ContactInfo::first();

        return view('contactInfo', compact('contact'));
    }
}
