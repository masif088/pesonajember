<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $account_type_id
 * @property string $code
 * @property string $parent
 * @property string $title
 * @property string $created_at
 * @property string $updated_at
 */
class AccountGroup extends Model
{
    use HasFactory;
    protected $fillable=['account_type_id', 'parent','code', 'title'];

    public function accountType(): BelongsTo
    {
        return $this->belongsTo(AccountType::class,'account_type_id');
    }
    public function accountCategories(): HasMany
    {
        return $this->hasMany(AccountCategory::class,'account_group_id');
    }
}
