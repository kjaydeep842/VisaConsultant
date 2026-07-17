<?php

if (!function_exists('storageFile')) {
    function storageFile($path)
    {
        if (!$path) {
            return asset('images/no-image.png');
        }

        return url('file/' . ltrim($path, '/'));
    }
}
