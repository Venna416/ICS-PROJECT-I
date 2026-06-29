<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;

use App\Http\Requests\Auth\LoginRequest;

use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\View\View;

use App\Models\SellerProfile;

use App\Models\BuyerProfile;



class AuthenticatedSessionController extends Controller
{


    /**
     * Display login view
     */

    public function create(): View
    {

        return view('auth.login');

    }






    /**
     * Handle login
     */

    public function store(LoginRequest $request): RedirectResponse
    {


        $request->authenticate();



        $request->session()->regenerate();




        $user = Auth::user();







        /*
        |--------------------------------------------------------------------------
        | ADMIN
        |--------------------------------------------------------------------------
        */

        if($user->role === 'admin')
        {


            return redirect()

            ->route('admin.dashboard');


        }









        /*
        |--------------------------------------------------------------------------
        | SELLER
        |--------------------------------------------------------------------------
        */


        if($user->role === 'seller')
        {



            $profile = SellerProfile::where(

                'user_id',

                $user->id

            )->first();





            if(!$profile)
            {


                return redirect()

                ->route('seller.profile.create')

                ->with(

                    'error',

                    'Please complete your seller profile first.'

                );


            }






            return redirect()

            ->route('seller.dashboard');



        }









        /*
        |--------------------------------------------------------------------------
        | BUYER
        |--------------------------------------------------------------------------
        */


        if($user->role === 'buyer')
        {



            $profile = BuyerProfile::where(

                'user_id',

                $user->id

            )->first();






            if(!$profile)
            {


                return redirect()

                ->route('buyer.profile.create')

                ->with(

                    'error',

                    'Please complete your buyer profile first.'

                );


            }






            return redirect()

            ->route('buyer.dashboard');



        }









        /*
        |--------------------------------------------------------------------------
        | REGULATOR
        |--------------------------------------------------------------------------
        */


        if($user->role === 'regulator')
        {


            return redirect()

            ->route('regulator.dashboard');


        }









        return redirect()

        ->route('dashboard');



    }










    /**
     * Logout
     */

    public function destroy(Request $request): RedirectResponse
    {


        Auth::guard('web')->logout();



        $request->session()->invalidate();



        $request->session()->regenerateToken();




        return redirect('/');


    }



}