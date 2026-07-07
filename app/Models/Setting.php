<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Facades\DB;
use Illuminate\Support\Facades\Cache;

class Setting extends \Illuminate\Database\Eloquent\Model
{
    protected $fillable = ['key', 'value', 'group', 'type'];

    public static function get(string $key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    public static function set(string $key, $value, string $group = 'general', string $type = 'text')
    {
        return static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'group' => $group, 'type' => $type]
        );
    }

    public static function getGroup(string $group): array
    {
        return static::where('group', $group)->pluck('value', 'key')->toArray();
    }
}
