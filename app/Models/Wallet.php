<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string name
 * @property integer user_id
 */
class Wallet extends Model
{
    use HasFactory;
    protected $fillable=['name', 'user_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function walletDetails(): HasMany
    {
        return $this->hasMany(WalletDetail::class,'wallet_id');
    }
}
