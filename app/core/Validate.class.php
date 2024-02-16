<?php

class Validate
{
    public static function string($value,$min=1,$max=INF)
    {
        $value = trim($value);
        return strlen($value) >= $min && strlen($value) <= $max;
    }

    public static function email($value)
    {
        $value = trim($value);
        return filter_var($value,FILTER_VALIDATE_EMAIL);
    }

    public static function equal($value1,$value2)
    {
        $value1 = trim($value1);
        $value2 = trim($value2);
        return $value1 === $value2;
    }
  }