<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $company_asset_category_id
 * @property string $title
 * @property int $unit
 * @property int $value
 * @property int $value_now
 * @property int $month_acquisition
 * @property int $year_acquisition
 * @property int $useful_life
 * @property int $last_shrinkage
 * @property string $created_at
 * @property string $updated_at
 */
class CompanyAsset extends Model
{
    use HasFactory;
    protected $fillable =['company_asset_category_id', 'title','unit', 'month_acquisition', 'year_acquisition', 'useful_life', 'last_shrinkage','value_now','value'];

    public function companyAssetCategory(): BelongsTo
    {
        return $this->belongsTo(CompanyAssetCategory::class,'company_asset_category_id');
    }

    public function CompanyAssetDecreaseValues(): HasMany
    {
        return $this->hasMany(CompanyAssetDecreaseValue::class,'company_asset_id');
    }
}
