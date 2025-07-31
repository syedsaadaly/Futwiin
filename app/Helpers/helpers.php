<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\ApplicationSetting;
use App\Models\{User, Cart};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

if (!function_exists('app_setting')) {
    function app_setting($key, $default = null)
    {
        // $setting = ApplicationSetting::where('key', $key)->first();
        // return $setting ? $setting->value : $default;
    }
}

if (!function_exists('encrypt_decrypt')) {

    function encrypt_decrypt($action, $string)
    {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = env('SECRET_KEY');
        $secret_iv = env('SECRET_IV');
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        if ($action == 'encrypt') {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if ($action == 'decrypt') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }
}
