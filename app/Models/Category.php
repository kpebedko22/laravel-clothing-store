<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Clothes;

class Category extends Model
{
    //имя таблицы
    protected $table = 'category';

    //первичный ключ
    protected $primaryKey = 'id';

    //отключение полей updated_at, created_at
    public $timestamps = false;

    public function clothes()
    {
        return $this->hasMany(Clothes::class, 'id', 'PK_Category');
    }
}
