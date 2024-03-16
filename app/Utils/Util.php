<?php

namespace App\Utils;

class Util
{


    public static function calculateUpfrontFromProducts($products) : float
    {
        $upfront = 0;
        foreach ($products as $product) {
            $upfront += $product->upfront;
        }
        return $upfront;
    }

    public static function removeZeroValuesInArray($array) : array
    {
        return array_filter($array, fn($value) => $value !== "0");
    }



}
