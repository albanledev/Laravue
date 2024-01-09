<?php

namespace App\Http\Controllers;

use App\Models\Track;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class TrackController extends Controller
{
    public function index(){
        $tracks = Track::where('display', true)->orderBy('title')->get();

//        dd($tracks);
        return Inertia::render('Track/Index', [
            'tracks' => $tracks,
        ]);
    }

    public function create(){
        return Inertia::render('Track/Create');
    }

    public function store(Request $request){
        $request->validate([
           'title' => ['string','required', 'max:255'],
            'artist' => ['string','required', 'max:255'],
            'display' => ['boolean','required'],
            'image' => ['image','required'],
            'music' => ['file','required', 'extensions:mp3,wav'],

        ]);
        // ici on veut que les fichiers que l'on génére avec le form soit stocké dans un storag
        //on crée un uuid pour le nom du fichier
        $uuid = 'trk-'.Str::uuid();

        //on récupère l'extension du fichier
        $extension = $request->image->extension();
        $extensionMusic = $request->music->extension();
        //on stocke le fichier dans le dossier storage/app/public/tracks/images
        $imagePath = $request->image->storeAs('tracks/images', $uuid . '.' . $extension);

        $musicPath = $request->music->StoreAs('tracks/musics', $uuid . '.' . $extensionMusic);

        //on crée un nouveau track
        Track::create([
            'uuid' =>   $uuid,
            'title' => $request->title,
            'artist' => $request->artist,
            'display' => $request->display,
            'image'=> $imagePath,
            'music' => $musicPath,
        ]);

        return redirect()->route('tracks.index');
    }
}
