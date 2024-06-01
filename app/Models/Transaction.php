<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $customer_id
 * @property int $payment_model_id
 * @property int $shipper_id
 * @property string $shipping_receipt_number
 * @property string $transaction_status_id
 * @property string $uid
 * @property int $total_money
 * @property int $tax
 * @property string $note
 */
class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['uid','customer_id', 'payment_model_id', 'shipper_id', 'shipping_receipt_number', 'total_money', 'note','tax', 'transaction_status_id'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function paymentModel(): BelongsTo
    {
        return $this->belongsTo(PaymentModel::class, 'customer_id');
    }

    public function shipper(): BelongsTo
    {
        return $this->belongsTo(Shipper::class);
    }

    public function transactionLists(): HasMany
    {
        return $this->hasMany(TransactionList::class, 'transaction_id');
    }

    public function transactionStatus(): BelongsTo
    {
        return $this->belongsTo(TransactionStatus::class,'transaction_status_id');
    }

    public function transactionStatuses(): HasMany
    {
        return $this->hasMany(TransactionStatus::class,'transaction_id');
    }
}
