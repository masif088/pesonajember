<?php

use Carbon\Carbon;

if (!function_exists('array_to_object')) {
    function array_to_object($array)
    {
        return json_decode(json_encode($array));
    }
}
if (!function_exists('eloquent_to_options')) {
    function eloquent_to_options($array, $value = 'id', $title = 'title')
    {
        $arr = [];
        foreach ($array as $index => $a) {
            $arr[$index]['value'] = $a->$value;
            $arr[$index]['title'] = $a->$title;
        }
        return $arr;
    }
}
if (!function_exists('redirect_production')) {
    function redirect_production($tsId)
    {
        switch ($tsId) {
            case 4:
                return redirect(route('transaction.pattern-site'));
            case 5:
                return redirect(route('transaction.sample-site'));
            case 6:
                return redirect(route('transaction.production.tab', 'Potong'));
            case 7:
                return redirect(route('transaction.production.tab', 'Print'));
            case 8:
                return redirect(route('transaction.production.tab', 'Pasang-Label'));
            case 9:
                return redirect(route('transaction.production.tab', 'Jahit'));
            case 10:
                return redirect(route('transaction.production.tab', 'Quality-Control'));
            case 11:
                return redirect(route('transaction.production.tab', 'Packing'));
            case 12:
                return redirect(route('transaction.index', 'Pengiriman'));
            case 13:
                return redirect(route('transaction.index', 'Pengiriman'));
            default:
                return redirect(route('transaction.production'));
        }
    }
}
if (!function_exists('quickRandom')) {
    function quickRandom($length = 16)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }
}
if (!function_exists('month_name')) {
    function month_name($month)
    {
        $monthName = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        return $monthName[$month];
    }
}

if (!function_exists('get_date_format')) {
    function get_date_format($date)
    {
        return $date->format('d') . ' ' . month_name(intval($date->format('m'))) . ' ' . $date->format('Y');
    }
}


if (!function_exists('numberToRomanRepresentation')) {
    function numberToRomanRepresentation($number)
    {
        $map = ['M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1];
        $returnValue = '';
        while ($number > 0) {
            foreach ($map as $roman => $int) {
                if ($number >= $int) {
                    $number -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
    }
}
if (!function_exists('empty_fallback')) {
    function empty_fallback($data)
    {
        return ($data) ? $data : "-";
    }
}

if (!function_exists('blank_model')) {
    function blank_model($array)
    {
        $data = [];
        foreach ($array as $arr) {
            if ($arr == "created_at" or $arr == "updated_at") {
                $data[$arr] = Carbon::now();
            } else {
                $data[$arr] = null;
            }
        }
        return $data;
    }
}

if (!function_exists('form_model')) {
    function form_model($repository, $dataId = null, $action = "create")
    {
        $array = [];
        foreach ($repository::formField($action) as $model) {
            if (isset($model['blank'])) {
                $array[$model['model']] = $model['blank'];
            } else {
                $array[$model['model']] = type_to_null($model['type']);
            }
        }
        if ($dataId != null) {
            foreach ($repository::find($dataId)->toArray() as $index => $r) {
                $array[$index] = $r;
            }
        }
        $model['name'] = 1;
        return $array;


    }
}

if (!function_exists('type_to_null')) {
    function type_to_null($string)
    {
        switch ($string) {
            case 'number':
                return 0;
            case 'text':
            case 'textarea':
            case 'summernote':
                return '';
            case 'file':
            case 'select':
                return null;
            case 'date':
                return Carbon::now()->format('Y-m-d');
            case 'time':
                return Carbon::now()->format('H:i');
            case 'datetime-local':
                return Carbon::now()->format('Y-m-d H:i');
            case 'select2':
                return [];

        }
    }
}


if (!function_exists('thousand_format')) {
    function thousand_format($integer)
    {
        return number_format($integer, '0', ',', '.');
    }
}

if (!function_exists('increase_check')) {
    function increase_check($integer)
    {
        if ($integer < 0) {
            return 'text-red-500 bg-red-100';
        } elseif ($integer > 0) {
            return 'text-green-500 bg-green-100';
        } else {
            return 'text-gray-500 bg-gray-100';
        }
    }
}


