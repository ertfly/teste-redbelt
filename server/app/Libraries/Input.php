<?php

namespace App\Libraries;

use App\Libraries\FormValidation\FormValidation;
use Exception;

/**
 * Description of Uri
 *
 * @author Eric Teixeira
 */
class Input
{
    /**
     * Undocumented variable
     *
     * @var array
     */
    private static $json;

    public static function get($key, $description = null, $validations = null, $options = null)
    {
        $value = request()->query($key);

        if (!isset($value)) {
            return null;
        }

        if (is_array($value)) {
            self::inputArray($value);
            return $value;
        }

        $value = Strings::removeInvisibleCharacters($value, FALSE);
        if (trim($value) == '' && !isset($description)) {
            return null;
        }

        if (isset($description) && isset($validations) && is_string($description) && is_array($validations) && count($validations) > 0) {
            new FormValidation($value, $description, $validations, $options);
        }

        return trim($value);
    }

    private static function inputArray(&$array)
    {
        foreach ($array as &$value) {
            if (!is_array($value)) {
                $value = trim(Strings::removeInvisibleCharacters($value, FALSE));
                continue;
            }
            self::inputArray($value);
        }
    }

    public static function post($key, $description = null, $validations = null, $options = null)
    {
        $value = request()->post($key);
        if (!isset($value) && !isset($description)) {
            return null;
        }

        if (!isset($value) && isset($description)) {
            $value = null;
        }

        if (is_array($value)) {
            self::inputArray($value);
            return $value;
        }

        $value = Strings::removeInvisibleCharacters($value, FALSE);
        if (trim($value) == '' && !isset($description)) {
            return null;
        }

        if (isset($description) && isset($validations) && is_string($description) && is_array($validations) && count($validations) > 0) {
            new FormValidation($value, $description, $validations, $options);
        }

        return trim($value);
    }

    /**
     * @param $key
     * @param null $description
     * @param null $validations
     * @param null $options
     * @return bool
     * @throws Exception
     */
    public static function json($key, $description = null, $validations = null, $options = null)
    {
        $value = request()->json($key);

        if (!isset($value) && !isset($description)) {
            return null;
        }

        if (!isset($value) && isset($description)) {
            $value = null;
        }

        if (is_array($value)) {
            self::inputArray($value);
            return $value;
        }

        $value = Strings::removeInvisibleCharacters($value, FALSE);
        if (trim($value) == '' && !isset($description)) {
            return null;
        }

        if (isset($description) && isset($validations) && is_string($description) && is_array($validations) && count($validations) > 0) {
            new FormValidation($value, $description, $validations, $options);
        }

        return trim($value);
    }
}
