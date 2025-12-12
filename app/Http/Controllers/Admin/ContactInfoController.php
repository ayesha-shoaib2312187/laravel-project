<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use Illuminate\Http\Request;

class ContactInfoController extends Controller
{
    public function index()
    {
        $contactInfo = ContactInfo::first();
        if (!$contactInfo) {
            $contactInfo = ContactInfo::create([
                'address' => '',
                'email' => '',
                'opening_hours' => '',
                'phone' => '',
            ]);
        }
        return view('admin.contactInfo.edit', compact('contactInfo'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'address' => 'nullable|string',
            'email' => 'nullable|email',
            'opening_hours' => 'nullable|string',
            'phone' => 'nullable|string',
        ]);

        $contactInfo = ContactInfo::first();
        if (!$contactInfo) {
            $contactInfo = ContactInfo::create($request->all());
        } else {
            $contactInfo->update($request->all());
        }

        return redirect()->route('admin.contactInfo.index')->with('success', 'Contact information updated successfully!');
    }
}
