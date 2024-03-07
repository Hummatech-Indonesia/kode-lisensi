<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpdateInvoice extends Model
{
    use HasFactory;
    protected $table = "update_invoices";
    protected $fillable = ['id', 'new_invoice'];
}
