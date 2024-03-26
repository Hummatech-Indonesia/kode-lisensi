<?php

namespace App\Models;

use App\Base\Interfaces\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RekeningNumber extends Model implements HasUser
{
    use HasFactory;
    public $incrementing = false;
    public $fillable = ['id', 'user_id', 'name', 'rekening', 'rekening_number', 'status'];
    public $keyType = 'char';
    protected $table = 'categories';
    protected $primaryKey = 'id';

    /**
     * user
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
