<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int order_id
 * @property int partner_id
 */
class OrderPartner extends Model
{
    use HasFactory;
    protected $fillable = ['order_id', 'partner_id'];
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
    public function partner(): BelongsTo{
        return $this->belongsTo(Partner::class);
    }

}
