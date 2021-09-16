<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnvironmentService extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'city', 'phone', 'email', 'service_type', 'project_nature', 'accept_type', 'project_type'];
}
