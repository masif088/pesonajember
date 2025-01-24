<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string name
 * @property string status
 * @property string kop
 * @property string logo
 * @property string address
 * @property string phone
 * @property string format_number_invoice
 * @property string format_number_driver
 * @property string format_number_proof_of_cash
 * @property string format_number_outcome
 * @property string format_number_income
 * @property string sign_name
 * @property string sign_position
 * @property string note
 */
class Partner extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=['name', 'status', 'kop', 'logo', 'address', 'phone', 'format_number_invoice', 'format_number_driver', 'format_number_proof_of_cash', 'format_number_outcome', 'format_number_income', 'sign_name', 'sign_position', 'note'];

    public function partnerAccounts(): HasMany
    {
        return $this->hasMany(PartnerAccount::class);
    }

    public function orderPartners(): HasMany
    {
        return $this->hasMany(OrderPartner::class);
    }
}
