<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'product_id',
        'code',
        'percentage',
        'status',
        'created_at',
        'updated_at'
    ];
}
