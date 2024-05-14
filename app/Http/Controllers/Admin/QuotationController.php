<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Drug;
use App\Models\Prescription;
use App\Models\Quotation;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quotations = Quotation::all();
        return view('admin.quotation.index', compact('quotations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'prescription_id' => 'required',
            'drug_id' => 'required',
            'quantity' => 'required',
        ]);

        $drug_price = Drug::find($validated['drug_id'])->price;

        $total_price = $drug_price * $validated['quantity'];

        $validated['total_price'] = $total_price;

        Quotation::create($validated);

        // Update the prescription status
        $prescription = Prescription::find($request->input('prescription_id'));
        $prescription->status = 'complete';
        $prescription->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Quotation $quotation)
    {
        $drugs = Drug::all();

        $prescription = Prescription::find($quotation->prescription_id);

        $quotations = Quotation::where('prescription_id', $prescription->id)
            ->with('drug')
            ->get();
        return view('admin.quotation.show', compact('quotations', 'prescription',));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quotation $quotation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quotation $quotation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quotation $quotation)
    {
        //
    }
}
