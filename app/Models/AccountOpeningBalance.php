<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $account_name_id
 * @property int $month
 * @property int $year
 * @property float $opening_balances
 * @property string $created_at
 * @property string $updated_at
 */
//$table->unsignedBigInteger('account_name_id');
//$table->integer('month');
//$table->integer('year');
//$table->decimal('opening_balances', 16, 2);
class AccountOpeningBalance extends Model
{
    use HasFactory;

    protected $fillable = ['account_name_id', 'month', 'year', 'opening_balances'];

    public function accountName(): BelongsTo
    {
        return $this->belongsTo(AccountName::class, 'account_name_id');
    }
}
