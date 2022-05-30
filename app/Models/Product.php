<?php

namespace App\Models;

use App\Models\Sale;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'id_category',
        'price',
        'stock',
        'description',
        'image',
    ];

    public function sales()
    {
        return $this->belongsToMany(Sale::class);
    }
}
