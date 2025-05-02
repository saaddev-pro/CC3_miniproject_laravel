<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'affiliation',
        'telephone',
        'department',
        'date_embauche'
    ];

    // Removed duplicate loans method

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'date_embauche' => 'date',
            'affiliation' => 'string',
        ];
    }
    public function isAdmin()
    {
        return $this->role === 'admin';
    }


    public function isManager()
    {
        return $this->role === 'library_manager';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
    public function scopeRegularUsers($query)
    {
        return $query->where('role', 'user');
    }
    // In User model
    public function activeLoans()
    {
        return $this->hasMany(Loan::class)
            ->where('date_retour', '>', now())
            ->with('book');
    }
}
