<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $incrementing = false;
    public $fillable = ['id', 'group_name', 'receiver_type', 'group_leader_id'];
    public $keyType = 'char';
    protected $table = 'products';
    protected $primaryKey = 'id';
}
