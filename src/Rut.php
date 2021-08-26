<?php

namespace Innovaweb\ChileanRut;

class Rut
{
    /**
     * Format the rut according to the assigned parameters, if withDotted is true it will always return with a hyphen
     * @param string $rut rut with any of these formats 11.111.111-1, 11111111-1, 111111111
     * @param bool $withDotted return rut with dots format, default true
     * @param bool $withHyphen return rut with hyphen format. default true
     * @return string
     */
    public static function format(string $rut, bool $withDotted = true, bool $withHyphen = true): string
    {
        $rut = self::unformat($rut);

        $number = substr($rut, 0, -1);
        $dv = substr($rut, -1);

        if ($withDotted) {
            $number = substr_replace($number, '.', -3, 0);
            $number = substr_replace($number, '.', -7, 0);
        }

        $hyphen = $withHyphen || $withDotted ? '-' : '';
        return "{$number}{$hyphen}{$dv}";
    }

    /**
     * Clean the rut of spaces, dots and hyphens
     * @param string $rut rut with any of these formats 11.111.111-1, 11111111-1, 111111111
     * @return string
     */
    public static function unformat(string $rut): string
    {
        return (string)str_replace([' ', '.', '-', ','], '', $rut);
    }

    /**
     * Check if the code is valid with the validation algorithm
     * @param string $rut rut with any of these formats 11.111.111-1, 11111111-1, 111111111
     * @return bool
     */
    public static function validate(string $rut): bool
    {

        $rut = self::format($rut, false);

        if (!preg_match("/^[0-9]+-[0-9kK]{1}/", $rut)) {
            return false;
        }
        $rut = explode('-', $rut);
        return strtolower($rut[1]) == self::calculateDv($rut[0]);
    }

    /**
     * calculates the check digit from a sequential rut number
     * @param int $number only the number of rut as integer type
     * @return string
     */
    public static function calculateDv(int $number): string
    {
        $M = 0;
        $S = 1;
        for (; $number; $number = floor($number / 10))
            $S = ($S + $number % 10 * (9 - $M++ % 6)) % 11;
        return $S ? $S - 1 : 'K';
    }

    /**
     * Extract the numerical part of the rut, can return with points according to the parameters
     * @param string $rut rut with any of these formats 11.111.111-1, 11111111-1, 111111111
     * @param bool $withDotted return rut with dots format, default true
     * @return string
     */
    public static function getNumber(string $rut, bool $withDotted = false): string
    {
        $rut = self::format($rut, false);
        if (!preg_match("/^[0-9]+-[0-9kK]{1}/", $rut)) {
            return false;
        }
        $rut = explode('-', $rut);
        $number = $rut[0];
        if ($withDotted) {
            $number = substr_replace($number, '.', -3, 0);
            $number = substr_replace($number, '.', -7, 0);
        }
        return $number;
    }

    /**
     * Extract the check digit part of the rut
     * @param string $rut rut with any of these formats 11.111.111-1, 11111111-1, 111111111
     * @return string
     */
    public static function getDv(string $rut): string
    {
        $rut = self::format($rut, false);
        if (!preg_match("/^[0-9]+-[0-9kK]{1}/", $rut)) {
            return false;
        }
        $rut = explode('-', $rut);
        return $rut[1];
    }

}
