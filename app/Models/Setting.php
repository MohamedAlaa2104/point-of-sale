<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Setting extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['name_ar', 'name_en', 'keywords_ar', 'keywords_en', 'description_ar', 'description_en', 'email', 'phone', 'website_link', 'address_ar', 'address_en', 'facebook', 'twitter', 'youtube', 'instagram', 'linkedin', 'map'];
}
