<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $supplier_category_id
 * @property string $title
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $created_at
 * @property string $updated_at
 */
class Supplier extends Model
{
    use HasFactory;

    protected $fillable = ['supplier_category_id', 'title', 'name', 'email', 'phone'];

    public function supplierCategory(): BelongsTo
    {
        return $this->belongsTo(SupplierCategory::class, 'supplier_category_id');
    }


    public function materials(): HasMany
    {
        return $this->hasMany(Material::class, 'supplier_id');
    }
}
