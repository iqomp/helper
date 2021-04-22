<?php

/**
 * Various global functions
 * @package iqomp/helper
 * @version 0.0.1
 */

/**
 * Get thruly value from multiple options
 * @param mixex $arg Value to compare
 * @return mixed thruly value
 */
function alt(...$args)
{
    foreach ($args as $arg) {
        if (!!$arg) {
            return $arg;
        }
    }
}

/**
 * Printout vars for debuging purpose
 * @param mixed $args Variable to print
 * @return void
 */
function deb(...$args): void
{
    ob_start();

    foreach ($args as $arg) {
        if (is_null($arg)) {
            echo 'NULL';
        } elseif (is_bool($arg)) {
            echo $arg ? 'TRUE' : 'FALSE';
        } else {
            $arg = print_r($arg, true);
            echo $arg;
        }
        echo PHP_EOL;
    }

    $ctx = ob_get_contents();
    ob_end_clean();

    echo $ctx;
    exit;
}

/**
 * Group list of object by property of the object
 * @param array $array List of object
 * @param string $prop Grouping by object property value
 * @return array Grouped object by property
 */
function group_by_prop(array $array, string $prop): array
{
    $res = [];
    foreach ($array as $arr) {
        $key = is_object($arr) ? $arr->$prop : $arr[$prop];

        if (is_object($key)) {
            $key = $key->__toString();
        }

        if (!isset($res[$key])) {
            $res[$key] = [];
        }
        $res[$key][] = $arr;
    }

    return $res;
}

/**
 * Shorthand for htmlspeciachars
 * @param string $str String to encode
 * @return string encoded string
 */
function hs(string $str): string
{
    return htmlspecialchars($str, ENT_QUOTES);
}

/**
 * Check if the array is indexed array
 * @param array $array The array to check
 * @return boolean true on indexed array
 */
function is_indexed_array(array $array): bool
{
    if (!$array) {
        return true;
    }

    return array_keys($array) === range(0, count($array) - 1);
}

/**
 * Replace object old property to the new one
 * @param object $origin Original object
 * @param object $new Source of new object property value
 * @return object The replaced object properties.
 */
function object_replace(object $origin, object $new): object
{
    $cloned = clone $origin;
    foreach ($new as $key => $val) {
        $cloned->$key = $val;
    }

    return $cloned;
}

/**
 * Convert the array value to object
 * @param mixed $arr The data to convert
 * @return mixed converted value
 */
function objectify($arr)
{
    if (!is_array($arr)) {
        return $arr;
    }

    foreach ($arr as $key => $val) {
        $arr[$key] = objectify($val);
    }

    if (is_indexed_array($arr)) {
        return $arr;
    }

    return (object)$arr;
}

/**
 * Use array object property as array key
 * @param array $array List of object to process
 * @param string $prop Object property to use as array key
 * @return array prop_val-object pair of new array
 */
function prop_as_key(array $array, string $prop): array
{
    $res = [];
    foreach ($array as $arr) {
        $key = is_array($arr) ? $arr[$prop] : $arr->$prop;
        if (is_object($key)) {
            $key = (string)$key;
        }
        $res[$key] = $arr;
    }

    return $res;
}

/**
 * Convert standard string to slug style
 * @param string $str The string to convert
 * @return string slug style of the string
 */
function to_slug(string $str): string
{
    $str = strtolower($str);
    $str = preg_replace('![^a-z0-9]!', '-', $str);
    $str = preg_replace('!-+!', '-', $str);

    return $str;
}
