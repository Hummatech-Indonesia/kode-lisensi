<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    public $incrementing = true;
    public $fillable = ['first_offer', 'first_title', 'first_description', 'first_product_url', 'first_image', 'second_offer', 'second_title', 'second_description', 'second_product_url', 'second_image'];
    protected $table = 'banners';
    protected $primaryKey = 'id';
}
