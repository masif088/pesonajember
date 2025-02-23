<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string company_name
 * @property string name
 * @property string phone
 * @property string email
 * @property string note
 * @property string customer_own
 */

class Customer extends Model
{
    use HasFactory;
    protected $fillable=['company_name', 'name', 'phone', 'email', 'note','customer_own'];

    public function customerAccounts(): HasMany
    {
        return $this->hasMany(CustomerAccount::class,'customer_id');
    }
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class,'customer_id');
    }

    public function customerOwns(): HasMany
    {
        return $this->hasMany(Customer::class,'customer_own');
    }
}
