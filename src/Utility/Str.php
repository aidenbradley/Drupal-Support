<?php

namespace Drupal\drupal_support\Utility;

class Str
{
    public static function camelCase(string $string, string $separator = '_'): string
    {
        return str_replace($separator, '', lcfirst(ucwords($string, $separator)));
    }

    public static function pascalCase(string $string, string $seperator = '_'): string
    {
        return ucfirst(self::camelCase(...func_get_args()));
    }

    /**
     * Determine if a given string starts with a given substring.
     *
     * @param  string  $haystack
     * @param  string|string[]  $needles
     * @return bool
     */
    public static function startsWith($haystack, $needles)
    {
        foreach ((array) $needles as $needle) {
            if ((string) $needle !== '' && strncmp($haystack, $needle, strlen($needle)) === 0) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine if a given string ends with a given substring.
     *
     * @param  string  $haystack
     * @param  string|string[]  $needles
     * @return bool
     */
    public static function endsWith($haystack, $needles)
    {
        foreach ((array) $needles as $needle) {
            if ($needle !== '' && substr($haystack, -strlen($needle)) === (string) $needle) {
                return true;
            }
        }

        return false;
    }
}

