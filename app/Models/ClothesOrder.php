<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClothesOrder extends Model
{
    //имя таблицы
    protected $table = 'clothesorder';

    //первичный ключ
    protected $primaryKey = 'id';

    //отключение полей updated_at, created_at
    public $timestamps = false;

    protected $fillable = [
        'PK_Cart',
        'nameClient',
        'phoneClient',
        'emailClient',
    ];
}
