<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $order
 * @property string $title
 * @property string $created_at
 * @property string $updated_at
 */
class TransactionStatusType extends Model
{
    use HasFactory;

    protected $fillable = ['order', 'title'];
}
