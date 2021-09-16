<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['contract_id', 'amount', 'renting_duration', 'end_at', 'result_code', 'result_description'];

    public function Contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
