<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $model
 * @property int $status_id
 * @property string $created_at
 * @property string $updated_at
 */
class PaymentModel extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'model', 'status_id'];
}
