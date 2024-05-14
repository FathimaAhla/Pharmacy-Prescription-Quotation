<?php

namespace App\Http\Controllers;

use App\Mail\QuotationStatusMail;
use App\Models\AddQuotation;
use App\Models\Drug;
use App\Models\Prescription;
use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();

        $quotations = AddQuotation::where('user_id', $userId)->get();
        return view('quotation.index', compact('quotations'));
    }


    /**
     * Show the form for creating a new resource.
     */

    public function create(Prescription $prescription)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $drugs = Drug::all();

        $prescription = Prescription::find($quotation->prescription_id);

        $quotations = Quotation::where('prescription_id', $prescription->id)
            ->with('drug')
            ->get();
        return view('quotation.edit', compact('quotations', 'prescription',));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AddQuotation $quotation)
    {
        $validate = $request->validate([
            'status' => 'required',
        ]);

        $quotation->update($validate);

        if ($request->status == 'accept') {
            Mail::to('admin@mail.com')->send(new QuotationStatusMail(['status' => 'accept']));
        }else {
            Mail::to('admin@mail.com')->send(new QuotationStatusMail(['status' => 'reject']));
        }


        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quotation $quotation)
    {
        //
    }
}
