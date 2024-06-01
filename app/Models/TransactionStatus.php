<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $transaction_id
 * @property int $transaction_status_type_id
 * @property string note
 * @property string created_at
 * @property string updated_at
 */
class TransactionStatus extends Model
{
    use HasFactory;

    protected $fillable = ['transaction_id', 'transaction_status_type_id', 'note'];

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }

    public function transactionStatusType(): BelongsTo
    {
        return $this->belongsTo(TransactionStatusType::class, 'transaction_status_type_id');
    }

    public function transactionStatusAttachments(): HasMany
    {
        return $this->hasMany(TransactionStatusAttachment::class, 'transaction_status_id');
    }
}
