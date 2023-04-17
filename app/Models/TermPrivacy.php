<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermPrivacy extends Model
{
    use HasFactory;

    public $fillable = ['id', 'term', 'privacy'];
    protected $table = 'term_privacies';
    protected $primaryKey = 'id';
}
