<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SellerProfile;
use Illuminate\Support\Facades\Auth;

class SellerDashboardController extends Controller
{
    public function index()
    {
        $profile = SellerProfile::where('user_id', '=', Auth::id(), 'and')->first();

        return view('seller.dashboard', compact('profile'));
    }
}
