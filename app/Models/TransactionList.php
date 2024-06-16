<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $transaction_id
 * @property int $transaction_detail_type_id
 * @property int $transaction_list_id
 * @property int $product_id
 * @property int $shipper_id
 * @property int $status_id
 * @property string $shipper_category

 * @property string $amount
 * @property float $price
 */
class TransactionList extends Model
{
    use HasFactory;

    protected $fillable = ['transaction_detail_type_id', 'product_id', 'shipper_id', 'shipper_category', 'amount', 'price', 'transaction_id', 'transaction_list_id', 'status_id'];

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }

    public function transactionDetailType(): BelongsTo
    {
        return $this->belongsTo(TransactionDetailType::class, 'transaction_detail_type_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id')->withTrashed();
    }

    public function shipper(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'shipper_id')->withTrashed();
    }

    public function transactionList(): BelongsTo
    {
        return $this->belongsTo(TransactionList::class, 'transaction_list_id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function transactionLists(): HasMany
    {
        return $this->hasMany(TransactionList::class, 'transaction_list_id');
    }
}
