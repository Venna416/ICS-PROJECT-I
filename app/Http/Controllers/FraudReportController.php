<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\FraudReport;

class FraudReportController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'seller_name' => 'required|string|max:255',
            'shop_name'   => 'required|string|max:255',
            'shop_link'   => 'required|url',
            'description' => 'required|string|max:2000',
            'evidence'    => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
            'contact'     => 'required|string|max:255',
        ]);

        $path = null;
        if ($request->hasFile('evidence')) {
            $path = $request->file('evidence')->store('evidence', 'public');
        }

        FraudReport::create([
            'user_id'     => Auth::id(),
            'seller_name' => $validated['seller_name'],
            'shop_name'   => $validated['shop_name'],
            'shop_link'   => $validated['shop_link'],
            'description' => $validated['description'],
            'evidence'    => $path,
            'contact'     => $validated['contact'],
        ]);

        return redirect()->route('buyer.reports')->with('success', 'Fraud report submitted successfully!');
    }
}
