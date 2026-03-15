<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // untuk default tabel
    protected $table = 'users';
    // untuk default id
    protected $primaryKey = 'id_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'active',
        'telegram_chat_id',
        'telegram_token',
        'telegram_token_expired_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'telegram_token',
        'telegram_token_expired_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function generateTelegramToken(): string
    {
        $token = strtoupper(\Str::random(8)); // contoh: A1B2C3D4

        $this->update([
            'telegram_token'            => $token,
            'telegram_token_expired_at' => now()->addMinutes(5), // expired 5 menit
        ]);

        return $token;
    }
}
