<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer supplier_id
 * @property string bank_name
 * @property string account_name
 * @property string account_number
 */
class SupplierAccount extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=['supplier_id', 'bank_name', 'account_name', 'account_number'];
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class,'supplier_id');
    }
}
