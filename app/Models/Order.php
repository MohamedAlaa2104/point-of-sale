<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'total_price'];

    public function Client()
    {
        return $this->belongsTo(Customer::class);
    }
    public function Products()
    {
        return $this->belongsToMany(Product::class, 'product_order');
    }

}
