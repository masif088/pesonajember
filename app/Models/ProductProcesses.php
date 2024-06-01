<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $product_id
 * @property int $product_process_tag_id
 * @property string $created_at
 * @property string $updated_at
 */
//$table->unsignedBigInteger('product_id');
//$table->unsignedBigInteger('product_process_tag_id');
class ProductProcesses extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'product_process_tag_id'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function productProcessTag(): BelongsTo
    {
        return $this->belongsTo(ProductProcessTags::class, 'product_process_tag_id');
    }
}
