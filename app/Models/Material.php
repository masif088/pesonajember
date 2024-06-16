<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $title
 * @property string $note
 * @property int $stock
 * @property string $unit
 * @property int $value
 * @property int $supplier_id
 * @property int $status_id
 * @property int $material_category_id
 * @property int $minimum_stock
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Material extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = ['title', 'code','note', 'stock', 'unit','value', 'supplier_id', 'status_id','material_category_id','minimum_stock'];

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function materialCategory(): BelongsTo
    {
        return $this->belongsTo(MaterialCategory::class,'material_category_id');
    }
}
