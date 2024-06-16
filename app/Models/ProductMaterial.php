<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $product_id
 * @property int $size
 * @property int $amount
 * @property string $note
 * @property int $material_id
 * @property string $created_at
 * @property string $updated_at
 */
class ProductMaterial extends Model
{
    use HasFactory;
    protected $fillable=['product_id','size', 'amount', 'note', 'material_id'];

    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class,'material_id')->withTrashed();
    }
//$table->unsignedBigInteger('material_id');
//$table->decimal('size');
//$table->decimal('amount');
//$table->text('note')->nullable();
}
