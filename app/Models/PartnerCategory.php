<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $created_at
 * @property string $updated_at
 */
class PartnerCategory extends Model
{
    use HasFactory;
    protected $fillable = ['title'];

}
