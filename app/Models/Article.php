<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @method where(string $string, $slug)
 */
class Article extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [ "created_at" => "date:d-M-Y h:i a" ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $random = substr(md5(mt_rand()), 0, 7);
            $model->slug = Str::slug($model->title.'-'.$random);
        });
    }
}
