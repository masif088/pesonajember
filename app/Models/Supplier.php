<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer id
 * @property string name
 * @property string address
 * @property string pic
 * @property string phone
 * @property string email
 * @property string note
 * @property integer status
 * @property string created_at
 * @property string updated_at
 * @property string deleted_at
 */
class Supplier extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'address', 'pic', 'phone', 'email','status','note'];
    public function supplierAccounts(): HasMany
    {
        return $this->hasMany(SupplierAccount::class);
    }
}
