<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MOP;

class MOPController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mops = MOP::all();
        return view('mops.index', compact('mops'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mops.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'script' => 'required',
        ]);

        $mops = new MOP;
        $mops->name = $request->name;
        $mops->description = $request->description;
        $mops->script = $request->script;
        $mops->save();


        return redirect()->route('mops.index')->with('success', 'MOP Created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $mop = MOP::findOrFail($id);
        return view('mops.show', compact('mop'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mop = MOP::findOrFail($id);
        return view('mops.edit', compact('mop'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $mop = MOP::findOrFail($id);
        $mop->name = $request->name;
        $mop->description = $request->description;
        $mop->script = $request->script;
        $mop->save();

        return redirect()->route('mops.index')->with('success', 'MOP Updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $mop = MOP::findOrFail($id);
            $mop->delete();
            return redirect()->route('mops.index')->with('success', 'MOP deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('mops.index')->with('error', 'MOP not deleted');
        }
    }
}
