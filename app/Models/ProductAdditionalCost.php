<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @property int $id
 * @property int $product_id
 * @property int $account_name_id
 * @property int $amount
 * @property int $price
 * @property string $note
 * @property string $created_at
 * @property string $updated_at
 */
class ProductAdditionalCost extends Model
{
    use HasFactory;

    protected $fillable = ['product_id','account_name_id', 'amount', 'price','note'];
}
