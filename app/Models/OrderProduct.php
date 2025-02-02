<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int order_id
 * @property int partner_id
 * @property string name
 * @property double price
 * @property double quantity
 * @property double value
 * @property double hpp
 * @property double hpp_value
 */

class OrderProduct extends Model
{
    use HasFactory;
    protected $fillable = ['order_id', 'quantity', 'price','partner_id', 'name', 'value','hpp', 'hpp_value','pph'];
    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function partner(){
        return $this->belongsTo(Partner::class);
    }
    public function orderProductOutDetails(): HasMany
    {
        return $this->hasMany(OrderProductOutDetail::class,'order_product_id');
    }
}
