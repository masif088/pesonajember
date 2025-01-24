<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer partner_id
 * @property string bank_name
 * @property string account_name
 * @property string account_number
 */
class PartnerAccount extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['partner_id', 'bank_name', 'account_name', 'account_number'];

    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class,'partner_id');
    }
}
