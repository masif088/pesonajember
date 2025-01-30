<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer order_id
 * @property string title
 */

class OrderSharing extends Model
{
    use HasFactory;
    protected $fillable=['order_id', 'title'];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class,'order_id');
    }

    public function orderSharingDetails(): HasMany
    {
        return $this->hasMany(OrderSharingDetail::class,'order_sharing_id');
    }
}
