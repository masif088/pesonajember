<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer order_product_out_id
 * @property integer order_product_id
 * @property double quantity
 */
class OrderProductOutDetail extends Model
{
    use HasFactory;
    protected $fillable = ['quantity','order_product_id','order_product_out_id'];

    public function orderProductOut(): BelongsTo
    {
        return $this->belongsTo(OrderProductOut::class,'order_product_out_id','id');
    }

    public function orderProduct(): BelongsTo
    {
        return $this->belongsTo(OrderProduct::class,'order_product_id','id');
    }
}
