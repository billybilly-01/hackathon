<?php

namespace App\Http\Controllers;

use App\Mail\CandidatCreated;
use App\Mail\RejectMail;
use App\Mail\ValidateMail;
use App\Models\Candidat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CandidatController extends Controller
{
    /**
     * Store a newly created Candidat in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */




    /**
     * @OA\Post(
     *     path="/api/candidats/store",
     *     summary="Créer un nouveau candidat",
     *     tags={"Candidats"},
     *     operationId="storeCandidat",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"nom", "prenom", "email", "video"},
     *                 @OA\Property(property="nom", type="string", example="Dupont"),
     *                 @OA\Property(property="prenom", type="string", example="Jean"),
     *                 @OA\Property(property="email", type="string", format="email", example="jean.dupont@example.com"),
     *                 @OA\Property(property="telephone", type="string", example="0601020304"),
     *                 @OA\Property(property="adresse", type="string", example="123 rue Exemple"),
     *                 @OA\Property(property="ville", type="string", example="Paris"),
     *                 @OA\Property(property="pays", type="string", example="France"),
     *                 @OA\Property(property="date_naissance", type="string", format="date", example="1990-05-15"),
     *                 @OA\Property(property="niveau_etude", type="string", example="Bac+3"),
     *                 @OA\Property(
     *                     property="video",
     *                     type="string",
     *                     format="binary",
     *                     description="Fichier vidéo du candidat"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Candidat enregistré avec succès",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Candidat enregistré avec succès."),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="nom", type="string", example="Dupont"),
     *                 @OA\Property(property="prenom", type="string", example="Jean"),
     *                 @OA\Property(property="email", type="string", example="jean.dupont@example.com"),
     *                 @OA\Property(property="video", type="string", example="videos/nom_fichier.mp4")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Données de validation incorrectes",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The email field is required."),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nom' => 'required|string|max:255',
                'prenom' => 'required|string|max:255',
                'email' => 'required|email|unique:candidats,email',
                'telephone' => 'required|string|max:20',
                'adresse' => 'required|string',
                'ville' => 'required|string|max:100',
                'pays' => 'required|string|max:100',
                'entite' => 'required|string|max:100',
                'nom_entite' => 'required|string|max:100',
                'video' => 'required|file|mimes:mp4,avi,mov|max:30480', // 20 Mo max
            ], [
                'nom.required' => 'Le nom est obligatoire.',
                'prenom.required' => 'Le prénom est obligatoire.',
                'email.required' => 'L\'email est obligatoire.',
                'email.email' => 'L\'email doit être une adresse valide.',
                'email.unique' => 'Cet email est déjà utilisé.',
                'telephone.required' => 'Le téléphone est obligatoire.',
                'adresse.required' => 'L\'adresse est obligatoire.',
                'ville.required' => 'La ville est obligatoire.',
                'pays.required' => 'Le pays est obligatoire.',
                'entite.required' => 'L\'entité est obligatoire.',
                'nom_entite.required' => 'Le nom de l\'entité est obligatoire.',
                'video.required' => 'La vidéo est obligatoire.',
                'video.file' => 'Le fichier vidéo est invalide.',
                'video.mimes' => 'Le format de la vidéo doit être mp4, avi ou mov.',
                'video.max' => 'La taille maximale de la vidéo est de 30 Mo.',
            ]);

            // Enregistrement de la vidéo
            if ($request->hasFile('video')) {
                $video = $request->file('video');

                // Nom personnalisé : prénom_nom_timestamp.extension
                $filename = Str::slug($request->prenom . '_' . $request->nom . '_' . $request->telephone) . '_' . time() . '.' . $video->getClientOriginalExtension();

                // Stocker la vidéo dans "storage/app/public/videos"
                $videoPath = $video->storeAs('videos', $filename, 'public');

                $validated['video'] = $videoPath;
            }

            $validated["role_id"] = 3;
            // $candit = new Candidat();
            // $candit->nom = "DIBY";
            // $candit->prenom = "KOFFI";
            // $candit->email = "ngbeadego.martial@gmail.com";
            // $candit->telephone = "0102030405";
            // $candit->adresse = "Cocody";        
            // $candit->ville = "Abidjan";
            // $candit->pays = "Côte d'Ivoire";
            // $candit->entite = "Université";
            // $candit->nom_entite = "UVCI";
            // $candit->video = "http://localhost:8000/storage/videos/koffi-diby-0102030405_1747738935.mp4";

            $candidat = new Candidat();

            $candidat->nom = $validated['nom'];
            $candidat->prenom = $validated['prenom'];
            $candidat->email = $validated['email'];
            $candidat->telephone = $validated['telephone'];
            $candidat->adresse = $validated['adresse'];
            $candidat->ville = $validated['ville'];
            $candidat->pays = $validated['pays'];
            $candidat->entite = $validated['entite'];
            $candidat->nom_entite = $validated['nom_entite'];
            $candidat->video = $validated['video'];
            $candidat->role_id = 3;


            Mail::to($candidat->email)->send(new CandidatCreated($candidat));

            $candidat = Candidat::create($validated);

            return response()->json([
                'message' => 'Candidat enregistré avec succès.',
                'data' => $candidat,
                'status' => 'success'
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Erreur de validation.',
                'errors' => $e->errors(),
                'status' => 'error'
            ], 422);
        }
    }


    public function rejectCandidat($id)
    {
        $candidat = Candidat::findOrFail($id);
        $candidat->status = 'rejected';
        $candidat->save();


        //  $user = Candidat::findOrFail(5);

        // Préparer les données du QR
        // $qrData = "Nom: {$candidat->nom}\nEmail: {$candidat->email}\nTéléphone: {$candidat->telephone}";

        // Générer le QR code
        // $qrCode = QrCode::size(300)->generate($qrData);
        // $qrCode = base64_encode(QrCode::format('png')->size(300)->generate($qrData));

        // Envoyer l'email de rejet
        Mail::to($candidat->email)->send(new RejectMail($candidat));

        return response()->json([
            'message' => 'Candidat rejeté avec succès.',
            'data' => $candidat,
            'status' => 'success'
        ], 200);
    }

    public function validateCandidat($id)
    {
        $candidat = Candidat::findOrFail($id);
        $candidat->status = 'validated';
        $candidat->save();

        // Envoyer l'email de validation
        Mail::to($candidat->email)->send(new ValidateMail($candidat));

        return response()->json([
            'message' => 'Candidat validé avec succès.',
            'data' => $candidat,
            'status' => 'validated'
        ], 200);
    }


    public function generateUserQrCode()
    {
        $user = Candidat::findOrFail(5);

        // Préparer les données du QR
        $qrData = "Nom: {$user->nom}\nEmail: {$user->email}\nTéléphone: {$user->telephone}";

        // Générer le QR code
        $qrCode = QrCode::size(300)->generate($qrData);

        return view('qr-code', compact('qrCode', 'user'));
    }
}
