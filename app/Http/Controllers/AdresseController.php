<?php

namespace App\Http\Controllers;

use App\Models\Adresse; 
use Illuminate\Http\Request;

class AdresseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adresses = Adresse::all();
        return view('adresses.index', compact('adresses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adresses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'numero' => 'nullable|string|max:10',
            'rue' => 'required|string|max:255',
            'ville' => 'required|string|max:100',
            'code_postal' => 'required|string|max:20',
            'pays' => 'required|string|max:100',
        ]);

        Adresse::create($request->all());

        return redirect()->route('adresses.index')
                         ->with('success', 'Adresse ajoutée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Adresse $adresse)
    {
        return view('adresses.show', compact('adresse'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Adresse $adresse)
    {
        return view('adresses.edit', compact('adresse'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Adresse $adresse)
    {
        $request->validate([
            'numero' => 'nullable|string|max:10',
            'rue' => 'required|string|max:255',
            'ville' => 'required|string|max:100',
            'code_postal' => 'required|string|max:20',
            'pays' => 'required|string|max:100',
        ]);

        $adresse->update($request->all());

        return redirect()->route('adresses.index')
                         ->with('success', 'Adresse modifiée avec succès.');
    }

    // Suppression
    public function destroy(Adresse $adresse)
    {
        $adresse->delete();

        return redirect()->route('adresses.index')
                         ->with('success', 'Adresse supprimée avec succès.');
    }
}

