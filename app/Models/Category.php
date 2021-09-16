<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Category extends Model implements HasMedia, TranslatableContract
{
    use HasFactory, InteractsWithMedia ,Translatable;

    public $translatedAttributes = ['name'];

    protected $fillable = [ 'slug', 'renting_duration'];

    public function Products()
    {
        return $this->hasMany(Product::class);
    }

    public function Contract()
    {
        return $this->hasOne(ContractDocument::class);
    }
}
