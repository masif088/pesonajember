<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $user_id
 * @property string $journal_date
 * @property string $created_at
 * @property string $updated_at
 */

class AccountJournal extends Model
{
    use HasFactory;
    protected $fillable=['user_id', 'journal_date'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function accountJournalDetails(): HasMany
    {
        return $this->hasMany(AccountJournalDetail::class,'account_journal_id');
    }
}
