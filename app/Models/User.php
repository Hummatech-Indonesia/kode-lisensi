<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Base\Interfaces\HasTransactions;
use App\Notifications\RegistrationNotification;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword, HasTransactions
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
    use SoftDeletes;

    public $incrementing = false;
    public $keyType = 'char';
    protected $table = 'users';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'photo',
        'phone_number',
        'password'
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
     * Send the queued email verification notification.
     *
     * @return void
     */

    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new RegistrationNotification);
    }

    /**
     * Send the queued password reset verification notification.
     *
     * @param $token
     *
     * @return void
     */

    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * One-to-Many relationship with Transaction Model
     *
     * @return HasMany
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
