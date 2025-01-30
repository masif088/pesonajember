<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int order_id
 * @property int partner_id
 * @property string note
 * @property string reference_product_out
 * @property string reference_waybill
 * @property string proof_of_product_out
 * @property string proof_of_waybill
 */
class OrderProductOut extends Model
{
    use HasFactory;
    protected $fillable =['order_id','partner_id','note','reference_product_out', 'reference_waybill','proof_of_product_out', 'proof_of_waybill','date_product_out','date_waybill'];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class,'order_id');
    }

    public function orderProductOutDetails(): HasMany
    {
        return $this->hasMany(OrderProductOutDetail::class,'order_product_out_id');
    }
}
