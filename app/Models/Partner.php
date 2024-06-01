<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $partner_category_id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $address
 * @property string $note
 * @property string $created_at
 * @property string $updated_at
 */

class Partner extends Model
{
    use HasFactory;

    protected $fillable = ['partner_category_id', 'name', 'phone', 'email', 'address', 'note'];

    public function partnerCategory(): BelongsTo
    {
        return $this->belongsTo(PartnerCategory::class, 'partner_category_id');
    }
}
