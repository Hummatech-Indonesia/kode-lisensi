<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Help extends Model
{
    use HasFactory;

    public $fillable = ['id', 'question', 'answer'];
    protected $table = 'helps';
    protected $primaryKey = 'id';
}
