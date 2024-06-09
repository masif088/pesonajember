<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property int transaction_id
 * @property int payment_status_id
 * @property int bank_id
 * @property string title
 * @property string payment_at
 * @property string schema
 * @property string amount
 * @property string amount_confirmation
 * @property string note
 * @property string created_at
 * @property string updated_at
 */

//$table->unsignedBigInteger('transaction_id');
//$table->unsignedBigInteger('payment_status_id');
//$table->unsignedBigInteger('bank_id');
//$table->string('title');
//$table->dateTime('payment_at');
//$table->string('schema');
//$table->decimal('amount', 16, 2);
//$table->decimal('amount_confirmation', 16, 2);
//$table->text('note');
class TransactionPayment extends Model
{
    use HasFactory;

    protected $fillable = ['transaction_id', 'payment_status_id', 'bank_id', 'title', 'payment_at', 'schema', 'amount', 'amount_confirmation', 'note'];

    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class);
    }

    public function paymentStatus(): BelongsTo
    {
        return $this->belongsTo(PaymentStatus::class);
    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

}
