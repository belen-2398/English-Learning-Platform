<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_as'
    ];

    // protected $with = ['notifications', 'unreadNotifications'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function topics(): BelongsToMany
    {
        return $this->belongsToMany(Topic::class);
    }

    public function dictionaryWords(): HasMany
    {
        return $this->hasMany(DictionaryWord::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function scopeSearch($query, $request)
    {
        $searchParameter = $request->input('query_parameter');
        $searchText = $request->input('query');

        if ($searchParameter) {
            $query->where($searchParameter, 'LIKE', "%{$searchText}%");
        } else {
            $query->where('users.name', 'LIKE', "%{$searchText}%")
                ->orWhere('users.email', 'LIKE', "%{$searchText}%");
        }
    }

    public function scopeSort($query, $request)
    {
        $sort = $request->input('sort');
        $sortBy = $request->input('sort_by');

        if ($sort && $sortBy) {
            if ($sortBy === 'name') {
                $query->orderBy('users.name', $sort);
            } elseif ($sortBy === 'email') {
                $query->orderBy('users.email', $sort);
            } elseif ($sortBy === 'role_as') {
                $query->orderBy('users.role_as', $sort);
            } else {
                $query->orderBy('users.role_as', 'asc');
            }
        }
    }
}
