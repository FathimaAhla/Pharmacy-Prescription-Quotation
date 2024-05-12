<?php

namespace App\Http\Controllers;

use App\Models\Drug;
use Illuminate\Http\Request;

class DrugController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drugs = Drug::all();
        return view('admin.drug.index', compact('drugs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.drug.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);

        $data = Drug::create($validated);
        if ($data) {
            session()->flash('success', 'Product Add Successfully');
            return redirect(route('admin/drugs.index'));
        } else {
            session()->flash('error', 'Some problem occure');
            return redirect(route('admin/drug.create'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Drug $drug)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Drug $drug)
    {
        return view('admin.drug.edit', compact('drug'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Drug $drug)
    {
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);

        $data = $drug->update($validated);
        if ($data) {
            session()->flash('success', 'Product Update Successfully');
            return redirect(route('admin/drugs.index'));
        } else {
            session()->flash('error', 'Some problem occure');
            return redirect(route('admin/drug.edit'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Drug $drug)
    {
        //
    }
}
