<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();

        $prescriptions = Prescription::where('user_id', $userId)->get();

        return view('prescription.index', compact('prescriptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('prescription.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'images' => 'required|array|max:5',
            'images.*' => 'required|mimes:jpeg,png,jpg,gif,svg',
            'note' => 'required',
            'delivery_address' => 'required',
            'delivery_time' => 'required',
        ]);

        $imageNames = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $name = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images'), $name);
                $imageNames[] = $name;
            }
        }

        $prescription = new Prescription();
        $prescription->user_id = auth()->user()->id; // Assuming you have authenticated user
        $prescription->images = json_encode($imageNames);
        $prescription->note = $request->note;
        $prescription->delivery_address = $request->delivery_address;
        $prescription->delivery_time = $request->delivery_time;
        $prescription->save();

        return redirect()->route('prescription.index')->with('success', 'Prescription created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Prescription $prescription)
    {
        return view('prescription.show', compact('prescription'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prescription $prescription)
    {
        return view('prescription.edit', compact('prescription'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prescription $prescription)
    {
        $validatedData = $request->validate([
            'images' => 'nullable|array|max:5',
            'images.*' => 'nullable|mimes:jpeg,png,jpg,gif,svg',
            'note' => 'required',
            'delivery_address' => 'required',
            'delivery_time' => 'required',
        ]);

        $imageNames = json_decode($prescription->images, true);

        if ($request->hasFile('images')) {
            $existingImages = public_path('images');
            foreach (array_diff($imageNames, []) as $image) {
                $imagePath = $existingImages . '/' . $image;
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            foreach ($request->file('images') as $image) {
                $name = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images'), $name);
                $imageNames[] = $name;
            }
        }

        $prescription->images = json_encode($imageNames);
        $prescription->note = $request->note;
        $prescription->delivery_address = $request->delivery_address;
        $prescription->delivery_time = $request->delivery_time;
        $prescription->save();

        return redirect()->route('prescription.index')->with('success', 'Prescription updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prescription $prescription)
    {
        $prescription->delete();
        return redirect()->route('prescription.index')->with('success', 'Prescription deleted successfully.');
    }
}
