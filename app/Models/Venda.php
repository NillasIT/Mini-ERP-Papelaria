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
}
