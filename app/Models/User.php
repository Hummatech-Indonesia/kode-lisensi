<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Base\Interfaces\HasBalanceWithdrawals;
use App\Base\Interfaces\HasOnePinRekening;
use App\Base\Interfaces\HasRekeningNumbers;
use App\Base\Interfaces\HasTransactions;
use App\Base\Interfaces\HasTransactionsWhatsapp;
use App\Notifications\RegistrationNotification;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword, HasTransactions, HasOnePinRekening, HasRekeningNumbers,HasTransactionsWhatsapp
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
        'password',
        'code_affiliate',
        'fcm_token',
        'api_token',
        'email_verified_at'
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

    /**
     * Get all of the whatsappTransactions for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactionsWhatsapp(): HasMany
    {
        return $this->hasMany(TransactionWhatsapp::class);
    }

    /**
     * pinRekening
     *
     * @return HasOne
     */
    public function pinRekening(): HasOne
    {
        return $this->hasOne(PinRekening::class);
    }


    /**
     * rekeningNumbers
     *
     * @return HasMany
     */
    public function rekeningNumbers(): HasMany
    {
        return $this->hasMany(RekeningNumber::class);
    }
}
