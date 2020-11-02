<?php
// Code within app\Helpers\Helper.php
namespace App\Helpers;

use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Helpers
{
    public static function uploadImage(Request $request, $folderPath, $fieldName = 'image', $changeName = '')
    {
        $uploadedFile = @$request->file($fieldName);
        $fileName     = '';
        if (!empty($uploadedFile)) {
            $extension = $uploadedFile->getClientOriginalExtension(); // getting image extension
            if ($changeName != '') {
                $fileName = Str::slug($changeName) . rand(1, 100) . '.' . $extension;
            } else {
                $fileName = Helper::fixFilename($uploadedFile->getClientOriginalName(), '.' . $extension);
            }

            Storage::disk('public')->putFileAs(
                $folderPath,
                $uploadedFile,
                $fileName
            );
        }

        return $fileName ? $folderPath . $fileName : '';
    }

    public static function fixFilename($realFilename, $extension)
    {
        $title  = time() . Str::slug($realFilename);
        $lenStr = strlen($title) - 3;

        return substr($title, 0, $lenStr) . $extension;
    }
    public static function DateToString($date, $options = [])
    {
        if (!isset($date)) {
            return '-';
        }
        $time   = $date->format('g:i A');
        $timeString = ', ' . $time;

        if (isset($options['exclude_time'])) {
            $timeString = '';
        }

        $tgl    = $date->format('Y-m-d');
        $pecah  = explode("-", $tgl);
        $thnStr = $pecah[0];
        $tglStr = $pecah[2] . "";
        $blnStr = "";
        switch ($pecah[1]) {
            case '01':
                $blnStr = 'Januari';
                break;
            case '02':
                $blnStr = 'Februari';
                break;
            case '03':
                $blnStr = 'Maret';
                break;
            case '04':
                $blnStr = 'April';
                break;
            case '05':
                $blnStr = 'Mei';
                break;
            case '06':
                $blnStr = 'Juni';
                break;
            case '07':
                $blnStr = 'Juli';
                break;
            case '08':
                $blnStr = 'Agustus';
                break;
            case '09':
                $blnStr = 'September';
                break;
            case '10':
                $blnStr = 'Oktober';
                break;
            case '11':
                $blnStr = 'November';
                break;
            case '12':
                $blnStr = 'Desember';
                break;
        }

        return $tglStr . " " . $blnStr . " " . $thnStr . $timeString;
    }

    public static function dateDmy($date)
    {
        $pecah  = explode("-", $date);
        return $pecah[2] . "-" . $pecah[1] . "-" . $pecah[0];
    }
    public static function formatPrice($number, $currency = 'Rp ')
    {
        return $currency . number_format($number, 0, ',', '.');
    }

    public static function left($string, $length)
    {
        return substr($string,0,$length);
    }

    public static function rigth($string, $length)
    {
        return substr($string,-$length);
    }

    public static function realNumber($number)
    {
        $replace = ($number!='')?Helpers::left($number,strlen($number)-3):0;
       return str_replace('.','',$replace);
    }
}
