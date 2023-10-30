<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartClothes extends Model
{
    //имя таблицы
    protected $table = 'cartclothes';

    //первичный ключ
    protected $primaryKey = 'id';

    //отключение полей updated_at, created_at
    public $timestamps = false;

    protected $fillable = [
        'PK_Cart',
        'PK_Clothes',
    ];
}