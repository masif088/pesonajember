<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property int $operation
 * @property string $created_at
 * @property string $updated_at
 */
class MaterialMutationStatus extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'operation'];

}
