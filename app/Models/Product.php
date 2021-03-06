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

    protected $fillable = [ 'category_id' ,'active', 'sell_price', 'buy_price', 'stock'  , 'slug'];

    protected $appends = ['profit_percent'];

    public function getProfitPercentAttribute()
    {
        $profit = ( ( $this->sell_price - $this->buy_price ) * 100 );
        return number_format($profit / $this->buy_price, 2) . ' %';
    }

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
        return $this->belongsToMany(Order::class, 'product_order');
    }
}
