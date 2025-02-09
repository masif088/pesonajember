<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int order_id
 * @property int partner_id
 * @property string invoice_number
 * @property double shipping_cost
 * @property double down_payment
 * @property double tax
 */

class OrderInvoice extends Model
{
    use HasFactory;

    protected $fillable=['order_id', 'partner_id', 'invoice_number', 'shipping_cost', 'down_payment', 'tax'];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class,'order_id');
    }
    public function partner(): BelongsTo{
        return $this->belongsTo(Partner::class,'partner_id');
    }
}
