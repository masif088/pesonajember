<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int user_id
 * @property double salary
 * @property double bonus
 * @property double allowance
 * @property double transportation
 * @property string note
 * @property string reference
 */

class Salary extends Model
{
    use HasFactory;
    protected $fillable=['user_id', 'salary', 'bonus', 'allowance', 'transportation', 'note', 'reference'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
