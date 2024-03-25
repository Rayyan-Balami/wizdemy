<?php

/**
 * Validate class
 * 
 * This class contains methods for validating user input
 * 
 * methods: string, email, equal, number, phone, file, accessibleUrl
 */


class Validate
{
    /**
     * Check length of a string
     * 
     * @param string $value The string to check
     * @param int $min The minimum length of the string
     * @param int $max The maximum length of the string
     * 
     * @return bool True if the string is within the specified length, false otherwise
     */

    public static function string(string $value, int $min = 1, int $max = INF) : bool
    {
        $value = trim($value);
        return strlen($value) >= $min && strlen($value) <= $max;
    }

    /**
     * Check if a string is a valid email
     * 
     * @param string $value The string to check
     * 
     * @return bool True if the string is a valid email, false otherwise
     */
    public static function email(string $value) : bool
    {
        $value = trim($value);
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Check if two strings are equal
     * 
     * @param string $value1 The first string
     * @param string $value2 The second string
     * 
     * @return bool True if the strings are equal, false otherwise
     */

    public static function equal(string $value1, string $value2) : bool
    {
        $value1 = trim($value1);
        $value2 = trim($value2);
        return $value1 === $value2;
    }

    /**
     * Check if a number is within a specified range
     * 
     * @param int $value The number to check
     * @param int $min The minimum value of the number
     * @param int $max The maximum value of the number
     * 
     * @return bool True if the number is within the specified range, false otherwise
     */
    public static function number(int $value, int $min, int $max) : bool
    {
        $value = trim($value);
        return is_numeric($value) && $value >= $min && $value <= $max;
    }

    /**
     * Check if a phone number is valid
     * 
     * @param string $value The phone number to check
     * 
     * @return bool True if the phone number is valid, false otherwise
     */
    public static function phone(string $value) : bool
    {
        $value = trim($value);
        return preg_match('/^\d{10,15}$/', $value);
    }

    /**
     * Check if a file is valid
     * 
     * @param array $file The file to check
     * @param string $type The type of file
     * @param array $allowedType The allowed types of file
     * @param int $size The maximum size of the file
     * 
     * @return array An array containing the status and message of the file
     */
    public static function file(array $file, string $type, array $allowedType, int $size) : array
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

    /**
     * Check if a URL is accessible
     * 
     * @param string $url The URL to check
     * 
     * @return bool True if the URL is accessible, false otherwise
     */
    public static function accessibleUrl(string $url) : bool
    {
        $headers = @get_headers($url);
        if ($headers && strpos($headers[0], '200') !== false) {
            return true; // Link exists
        } else {
            return false; // Link does not exist or is inaccessible
        }
    }

}