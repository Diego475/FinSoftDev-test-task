<?php

namespace App\Controllers;

use App\Classes\Future;
use Carbon\Carbon;

class FutureController extends Controller
{
    public function actionIndex()
    {
        // Генератор рандомных чисел и дат c временем получения
        $arr = [];
        for ($i = 0; $i < 5; $i++) {
            $arr[$i]["price"] = rand(1500, 12000);

            switch ($i) {
                case 0:
                    $arr[$i]["date"] = Carbon::now('Europe/Moscow')->isoFormat('D-MM-YYYY HH:mm:ss');
                    break;
                case 1:
                    $arr[$i]["date"] = Carbon::now('Europe/Moscow')->addMinutes(5)->isoFormat('D-MM-YYYY HH:mm:ss');
                    break;
                case 2:
                    $arr[$i]["date"] = Carbon::now('Europe/Moscow')->addMinutes(15)->isoFormat('D-MM-YYYY HH:mm:ss');
                    break;
                case 3:
                    $arr[$i]["date"] = Carbon::now('Europe/Moscow')->addHour()->isoFormat('D-MM-YYYY HH:mm:ss');
                    break;
                case 4:
                    $arr[$i]["date"] = Carbon::now('Europe/Moscow')->addHours(24)->isoFormat('D-MM-YYYY HH:mm:ss');
                    break;
                default:
                    $arr[$i]["date"] = Carbon::now('Europe/Moscow')->isoFormat('D-MM-YYYY HH:mm:ss');
                    break;
            }
        }

        // Пользуемся классом из тестового задания
        $obj = new Future();

        // Добавляем в хранилище
        foreach ($arr as $item) 
            $obj->add($item);
    
        // Возращаем в виде Json минимум, максимум, кол элементов и само хранилище
        return $this::response()->json([
            "min" => $obj->getMinValue(),
            "max" => $obj->getMaxValue(),
            "count" => $obj->count(),
            "storage" => $obj->storage,
        ]);
    }
}