<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string meta_key
 * @property string meta_value
 */

class GeneralInfo extends Model
{
    use HasFactory;
    protected $fillable = ['meta_key', 'meta_value'];
}
