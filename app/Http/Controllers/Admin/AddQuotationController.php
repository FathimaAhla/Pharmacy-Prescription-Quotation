<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\QuotationMail;
use App\Models\AddQuotation;
use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AddQuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quotations = AddQuotation::all();
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
            'user_id' => 'required|exists:users,id',
            'prescription_id' => 'required|exists:prescriptions,id',
        ]);

        // Get the quotation data
        $quotation = Quotation::where('prescription_id', $validated['prescription_id'])
            ->where('user_id', $validated['user_id'])
            ->first();

        if ($quotation) {
            $confirmation = AddQuotation::create([
                'user_id' => $validated['user_id'],
                'prescription_id' => $validated['prescription_id'],
                'quotation_id' => $quotation->id,
                'total' => $quotation->total_price,
            ]);

            // Send email
            Mail::to('admin@mail.com')->send(new QuotationMail());
            // Mail::to($confirmation->user->email)->send(new QuotationMail($confirmation));

            return redirect(route('admin/prescriptions.index'))->with('success', 'Quotation sent successfully.');
        }

        return redirect()->back()->with('error', 'Failed to create confirmation.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Quotation $quotation)
    {
        //
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
