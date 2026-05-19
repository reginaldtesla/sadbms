<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Mail\PasswordResetMail;
use App\Models\Personel;
use Illuminate\Support\Facades\Mail;
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

    public function usersProfiles()
    {
        return $this->hasMany(Personel::class, 'user_id');
    }

  /** Most recent personnel profile created by or linked to this user. */
    public function personelProfile()
    {
        return $this->hasOne(Personel::class, 'user_id')->latestOfMany();
    }

    /**
     * Personnel record for this login (by user_id, then email).
     */
    public function sendPasswordResetNotification($token): void
    {
        $url = url(route('password.reset', [
            'token' => $token,
            'email' => $this->getEmailForPasswordReset(),
        ], false));

        Mail::to($this->email)->send(new PasswordResetMail($this->name, $url));
    }

    public function resolvePersonelProfile(): ?Personel
    {
        $profile = $this->usersProfiles()->latest()->first();

        if (! $profile && $this->email) {
            $profile = Personel::where('email', $this->email)->first();
        }

        return $profile;
    }
}
