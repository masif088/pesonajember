<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer order_sharing_id
 * @property integer order_product_id
 * @property double  percentage
 */
class OrderSharingDetail extends Model
{
    use HasFactory;
    protected $fillable=['order_sharing_id','order_product_id', 'percentage'];

    public function orderSharing(): BelongsTo
    {
        return $this->belongsTo(OrderSharing::class,'order_sharing_id');
    }

    public function orderProduct(): BelongsTo
    {
        return $this->belongsTo(OrderProduct::class,'order_product_id');
    }
}
