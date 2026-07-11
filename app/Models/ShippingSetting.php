<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingSetting extends Model
{
    protected $fillable = [

        'shipping_type',

        'shipping_charge',

        'free_shipping_above',

        'cod_charge',

        'status'

    ];
}