<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRecommendation extends Model
{
    use HasFactory;
    public $fillable = ['id', 'product_id', 'start_date', 'end_date'];
    protected $table = 'product_recommendations';
    public $incrementing = false;
    public $keyType = 'char';
}
