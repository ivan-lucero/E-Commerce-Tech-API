<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
