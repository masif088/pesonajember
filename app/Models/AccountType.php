<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $code
 * @property string $title
 * @property string $created_at
 * @property string $updated_at
 */
class AccountType extends Model
{
    use HasFactory;
    protected $fillable=['code', 'title'];

    public function accountGroup(): HasMany
    {
        return $this->hasMany(AccountGroup::class,'account_type_id');
    }
}
