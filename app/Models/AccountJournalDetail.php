<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $account_journal_id
 * @property int $account_name_id
 * @property float $debit
 * @property float $credit
 * @property string $note
 * @property string $created_at
 * @property string $updated_at
 */
//$table->unsignedBigInteger('account_journal_id');
//$table->decimal('debit');
//$table->decimal('credit');
//$table->text('note');
class AccountJournalDetail extends Model
{
    use HasFactory;
    protected $fillable=['account_name_id','account_journal_id', 'debit', 'credit', 'note'];

    public function accountJournal(): BelongsTo
    {
        return $this->belongsTo(AccountJournal::class,'account_journal_id');
    }

    public function accountName(): BelongsTo
    {
        return $this->belongsTo(AccountName::class,'account_name_id');
    }
}
