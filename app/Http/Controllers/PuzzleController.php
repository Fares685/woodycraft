<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Puzzle;

class PuzzleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $puzzles = Puzzle::all();
        return view('puzzles.index', compact('puzzles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('puzzles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nom'         => 'required|max:100|unique:puzzles,nom',
            'categorie'   => 'required|max:100',
            'description' => 'required|max:500',
            'image'       => 'required|max:100',
            'prix'        => 'required|numeric|between:0,99.99',
        ]);

        $puzzle = new Puzzle();
        $puzzle->nom = $request['nom'];
        $puzzle->categorie = $request['categorie'];
        $puzzle->description = $request['description'];
        $puzzle->image = $request['image'];
        $puzzle->prix = $request['prix'];
        $puzzle->save();
        return back()->with('message', 'Le puzzle a bien été créé !');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $puzzle = Puzzle::findOrFail($id);
        return view('puzzles.show', compact('puzzle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $puzzle = Puzzle::findOrFail($id);
        return view('puzzles.edit', compact('puzzle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    $data = $request->validate([
        'nom'         => 'required|max:100',
        'categorie'   => 'required|max:100',
        'description' => 'required|max:500',
        'prix'        => 'required|numeric|between:0,99.99',
    ]);

    $puzzle = Puzzle::findOrFail($id);

    $puzzle->nom         = $data['nom'];
    $puzzle->categorie   = $data['categorie'];
    $puzzle->description = $data['description'];
    $puzzle->prix        = $data['prix'];
    $puzzle->save();

    return redirect()
        ->route('puzzles.index') // ou show
        ->with('message', 'Le puzzle a bien été modifié.');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $puzzle = Puzzle::findOrFail($id);
        $puzzle->delete();
        return redirect()
            ->route('puzzles.index')
            ->with('message', 'Le puzzle a bien été supprimé.');
    }
}
