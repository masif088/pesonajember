<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer customer_id
 * @property string bank_name
 * @property string account_name
 * @property string account_number
 */
class CustomerAccount extends Model
{
    use HasFactory;
    protected $fillable= ['customer_id', 'bank_name', 'account_name', 'account_number',];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }
}
