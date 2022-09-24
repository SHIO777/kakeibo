<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;     // required to generate seed data

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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function kind()
    {
        return $this->belongsTo(Kind::class);
    }
}
