<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $account_group_id
 * @property string $title
 * @property string $code
 * @property string $created_at
 * @property string $updated_at
 */
//$table->string('title');
//$table->string('code');
//$table->unsignedBigInteger('account_group_id');
class AccountCategory extends Model
{
    use HasFactory;
    protected $fillable=['account_group_id', 'title', 'code'];

    public function accountGroup(): BelongsTo
    {
        return $this->belongsTo(AccountGroup::class,'account_group_id');
    }

    public function accountNames(): HasMany
    {
        return $this->hasMany(AccountName::class,'account_category_id');
    }
}
