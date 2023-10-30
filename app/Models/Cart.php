<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //имя таблицы
    protected $table = 'cart';

    //первичный ключ
    protected $primaryKey = 'id';

    //отключение полей updated_at, created_at
    public $timestamps = false;

    protected $fillable = [
        'totalPrice',
        'totalItems',
    ];
}