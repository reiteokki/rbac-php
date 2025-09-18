<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $password
 * @property \App\Models\Role|null $role
 *
 * @method bool isRole(string $name)
 * @method bool hasRole(string|array $roles)
 */
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
    ];

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
        ];
    }

    /**
     * Get the role that belongs to the user.
     */
    public function role()
    {
        return $this->belongsTo(\App\Models\Role::class);
    }

    /**
     * Check if user has exactly the given role.
     */
    public function isRole(string $name): bool
    {
        return optional($this->role)->name === $name;
    }

    /**
     * Check if user has one of the given roles.
     *
     * @param string|array $roles
     */
    public function hasRole(string|array $roles): bool
    {
        $roles = (array) $roles;

        return $this->role && in_array($this->role->name, $roles, true);
    }
}
