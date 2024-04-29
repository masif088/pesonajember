<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $title
 * @property string $note
 *
 */

class Status extends Model
{
    use HasFactory;
    protected $fillable=['title', 'note'];
}
