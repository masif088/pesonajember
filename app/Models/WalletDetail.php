<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer wallet_id
 * @property integer user_id
 * @property string description
 * @property string date
 * @property double debit
 * @property double credit
 */
class WalletDetail extends Model
{

    use HasFactory;
    protected $fillable = ['wallet_id', 'user_id', 'description', 'date', 'debit', 'credit'];

    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class,'wallet_id','id');
    }
    public function user(): BelongsTo{
        return $this->belongsTo(User::class,'user_id','id');
    }
}
