<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;

class FormatterController extends Controller
{
    public function uploadImage($file)
    {
        $newFile = Image::make($file)->resize(500, null, function ($constraint) {
            $constraint->aspectRatio();
        })->stream('webp', 100);

        return $newFile;
    }
    public function phoneFormat($data)
    {
        $number = str_replace(array('-', '_'), '', $data->phone);
        $getnumber = substr($number, 0, 1);
        $regional = 62;
        if ($getnumber == 0) {
            $phone = $regional . substr($number, 1);
        } elseif ($getnumber == 8) {
            $phone = $regional . $number;
        } elseif ($getnumber == 6) {
            $phone = $number;
        } else {
            $phone = $number;
        }
        return $phone;
    }
    public function phoneDeformat($data)
    {
        $cek = substr($data->phone, 0, 2);
        if ($cek == 62) {
            $phone = substr($data->phone, 2);
            $phone = '0' . $phone;
        } else {
            $phone = $data->phone;
        }
        return $phone;
    }
}
