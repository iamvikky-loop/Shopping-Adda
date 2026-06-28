<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
    ];

    public function values()
    {
        return $this->hasMany(AttributeValue::class);
    }
}