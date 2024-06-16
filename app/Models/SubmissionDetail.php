<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $material_id
 * @property int $submission_id
 * @property int $amount
 * @property int $price
 * @property string $created_at
 * @property string $updated_at
 */
class SubmissionDetail extends Model
{
    use HasFactory;
    protected $fillable=['material_id','submission_id', 'amount', 'price'];

    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class,'material_id')->withTrashed();
    }
}
