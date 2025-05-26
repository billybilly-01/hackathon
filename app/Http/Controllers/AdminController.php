<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function index()
    {
        $candidats = Candidat::get();
        return view('admin.index', ['candidats' => $candidats]);
    }

    public function login()
    {
        return view("admin.login");
    }


    public function loginSubmit(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password) && $user->role && $user->role->name === 'admin') {
            Auth::login($user);
            return redirect()->route('admin.index');
        } else {
            // return redirect()->route('admin.login')->with('error', 'Identifiants invalides ou accès refusé.');
            return response()->json([
                'message' => 'Identifiants invalides ou accès refusé.',
                'status' => false,
                'data' => $user
            ], 401);
        }
    }
}
