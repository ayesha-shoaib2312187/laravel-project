<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Policy;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PolicyController extends Controller
{
    public function index()
    {
        $policies = Policy::orderBy('updated_date', 'desc')->paginate(10);
        return view('admin.policies.index', compact('policies'));
    }

    public function create()
    {
        return view('admin.policies.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'type' => 'required|string',
            'content' => 'required|string',
        ]);

        Policy::create([
            'title' => $validated['title'],
            'type' => $validated['type'],
            'slug' => Str::slug($validated['title']),
            'content' => $validated['content'],
            'updated_date' => now(),
        ]);

        return redirect()->route('admin.policies.index')->with('success', 'Policy created successfully!');
    }

    public function edit(Policy $policy)
    {
        return view('admin.policies.edit', compact('policy'));
    }

    public function update(Request $request, Policy $policy)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'type' => 'required|string',
            'content' => 'required|string',
        ]);

        $policy->update([
            'title' => $validated['title'],
            'type' => $validated['type'],
            'slug' => Str::slug($validated['title']),
            'content' => $validated['content'],
            'updated_date' => now(),
        ]);

        return redirect()->route('admin.policies.index')->with('success', 'Policy updated successfully!');
    }

    public function destroy(Policy $policy)
    {
        $policy->delete();
        return redirect()->route('admin.policies.index')->with('success', 'Policy deleted successfully!');
    }
}
