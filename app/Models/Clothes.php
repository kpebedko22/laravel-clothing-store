<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Size;
use App\Models\Color;
use App\Models\Category;

class Clothes extends Model
{
    //имя таблицы
    protected $table = 'clothes';

    //первичный ключ
    protected $primaryKey = "id";

    //отключение полей updated_at, created_at
    public $timestamps = false;

    protected $fillable = [
        'PK_Size',
        'PK_Color',
        'PK_Category',
        'price',
        'clothesName',
        'description',
        'imagePath',
    ];

    public function size()
    {
        return $this->belongsTo(Size::class, 'PK_Size', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'PK_Category', 'id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'PK_Color', 'id');
    }
}
