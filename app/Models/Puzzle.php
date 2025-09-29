<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puzzle extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description',
        'image',
        'prix',
        'category_id', // ⚠️ clé étrangère vers categories.id
    ];

    public function categorie()
    {
        // Relation vers Categorie (FR)
        return $this->belongsTo(Categorie::class, 'category_id');
    }
}
