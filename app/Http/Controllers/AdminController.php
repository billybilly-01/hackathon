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


    public function users()
    {
        $users = User::get();
        return view('admin.users', ['users' => $users]);
    }
    public function dashboard(){
        $candidats = Candidat::count();
        $users = User::count();
        $validatedCandidats = Candidat::where('status', 'validated')->count();
        $pendingCandidats = Candidat::where('status', 'pending')->count();
        $rejectedCandidats = Candidat::where('status', 'rejected')->count();
        $data = [
            'candidats' => $candidats,
            'users' => $users,
            'validatedCandidats' => $validatedCandidats,
            'pendingCandidats' => $pendingCandidats,
            'rejectedCandidats' => $rejectedCandidats,
        ];
        return view('admin.dashboard', ['data' => $data]);
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



    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }


   

     /**
     * @OA\Get(
     *     path="/admin/connect-user",
     *     summary="Récupérer l'utilisateur connecté",
     *     tags={"Auth"},
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Utilisateur connecté",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="email", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Non authentifié"
     *     )
     * )
     */

    public function connectUser(Request $request)
    {
        return response()->json(['message' => 'Connected', 'user' => Auth::user()]);
    }
}
