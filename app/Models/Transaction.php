<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'cashier_id',
        'total_amount',
        'discount',
        'transaction_method',
        'created_at',
        'updated_at'
    ];

    public function items(): HasMany
    {
        return $this->hasMany(TransactionItem::class);
    }
}
