<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $guarded = [];
    protected $primaryKey = ['order_id', 'product_id'];
    public $incrementing = false;
    public $timestamps = false;
}
