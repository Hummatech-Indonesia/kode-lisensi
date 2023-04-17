<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    public $fillable = ['id', 'name', 'description', 'phone_number', 'email', 'logo', 'facebook', 'twitter', 'youtube', 'instagram'];
    protected $table = 'site_settings';
    protected $primaryKey = 'id';
}
