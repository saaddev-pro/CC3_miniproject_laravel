<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Loan extends Model
{
    protected $fillable = ['user_id', 'book_isbn', 'date_emprunt', 'date_retour'];
    
    // Replace $dates with $casts for better type handling
    protected $casts = [
        'date_emprunt' => 'datetime',
        'date_retour' => 'datetime'
    ];
    
    // Query scopes
    public function scopeActive(Builder $query)
    {
        return $query->where('date_retour', '>', now());
    }

    public function scopeOverdue(Builder $query)
    {
        return $query->where('date_retour', '<', now());
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_isbn', 'isbn')->withDefault([
            'titre' => 'Deleted Book',
            'isbn' => 'N/A'
        ]);
    }

    // Automatically set dates when creating a loan
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($loan) {
            $loan->date_emprunt = $loan->date_emprunt ?? now();
            $loan->date_retour = $loan->date_retour ?? now()->addWeeks(2);
        });
    }
}