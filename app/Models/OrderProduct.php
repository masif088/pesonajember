<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int order_id
 * @property int partner_id
 * @property string name
 * @property double price
 * @property double quantity
 * @property double value
 */

class OrderProduct extends Model
{
    use HasFactory;
    protected $fillable = ['order_id', 'quantity', 'price','partner_id', 'name', 'value'];
    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function partner(){
        return $this->belongsTo(Partner::class);
    }
}
