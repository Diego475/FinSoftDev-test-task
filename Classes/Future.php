<?php

namespace App\Classes;

use Carbon\Carbon;

class Future
{
    public $storage;
    protected $min;
    protected $max;

    public function __construct()
    {
        $this->storage = [];
    }

    /**
     * Добавление нового элемента в хранилище
     * 
     * @return void
     */
    public function add(array $value) : void
    {
        // Парсим полученую дату
        $date = Carbon::parse($value["date"], 'Europe/Moscow');
        $price = $value["price"];

        // Проверка, если полученная дата больше 24 часов, не добавляем
        if (!$date->diffInDays(Carbon::now())) {

            // Проверки на мин и макс
            if (is_null($this->max)) $this->max = $price;
            else if ($price > $this->max) $this->max = $price;
            if (is_null($this->min)) $this->min = $price;
            else if ($price < $this->min) $this->min = $price;

            // Единственный цикл для задачи, который отвечает только за проверку, прохождения 24 часов
            for ($i = 0; $i <= count($this->storage); $i++) {
                $date = Carbon::parse($value["date"], 'Europe/Moscow');
                if ($date->diffInDays(Carbon::now()))
                    unset($this->store[$i]);
            }
            
            $this->storage[] = $value;
        }

    }

    /**
     * Получить минимальное значение из хранилища
     * 
     * @return int
     */
    public function getMinValue() : int
    {
        return $this->min ?? 0;
    }

    /**
     * Получить максимальное значение из хранилища
     * 
     * @return int
     */
    public function getMaxValue() : int
    {
        return $this->max ?? 0;
    }

    /**
     * Получить количество элементов в хранилище
     */
    public function count() : int
    {
        return count($this->storage);
    }
}