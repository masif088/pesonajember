<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $code
 * @property string $title
 * @property string $size
 * @property int $stock
 * @property int $price
 * @property int $display_status
 * @property int $product_category_id

 * @property string $note
 * @property string $photo_product
 * @property string $status_id
 * @property string $created_at
 * @property string $updated_at
 */
class Product extends Model
{
    use HasFactory;
    protected $fillable=['code', 'title', 'size', 'price','stock', 'note','product_category_id','status_id','display_status','photo_product','custom_status'];

    public function productAdditionalCosts(): HasMany
    {
        return $this->hasMany(ProductAdditionalCost::class);
    }
    public function productMaterials(): HasMany
    {
        return $this->hasMany(ProductMaterial::class);
    }

    public function productCategory(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class,'product_category_id');
    }
}
