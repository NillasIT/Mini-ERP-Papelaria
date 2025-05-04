<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $fillable = [
        'id',
        'produto_id',
        'user_id',
        'quantidade',
        'preco_unitario',
        'total',
        'data_venda',
    ];

    public function produto()
    {
        return $this->belongsTo(Product::class, 'produto_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
