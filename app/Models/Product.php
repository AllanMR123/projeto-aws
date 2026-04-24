<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Define quais colunas podem ser preenchidas pelo Seeder
    protected $fillable = [
        'name',
        'brand',
        'category',
        'price',
        'image',
        'specifications'
    ];

    // IMPORTANTE: Converte o array das peças do GitHub em JSON para o SQLite
    protected $casts = [
        'specifications' => 'array',
    ];
}
