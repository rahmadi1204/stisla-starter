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
    public function imageFormat($img)
    {
        $file = storage_path('app/public/images/' . $img);
        $image = base64_encode(file_get_contents($file));
        $img = 'data:image/jpeg;charset=utf-8;base64,' . $image;
        return $img;
    }
    public function phoneFormat($num)
    {
        $number = str_replace(array('-', '_'), '', $num);
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
    public function phoneDeformat($num)
    {
        $cek = substr($num, 0, 2);
        if ($cek == 62) {
            $phone = substr($num, 2);
            $phone = '0' . $phone;
        } else {
            $phone = $num;
        }
        return $phone;
    }
    public function changeEnv($data = array())
    {
        if (count($data) > 0) {

            // Read .env-file
            $env = file_get_contents(base_path() . '/.env');

            // Split string on every " " and write into array
            $env = preg_split('/\s+/', $env);

            // Loop through given data
            foreach ((array) $data as $key => $value) {

                // Loop through .env-data
                foreach ($env as $env_key => $env_value) {

                    // Turn the value into an array and stop after the first split
                    // So it's not possible to split e.g. the App-Key by accident
                    $entry = explode("=", $env_value, 2);

                    // Check, if new key fits the actual .env-key
                    if ($entry[0] == $key) {
                        // If yes, overwrite it with the new one
                        $env[$env_key] = $key . "=" . $value;
                    } else {
                        // If not, keep the old one
                        $env[$env_key] = $env_value;
                    }
                }
            }

            // Turn the array back to an String
            $env = implode("\n", $env);

            // And overwrite the .env with the new data
            file_put_contents(base_path() . '/.env', $env);

            return true;
        } else {
            return false;
        }
    }
}
