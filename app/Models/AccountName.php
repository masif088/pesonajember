<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $account_category_id
 * @property int $status_id
 * @property string $code
 * @property string $title
 * @property string $note
 * @property string $level
 * @property int $additional_cost
 * @property string $created_at
 * @property string $updated_at
 */
class AccountName extends Model
{
    use HasFactory;
    protected $fillable=['account_category_id', 'level','code', 'title', 'note', 'additional_cost','status_id'];

    public function accountCategory(): BelongsTo
    {
        return $this->belongsTo(AccountCategory::class,'account_category_id');
    }

    public function productAdditionalCosts(): HasMany
    {
        return $this->hasMany(ProductAdditionalCost::class,'account_name_id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class,'status_id');
    }
}
