<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'type', 'payment_type', 'state', 'city', 'street', 'post_code', 'company_name', 'commercial_register', 'tax_number',  'phone', 'status', 'product_id', 'inquiry', 'email', 'result_code', 'result_description', 'total_price', 'renting_duration'];

    public function Product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function Contract()
    {
        return $this->hasOne(Contract::class);
    }
}
