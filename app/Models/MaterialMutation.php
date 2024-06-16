<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $material_id
 * @property int $material_mutation_status_id
 * @property int $amount
 * @property int $stock
 * @property string $reference
 * @property string $note
 * @property string $created_at
 * @property string $updated_at
 */
class MaterialMutation extends Model
{
    use HasFactory;

    protected $fillable = ['material_id', 'material_mutation_status_id', 'reference', 'note', 'amount', 'stock'];

    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class, 'material_id')->withTrashed();
    }

    public function materialMutationStatus(): BelongsTo
    {
        return $this->belongsTo(MaterialMutationStatus::class);
    }
}
