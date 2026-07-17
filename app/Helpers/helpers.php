<?php

if (!function_exists('storageFile')) {
    function storageFile($path)
    {
        if (!$path) {
            return asset('images/no-image.png');
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        return url('file/' . ltrim($path, '/'));
    }
}
