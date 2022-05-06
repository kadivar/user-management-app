<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
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
     * @return UserFactory
     */
    public static function user_factory(): UserFactory
    {
        return UserFactory::new();
    }

    /**
     * return friends
     *
     * @return BelongsToMany
     */
    public function friends(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_friend', 'user_id', 'friend_id');
    }

    /**
     * return received scores
     *
     * @return HasMany
     */
    public function received_scores(): HasMany
    {
        return $this->hasMany(Score::class, 'user_id', 'id');
    }

    /**
     * return sent scores
     *
     * @return HasMany
     */
    public function sent_scores(): HasMany
    {
        return $this->hasMany(Score::class, 'source_id', 'id');
    }

    /**
     * return total score
     *
     * @return HasMany
     */
    public function score(): HasMany
    {
        return $this->hasMany(Score::class, 'user_id', 'id')->sum('score');
    }
}
