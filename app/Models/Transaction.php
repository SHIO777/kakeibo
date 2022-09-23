<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [
        'id',
        'created_at',
        // 'kind_id',
        // 'category_id',
        'updated_at',
    ];

    // public static function getAllOrderByUpdated_at()
    // {
    //     // selfはKindモデルのこと
    //     return self::orderBy('updated_at', 'desc')->get();
    // }
}
