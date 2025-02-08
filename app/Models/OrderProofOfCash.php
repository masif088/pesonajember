<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int order_id
 * @property int partner_id
 * @property string note
 * @property double nominal
 * @property string pic
 * @property string proof_of_cash_number
 */
class OrderProofOfCash extends Model
{
    use HasFactory;

    protected $fillable = ['order_id','partner_id', 'note', 'nominal', 'pic','proof_of_cash_number'];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class, 'partner_id');
    }
}
