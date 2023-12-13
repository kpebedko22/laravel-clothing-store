<?php

namespace App\Faker\Provider\ru_RU;

use Faker\Provider\Base;
use Illuminate\Support\Str;

class Clothing extends Base
{
    protected static array $fabrics = [
        'из искусственной овчины', 'из велюра', 'из фетра', 'из эластичной ткани',
        'из плотного трикотажа', 'из вельвета', 'из плотного твила', 'из структурной ткани',
        'из хлопка', 'из кожи', 'из жаккарда', 'из стрейч-вискозы', 'из экокожи',
        'из мерсеризованного хлопка', 'из лиоцелла', 'из плотного сатина',
    ];

    protected static array $decorations = [
        'с меховой подкладкой', 'с принтом', 'с фотопринтом', 'с контрастной отделкой',
        'с перламутровыми пуговицами', 'с нейлоном', 'с металлическими пуговицами',
    ];

    protected static array $patterns = [
        'в клетку', 'в полоску',
    ];

    protected static array $types = [
        'брюки', 'юбка', 'футболка', 'носки', 'толстовка', 'куртка', 'поло', 'шорты',
        'платье', 'костюм', 'бикини', 'блузка', 'боди', 'пальто', 'халат', 'жилет',
        'перчатки', 'чулки', 'пиджак', 'джемпер', 'комбинезон', 'купальник', 'плащ',
        'мантия', 'пальто', 'пуловер', 'пижама', 'рубашка', 'плавки', 'лонгслив',
    ];

    protected static array $formats = [
        // пальто в клетку
        '{{clothingType}} {{clothingPattern}}',
        // пальто в клетку из хлопка
        '{{clothingType}} {{clothingPattern}} {{clothingFabric}}',
        // пальто из хлопка в клетку
        '{{clothingType}} {{clothingFabric}} {{clothingPattern}}',
        // футболка в клетку из хлопка с принтом
        '{{clothingType}} {{clothingPattern}} {{clothingFabric}} {{clothingDecoration}}',
        // платье из плотного твила
        '{{clothingType}} {{clothingFabric}}',
        // футболка из хлопка с принтом
        '{{clothingType}} {{clothingFabric}} {{clothingDecoration}}',
        // футболка с фотопринтом
        '{{clothingType}} {{clothingDecoration}}',
    ];

    public function clothing(): string
    {
        $format = static::randomElement(self::$formats);

        return Str::ucfirst($this->generator->parse($format));
    }

    public function clothingType()
    {
        return static::randomElement(static::$types);
    }

    public function clothingFabric()
    {
        return static::randomElement(static::$fabrics);
    }

    public function clothingDecoration()
    {
        return static::randomElement(static::$decorations);
    }

    public function clothingPattern()
    {
        return static::randomElement(static::$patterns);
    }
}
