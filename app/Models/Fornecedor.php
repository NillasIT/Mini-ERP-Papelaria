<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    protected $fillable = [
        'name',
        'type',
        'nuit',
        'email',
        'adress',
        'phone',
        'obs',
    ];

    protected $table = 'fornecedores';
}
