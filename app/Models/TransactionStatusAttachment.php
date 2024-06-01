<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

//$table->unsignedBigInteger('transaction_status_id');
//            $table->string('key');
//            $table->text('value');
//            $table->string('type');

/**
 * @property int $id
 * @property int $transaction_status_id
 * @property string $key
 * @property string $value
 * @property string $type
 * @property string $created_at
 * @property string $updated_at
 */
class TransactionStatusAttachment extends Model
{
    use HasFactory;

    protected $fillable = ['transaction_status_id', 'key', 'value', 'type'];

    public function transactionStatus(): BelongsTo
    {
        return $this->belongsTo(TransactionStatus::class, 'transaction_status_id');
    }
}
