<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $user_id
 * @property int $hash_id
 * @property string $uid
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $address
 * @property string $province
 * @property string $city
 * @property string $district
 * @property string $village
 * @property string $postal_code
 * @property string $npwp
 * @property string $register
 * @property int $status_id
 * @property string $created_at
 * @property string $updated_at
 */
class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'uid','hash_id', 'name', 'phone', 'email', 'address', 'province', 'city', 'district', 'village', 'postal_code', 'npwp', 'register', 'status_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'user_id');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class,'customer_id');
    }
}
