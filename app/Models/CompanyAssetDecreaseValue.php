<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

//$table->unsignedBigInteger('company_asset_id');
//$table->decimal('shrinkage', 11);
//$table->integer('month');
//$table->integer('year');

/**
 * @property int $id
 * @property int $company_asset_id
 * @property float $shrinkage
 * @property int $month
 * @property int $year
 * @property string $created_at
 * @property string $updated_at
 */
class CompanyAssetDecreaseValue extends Model
{
    use HasFactory;
    protected $fillable=['company_asset_id', 'shrinkage', 'month', 'year'];

    public function companyAsset(): BelongsTo
    {
        return $this->belongsTo(CompanyAsset::class,'company_asset_id');
    }
}
