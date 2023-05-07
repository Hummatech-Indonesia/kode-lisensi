<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    public $incrementing = true;
    public $fillable = ['offer', 'header', 'sub_header', 'description', 'image', 'product_url'];
    protected $table = 'sliders';
    protected $primaryKey = 'id';
}
