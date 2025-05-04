<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category',
    ];

    public function Venda() {
        return $this->hasMany(Venda::class);
    }
}
