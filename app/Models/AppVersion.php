<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppVersion extends Model
{
    protected $fillable = [
        'version',
        'title',
        'changelog',
        'is_active',
    ];

    // Ambil versi aktif sekarang
    public static function current()
    {
        return self::where('is_active', true)->latest('created_at')->first();
    }
}
