<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = ['nom'];

    protected $table = 'categories';

    public function puzzles()
    {
        // ⚠️ Par défaut on suppose une FK 'category_id' dans 'puzzles'
        // Si ta colonne est différente, remplace 'category_id' par le bon nom.
        return $this->hasMany(Puzzle::class, 'category_id');
    }
}
