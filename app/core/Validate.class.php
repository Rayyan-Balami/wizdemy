<?php

class Validate
{
    public static function string($value, $min = 1, $max = INF)
    {
        $value = trim($value);
        return strlen($value) >= $min && strlen($value) <= $max;
    }

    public static function email($value)
    {
        $value = trim($value);
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public static function equal($value1, $value2)
    {
        $value1 = trim($value1);
        $value2 = trim($value2);
        return $value1 === $value2;
    }

    public static function number($value, $min = 1, $max = INF)
    {
        $value = trim($value);
        return is_numeric($value) && $value >= $min && $value <= $max;
    }

    public static function phone($value)
    {
        $value = trim($value);
        return preg_match('/^\d{10,15}$/', $value);
    }

    public static function file($file, $type, $allowedType, $size = (2 * 1024 * 1024)) //default size is 2MB
    {
        if ($file['error'] !== 0) {
            return [
                'status' => false,
                'message' => 'File upload error'
            ];
        }

        if (!in_array($file['type'], $allowedType)) {
            return [
                'status' => false,
                'message' => 'Invalid file type'
            ];
        }

        //check if the size is allowed
        if ($file['size'] > $size) {
            return [
                'status' => false,
                'message' => $type . "must be smaller than " . $size / 1000000 . "MB"
            ];
        }

        return [
            'status' => true,
            'message' => 'File is valid'
        ];

    }

    //check if url is accessible
    public static function accessibleUrl($url)
    {
        $headers = @get_headers($url);
        if ($headers && strpos($headers[0], '200') !== false) {
            return true; // Link exists
        } else {
            return false; // Link does not exist or is inaccessible
        }
    }

}