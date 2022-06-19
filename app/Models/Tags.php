<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Tags extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [ "created_at" => "date:d-M-Y h:i a", "updated_at" => "date:d-M-Y h:i a" ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->slug = Str::slug($model->name);
        });
    }


    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class);
    }


}
