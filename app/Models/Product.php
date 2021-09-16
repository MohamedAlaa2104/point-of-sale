<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Product extends Model implements HasMedia, TranslatableContract
{
    use HasFactory, InteractsWithMedia ,Translatable;

    public $translatedAttributes = ['name', 'description'];

    protected $fillable = [ 'category_id' ,'active', 'sell_price', 'buy_price'  , 'slug'];

    public function scopeActive($query, $val)
    {
        return $query->where('active', $val);
    }

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }

    public function Orders()
    {
        return $this->hasMany(Order::class);
    }
}
