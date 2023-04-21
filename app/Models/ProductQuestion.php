<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductQuestion extends Model
{
    use HasFactory;

    public $incrementing = false;
    public $fillable = ['id', 'product_id', 'question', 'answer', 'serial_key', 'is_purchased'];
    protected $table = 'product_questions';
    protected $primaryKey = 'id';
}
