<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Book extends Model
{
    protected $primaryKey = 'isbn';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'isbn',
        'titre',
        'auteur1',
        'editeur',
        'annee',
        'nombre_exemplaires',
        'type',
        'genre',
        'tome',
        'disponible'
    ];

    protected $casts = [
        'annee' => 'integer',
        'nombre_exemplaires' => 'integer',
        'disponible' => 'integer',
        'tome' => 'integer'
    ];

    // Query Scopes
    public function scopeAvailable(Builder $query)
    {
        return $query->where('disponible', '>', 0);
    }

    public function scopeUnavailable(Builder $query)
    {
        return $query->where('disponible', '<=', 0);
    }

    // Instance Methods
    public function isAvailable()
    {
        return $this->disponible > 0;
    }

    public function incrementAvailable()
    {
        $this->increment('disponible');
    }

    public function decrementAvailable()
    {
        $this->decrement('disponible');
    }
}